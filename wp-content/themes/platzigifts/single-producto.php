<?php get_header( );?>

<main class="container my-4">
    <?php if(have_posts()){
            while(have_posts()){
                the_post();
            ?>
                <h1 class="my-4"><?php the_title()?></h1>
                <div class="row">
                    <div class="col-4">
                        <?php the_post_thumbnail('large');?>
                    </div>
                    <div class="col-8">
                        <?php the_content()?>
                    </div>
                </div>
                
                <?php 
                $ID_producto_actual = get_the_ID();
                $args = ARRAY(
                    'post_type'     => 'producto',
                    'post_per_page' => 6,
                    'order'         => 'ASC',
                    'orderby'       => 'title',
                );
                $productos = new WP_Query($args);
                ?>

                <?php if($productos->have_posts()){?>
                    
                    <div class="row justify-content-center productos-relacionados">
                        <div class="col-12">
                            <h3 class="my-3 text-center">Productos relacionados</h3>
                        </div>
                        <?php while($productos->have_posts()){?>
                                <?php $productos->the_post();
                                if(get_the_ID() != $ID_producto_actual) {?>
                                    <div class="col-2 my-3 text-center">
                                        <?php the_post_thumbnail('thumbnail');?>
                                        <a href="<?php the_permalink();?>"><h4><?php the_title();?></h4></a>
                                    </div>
                                <?php
                            };// fin de if ID_producto
                        };// fin while producto
                        ?>
                    </div>
                <?php
            };// end if 
            ?>

            <?php 
            };//end while post
        };//end if post
    ?>
</main>

<?php get_footer( );?>