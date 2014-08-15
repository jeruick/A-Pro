$(document).on("ready", listo);

    function listo ()
    {
      $("#txtNumeroT").on("keypress", esNumero);
      $("input[type=file]").nicefileinput();
    }

    var xmlAjax;
    if(window.XMLHttpRequest) 
      {
        xmlAjax = new XMLHttpRequest();
      } 
      else 
      {
        xmlAjax = new ActiveXObject("Microsoft.XMLHTTP");
      }

  function filtrar() 
    { 
        xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {//satisfactorio

            var sel = document.getElementById("selCiudad");

            if(xmlAjax.responseText != "")
            {
              sel.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('selCiudad').style.display = 'none';       
            }
            
          }
          else 
          {//error
            alert("error");
          }
        }
      }
        var consulta = document.getElementById("Slpais").value;

        xmlAjax.open("GET","filtro_ciudades.php?consulta=" + consulta, true);
        xmlAjax.send();
    } 

    function Comprobar_Contrasena()
    { 
       xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {

            var div = document.getElementById("msj_Wpass");

            if(xmlAjax.responseText != "")
            {
               div.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('msj_Wpass').style.display = 'none';       
            }
            
          }
          else 
          {
            alert("error");
          }
        }
      }
        var pass = document.getElementById("txtPass_anterior").value;
        var id = document.getElementById("txtId").value; 
        xmlAjax.open("GET","ComprobarPass.php?id="+ id + "&pass=" + pass, true);
        xmlAjax.send();
    }

 function Nueva_Contrasena()
    {
       xmlAjax.onreadystatechange = function()
        {
        if(xmlAjax.readyState == 4) 
        {
          if(xmlAjax.status == 200) 
          {

            var div = document.getElementById("msj_WNpass");

            if(xmlAjax.responseText != "")
            {
               div.innerHTML = xmlAjax.responseText;
            }
            else
            {
              document.getElementById('msj_WNpass').style.display = 'none';       
            }
            
          }
          else 
          {
            alert("error");
          }
        }
      }
        var texto1 = document.getElementById("txtPass_nueva").value;
        var texto2 = document.getElementById("txtConfirmar_pass").value;
        xmlAjax.open("GET","nueva_pass.php?texto1="+ texto1 + "&texto2=" + texto2, true);
        xmlAjax.send();
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
           alert
           if($(val).attr('value') != id)
           {
              $(val).css('color','rgba(255,255,255,0.5)');
           }
           else
           {
              $(val).css('color','white');
              $("h3").html($(val).attr("name"));
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