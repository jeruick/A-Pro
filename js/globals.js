$(document).ready(function(){
      $('.myCarousel').carousel({interval: 1000});
      $("#btnLogin").on("click", mostrarForm);
      $("#submit").on("click", verificar_usuario);
      $(".dropdown-menu li").on("click", seleccionarCategoria);
      $(".form-control").on("keyup", buscarArticulo);
      $("#searchButton").on("click", mostrarResultados);
      $("#form1").on("submit", validarSubmit);
      $("#catSeleccionada").on("click", mostrarCategorias);
		});

    function mostrarCategorias()
    {
       $(".dropdown-menu").toggle();
    }

    

    function mostrarMenuUsuario(val)
    {
      $(".submenu").toggle('fast');
   
      //Mouseup textarea false
      $(".submenu").mouseup(function()
      {
      return false
      });
      $(".account").mouseup(function()
      {
      return false
      });


      //Textarea without editing.
      $(document).mouseup(function()
      {
        $(".submenu").hide();
      });

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
          if($(this).val() != "")
          {
              
             //start the ajax
              $.ajax({
                //this is the php file that processes the data and send mail
                url: "buscar_articulo.php", 
                
                //GET method is used
                type: "GET",

                //pass the data     
                data: {nombre : $(this).val()},   
                
                //Do not cache the page
                cache: false,
                
                //success
                success: function (html) 
                { 

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
      $(this).attr('id');
      $("#catSeleccionada").html($(this).html());
      $(".dropdown-menu").toggle();

    }
    function mostrarForm()
    {

      $(".form-1").toggle('slow');
  
    }  
    function verificar_usuario()
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