$(document).on("ready", listo);

    function listo ()
    {
      $("#txtNumeroT").on("keypress", esNumero);
      $("input[type=file]").nicefileinput();
    }

    function esNumero(event)
    {
      
      if(isNaN(event.key) && event.charCode != 0)
      {
        event.preventDefault();
      }
    }
     function mostrar_ocultos(id)
      {
        var perfil = document.getElementById("informacion_perfil");
        var pass = document.getElementById("dv_contrasena");
        var editarP = document.getElementById("editar_perfil");
        var bt = document.getElementById("sbGuardar");

        var items = $("#opciones li");
        $.each(items, function(index, val) {
           /* iterate through array or object */
           var nombre = $(val).attr('value');
           if($(val).attr('value') != id)
           {
              $(val).css('color','rgba(255,255,255,0.5)');
              $("#title").removeClass(nombre);

           }
           else
           {
              $(val).css('color','white');
              $("h2").html($(val).attr("name"));
              $("#title").addClass(nombre);
           }
        });

        if(id == "editar_perfil"){
          perfil.style.display = 'none'
          editarP.style.display = 'block';
          pass.style.display = 'none';
          bt.style.display = 'block';

        }
        else if( id== "dv_contrasena"){

            perfil.style.display = 'none';
          editarP.style.display = 'none';
          pass.style.display = 'block';
        }
        else if(id == "informacion_perfil"){
            
            perfil.style.display = 'block'
          editarP.style.display = 'none';
          pass.style.display = 'none';
        }
   }