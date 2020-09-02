<?php 

function init_template(){
    add_theme_support('post-thumbnails');
    add_theme_support( 'title-tag' );
    register_nav_menus( array(
        'top_menu' => 'Menú Principal'
    ) );
}

add_action( 'after_setup_theme', 'init_template');



function assets(){
    wp_register_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', '', '4.4.1', 'all');
    wp_register_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap', '', '1.0', 'all' );
    wp_enqueue_style( 'estilos', get_stylesheet_uri(  ), array('bootstrap','montserrat'), '1.0','all' );
    wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', '', '1.16', true);
    wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery','popper'), '4.4.1', true );
    wp_enqueue_script( 'custom', get_template_directory_uri(  ).'/assets/js/custom.js', '', '1.0', true );

    //Nos permite enviar información desde nuestro archivo php en un objeto a un archivo js determinado
    wp_localize_script( 'custom', 'pg', array(
        'ajaxurl' => admin_url( 'admin-ajax.php'),// se le paas una extención especifica de un archivo php  el admin ajax es el archivo predeterminado
        'apiurl' => home_url( 'wp-json/pg/v1/')
    ) );
}

add_action( 'wp_enqueue_scripts', 'assets');

// sidebar
function sidebar(){
    register_sidebar( array(
        'name' => 'Pie de página',
        'id'   => 'footer',
        'description' => 'Zona de widgets para pie de página',
        'before_title' => '<p>',
        'after_title' => '</p>',
        'before_widget' =>'<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
    ) );
}

add_action( 'widgets_init', 'sidebar');

function productos_type(){
    $labels = array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos',
    );
    $args = array(
        'label' => 'Productos',
        'description' => 'Productos de Platzi',
        'labels' => $labels,
        'supports' => array('title','editor','thumbnail','revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicy_queryable'=>true,
        'rewrite' => true,
        'show_in_rest' => true,
    );
    register_post_type( 'producto', $args );
}

add_action( 'init','productos_type');

function pgRegisterTax () {
    $args = array(
        'hierarchical' => true, // Permitir subcategorias
        'labels' => array(
            'name' => 'Categorías de productos', //Plural nombre de todas las categorias de los productos
            'singular_name' => ' Categoría de Productos'
        ), //Le pasamos qlas etiquetas que vamos a mostrar
        'show_in_nav_menu' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'categoria-productos'), //Especificar como queremos que se reescriba la ruta de los archivos de categoria de productos
    );
    register_taxonomy( 'categoria-productos', array('producto'), $args );
}

add_action( 'init', 'pgRegisterTax' );




//Definimos la función de  filtrado deproductos

add_action( "wp_ajax_nopriv_pgFiltroProductos","pgFiltroProductos");
add_action( "wp_ajax_pgFiltroProductos","pgFiltroProductos");
function pgFiltroProductos(){
    $args = array(
        'post_type'     => 'producto',
        'post_per_page' => -1,//el menos uno es paratraer todoslos elementps
        'order'         => 'ASC',
        'orderby'       => 'title',  
    );
    if($_POST['categoria']){
        $args['tax_query'] = array(
            array(
                'taxonomy' =>'categoria-productos',
                'field' => 'slug',
                'terms' => $_POST['categoria'],
            )
        );//query se realice sobre una taxonomia en particular
    }
    $productos = new WP_Query($args);
    if($productos->have_posts(  )){
        $return = array();
        while ($productos->have_posts()) {
            $productos->the_post(  );
            $return[] =array(
                'imagen'=> get_the_post_thumbnail( get_the_id(), 'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title()
            );
        };
        wp_send_json($return);
    };
};


/* ============ ENDPOINTS =============*/

add_action( 'rest_api_init', 'novedadesAPI');

function novedadesAPI(){
    register_rest_route( 
        'pg/v1', 
        '/novedades/(?P<cantidad>\d+)',// le asignamos un atributo dinamico
        array(
            'methods' => 'GET',
            'callback' => 'pedidoNovedades'
        ),
    );
};

function pedidoNovedades($data){
    //Lop personalizado
    $args = array(
        'post_type'     => 'post',
        'post_per_page' => $data['cantidad'],//atributo dinamico de cantidad
        'order'         => 'ASC',
        'orderby'       => 'title',  
    );
    $novedades =new WP_Query($args);
    if($novedades->have_posts(  )){
        $return = array();
        while ($novedades->have_posts()) {
            $novedades->the_post(  );
            $return[] =array(
                'imagen'=> get_the_post_thumbnail( get_the_id(), 'large'),
                'link' => get_the_permalink(),
                'titulo' => get_the_title()
            );
        };
        return $return;
    }
}
//Bloque de Gutenberg
add_action( 'init', 'pgRegisterBlock');
function pgRegisterBlock(){
    $assets = include_once get_template_directory(  ).'/blocks/build/index.asset.php';
    
    wp_register_script( 
        'pg-block', //handler
        get_template_directory_uri(  ).'/blocks/build/index.js',// directorio
        $assets['dependencies'],//dependencias 
        $assets['version'], //identificar la verision
    );
    
    register_block_type( 
        'pg/basic', //nombre del slug del bloque
        array(
            'editor_script' => 'pg-block' //a editor script le pasamos el handler de  donde registramos el script
        ),
    );
};
?>