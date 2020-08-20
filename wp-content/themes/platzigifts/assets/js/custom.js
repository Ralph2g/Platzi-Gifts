(function($){
    $('#categorias-productos').change(function(){
        //Vamos a ejecutar nuestra función ajax para el selctor
        $.ajax({
            url:pg.ajaxurl,
            method:"POST",
            data:{
                "action":"pgFiltroProductos",//función que procesa los datos
                "categoria":$(this).find(':selected').val()//aqui vamos a solicitar que tome del elemento actual (Select)
            },
            beforeSend: function(){
                $("#resultado-productos").html("Cargando...");
            },
            success: function(data){
                let html ="";
                data.forEach( item => {
                    html +=`<div class="col-4 my-3">
                    <figure>${item.imagen}</figure>
                    <h4 class="text-center my-2">
                    <a href="${item.link}">${item.titulo}"</a></h4></div>`
                })
                $("#resultado-productos").html(html);
            },
            error: function(error){
                console.log(error);
            }
        })
    })
})(jQuery);
