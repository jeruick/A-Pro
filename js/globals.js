var articulo;
var cantidad;

$(document).ready(function(){
      $('#myCarousel').carousel();
      $("#btnLogin").on("click", mostrarForm);
      $("#submit").on("click", verificar_usuario2);
      $(".dropdown-menu li").on("click", seleccionarCategoria);
      $("#txtBusqueda").on("keyup", buscarArticulo);
      $("#searchButton").on("click", mostrarResultados);
      $("#form1").on("submit", validarSubmit);
      $("#catSeleccionada").on("click", mostrarCategorias);
      $(".addCart").on("click", agregarACarro);
      $(".logout").on("click", logout);
      $("#shopping_cart").on("click", verCarrito);
      $(".delete").on("click", eliminarDelCarrito);
      $(".txtCantidad").on("change", modificarCantidad);
      $("#buyNow").on("click", efectuarCompra);
      $(".in").on("click", verificar_datos);
      $(".buyNow").on('click',comprarAhora);
      $(".historial").on("click", mostrarHistorial);
      $("#categorias li").on("click", articulosCategoria);
      $(".detalles").on("click", mostrarDetalles);
      $(".perfil").on("click",mostrarPerfil);
      $(".misArticulos").on("click",misArticulos);
      $(".usuarios").on("click", listarUsuarios);
      $("#userPhoto").on('click',  mostrarMenuUsuario);
      
      $(window).on('resize', function(){
          var width = $("#txtBusqueda").css('width');
          $("#coincidencias").css('width', width);
      });

      
		});
    function listarUsuarios()
    {
      $(location).attr('href','listar_usuarios.php');
    }
    
    function misArticulos()
    {
      $(location).attr('href','historial_venta.php');
    }

    function mostrarPerfil()
    {
      $(location).attr('href','modificacion_perfil.php');
    }

    $(window).load(function() {
      /* Act on the event */
          articulosEnCarrito();
    });

  


  function agregarAlCarro(id)
  {
    
    $.ajax({
        url: 'carrito.php',
        data: {id: $(id).attr('value')},
      })
      .done(function(respuesta) {
        
        if(respuesta != "")
        {
          var li = jQuery.parseJSON(respuesta);
          articulosEnCarrito();  
          alert("Articulo agregado al carrito");
        }
        else
        {
          alert("El articulo ya esta en el carrito!");
        }
       
      });
  }

    function mostrarDetalles(id)
    {
  
      var items = $(".article div");
      $.each(items, function(index, val) {
         if($(val).attr('value') == id)
         {
            $(val).toggle('slow');
         }
      });
    }

    function articulosCategoria()
    {
      $("#articulos-mas-vistos").hide('slow');
      $.ajax({
        url: 'clases/ArticuloMapper.php',
        type: 'POST',
        data: {accion : 'articulos_categoria', id : $(this).attr('value')}
      })
      .done(function(response) {

        console.log(response);
        $("#articulos-por-categoria").html(response);

        $("#articulos-por-categoria").show('fast');
       
        if($(window).width() < 720)
        {
        	$("#boton-toggle").trigger('click');	
        }

        
      });
       
    }

    function mostrarHistorial()
    {
      $(location).attr('href','historial_compra.php');
    }

    function comprarAhora()
    {
      var items = $(".col2 input[type=number]");
      var id = $(this).attr('value');
      articulo = id;
  
      $.each(items, function(index, val) {
    
         if($(val).attr('name') == id)
         {
            var cantidad_articulo = $(val).val();
            cantidad = cantidad_articulo;

            if(confirm("Esta seguro de realizar la compra?"))
            {
              $.ajax({
                url: 'realizar_compra.php',
                type: 'GET',
                data: {id : articulo , cantidad : cantidad},
              })
              .done(function(response) {
                if(response != "")
                {
                  alert(response);
                  $(location).attr('href','mostrar.php');
                }
                else
                {
                  mostarLogin();
                }
              })
              .fail(function() {
                console.log("error");

              });
              
            }
            
         }
      });
  
    }

    function comprar()
    {
      $.ajax({
              url: 'realizar_compra.php',
              type: 'GET',
              data: {id : articulo , cantidad : cantidad},
            })
            .done(function(response) {
              if(response != "")
              {
                alert(response);
                $(location).attr('href','mostrar.php');
              }
            })
            .fail(function() {
              console.log("error");

            });
    }

    function verificar_datos()
    {
      var user = $(".txtUsuario").val();
      var pass = $(".txtContra").val();
      verificar_usuario(user, pass);
    }

    function modificarCantidad()
    {
      $.ajax({
        url: 'carrito.php',
        type: 'POST',
        data: {id: $(this).attr('name'), cantidad: $(this).val() },
      })
      .done(function(response) {
        console.log(response);
      })
      .fail(function() {
        console.log("error");
      });
      
    }
      
    function efectuarCompra()
    {
      if(confirm("Esta seguro de realizar la compra?"))
      {
        $.ajax({
          url: 'realizar_compra.php',
          type: 'GET',
        })
        .done(function(response) {

          if(response != "")
          {
            alert(response);
            $(location).attr('href','ver_carrito.php');
          }
          else
          {
            mostarLogin();
          }
        })
        .fail(function() {
          console.log("error");
        });
        
      }
    }

    function mostarLogin()
    {

      $(".ventana").dialog({ //   muestra la ventana  -->
      width: 400,  //  ancho de la ventana -->
      height: 200,//   altura de la ventana -->
      show: "slideDown", // animación de la ventana al aparecer -->
      hide: "slideUp", // animación al cerrar la ventana -->
      resizable: "false", // fija o redimensionable si ponemos este valor a "true" -->
      position: "center",// posicion de la ventana en la pantalla (left, top, right...) -->
      modal: "true" // si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
      });

    }


    function eliminarDelCarrito()
    {
      if(confirm("Esta seguro de eliminar este articulo?"))
      {
        var id = $(this).attr('value');
        $(location).attr('href','ver_carrito.php?id=' + id);  
      }
      
    }
    
    function verCarrito()
    {
      $(location).attr('href','VerCarrito.php');
    }
    
    function logout()
    {
      var url = $(location).attr('href');
      var page = url.substring(url.lastIndexOf("/") + 1, url.lastIndexOf(".") + 4);
      $(location).attr('href','cerrar_sesion.php?url=' + page);
      
    }

    function agregarACarro()
    {
      $.ajax({
        url: 'carrito.php',
        data: {id: $(this).attr('value')},
      })
      .done(function(respuesta) {
        
        if(respuesta != "")
        {
          var li = jQuery.parseJSON(respuesta);
          articulosEnCarrito();  
          alert("Articulo agregado al carrito");
        }
        else
        {
          alert("El articulo ya esta en el carrito!");
        }
       
      });
      
    }

    function articulosEnCarrito()
    {
      $.ajax({
        url: 'carrito.php',
        type: 'POST',
      })
      .done(function(response) {
      
        $("#shopping_cart span").html(response);
      })
      .fail(function() {
        console.log("error");
      });
      
    }

    function mostrarCategorias()
    {
       $(".dropdown-menu").toggle();
    }

    

    function mostrarMenuUsuario()
    {
      
      $(".submenu").toggle('fast');
   
      

    }

    function validarSubmit()
    {
      
      if($(".form-control").val() != "")
      {
         this.submit();
      }
      else{ return false;}
       
    }

    function seleccionarArticulo(val)
    {
      $(".form-control").val($(val).attr('value'));
      $("#coincidencias").hide('slow');       
    }

    function mostrarResultados()
    {
      var texto = $(".form-control").val();
      if(texto != "")
      {
        $(location).attr('href', 'mostrar.php');
      }
    }

    function buscarArticulo()
    {
      var ancho = $("#txtBusqueda").css('width');
          if($(this).val() != "")
          {
              
             //start the ajax
              $.ajax({
                //this is the php file that processes the data and send mail
                url: "clases/ArticuloMapper.php", 
                
                //GET method is used
                type: "POST",

                //pass the data     
                data: {texto : $(this).val(), accion: 'buscar_articulos' },   
                
                //Do not cache the page
                cache: false,
                
                //success
                success: function (html) 
                { 

                  $("#coincidencias").css('width', ancho);

                  if(html != "")
                  {       
                     $("#coincidencias").html(html);  
                     $("#coincidencias").show('fast');
                  }
                  else
                  {
                    $("#coincidencias").hide('fast');
                  }

                }   
              }); 
          }
          else
          {
            $("#coincidencias").hide('slow');
          }
          

    }

    function seleccionarCategoria()
    {
      $("#searchButton").attr("value",$(this).attr('id'));
      $("#catSeleccionada").html($(this).html());
      $(".dropdown-menu").toggle();

    }
    function mostrarForm()
    {
      $("#login").toggle('slow');
  
    }  
    function verificar_usuario2()
    {
      var user = $("#txtUser").val();
      var pass = $("#txtPass").val();
    
      if(user != "" && pass != "")
      {
          //start the ajax
          $.ajax({
            //this is the php file that processes the data and send mail
            url: "login.php", 
            
            //GET method is used
            type: "POST",

            //pass the data     
            data: {correoElectronico : user, contrasena : pass},   
            
            //Do not cache the page
            cache: false,
            
            //success
            success: function (html) 
            {        
              if(html != "")
              {
                $(".main").html(html);
              } 
              else
              {
                alert("usuario o contraseña incorrecta");
          
              }
            }   
          });       
      }
    }

    function verificar_usuario(user, pass)
    {
      if(user != "" && pass != "")
      {
          //start the ajax
          $.ajax({
            //this is the php file that processes the data and send mail
            url: "login.php", 
            
            //GET method is used
            type: "POST",

            //pass the data     
            data: {correoElectronico : user, contrasena : pass},   
            
            //Do not cache the page
            cache: false,
            
            //success
            success: function (html) 
            {        
              if(html != "")
              {
                $(".main").html(html);
                comprar();
              
              } 
              else
              {
                alert("usuario o contraseña incorrecta");
                
              }
            }   
          });       
      }
    }
    