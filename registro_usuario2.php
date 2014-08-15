<?php
require_once("conexion.php");
$consultaPais = "SELECT * FROM pais;";
$resultadoPais = mysqli_query($conexion, $consultaPais);
if(isset($_GET["email"]))
{
  $email = $_GET["email"];
  $result =   mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_electronico = '$email'");
  if(mysqli_num_rows($result))
  {
    echo "este correo ya esta registrado";
    return;
  }
  else return;
}
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset=utf-8 />
<title>Registro de usuario</title>
<link rel="stylesheet"  href="css/bootstrap.css">
<link rel="stylesheet" href="css/jquery.idealforms.css">

<style>
  body 
  {
    background: #F8F8F8;
    max-width: 980px;
    margin: 2em auto;
    font: normal 15px/1.5 Arial, sans-serif;
    color: #353535;
    overflow-y: scroll;
  }
  .content 
  {
    border: none;
    box-shadow: rgba(0,0,0,0.2) 0px 0px 50px;
    margin: 0 30px;
  }
  .field
  {
    margin: 0 auto;
  }
  .field.buttons button {
    margin-right: .5em;
  }
  .idealsteps-step
  {
    width: 50%;
    margin: 0 auto;
  }
  .idealsteps-step, #new_user
  {
    display: inline-block;
    vertical-align: top;
  }

  .idealforms.adaptive #invalid {
    margin-left: 0 !important;
  }

  .idealforms.adaptive .field.buttons label {
    height: 0;
  }

  #fotoUsuario
  {
    border-radius: 50%;
    height: 100px;
    width:100px;

  }
  #errorEmail
  {
    color: red;
    display: none;
    left: 440px;
    top: 0px;
    position: absolute;
    width:100px;
  }
  #invalid {
    display: none;
    float: left;
    width: 290px;
    margin-left: 120px;
    margin-top: .5em;
    color: #CC2A18;
    font-size: 130%;
    font-weight: bold;
  }
  #new_user
  {
    width: 40%;
  }

</style>
</head>
<body>

  <div class="content">

    <div class="idealsteps-container">

      <nav class="idealsteps-nav"></nav>

      <form action="ingresonuevousuario2.php" id="form1" method="post" enctype="multipart/form-data" novalidate autocomplete="off" class="idealforms">

        <div class="idealsteps-wrap">

          <!-- Step 1 -->
          <section id="new_user">
              <img src="img/usuario.png" style="width:60%;">
          </section>

          <section class="idealsteps-step">

            <div class="field">
              <label class="main">Nombre:</label>
              <input name="name" type="text">
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">E-Mail:</label>
              <input name="email" type="email">
              <span class="error"></span>
              <p id="errorEmail"></p>
            </div>
            
            <div class="field">
              <label class="main">Contraseña:</label>
              <input name="password" type="password">
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Confirmar contraseña:</label>
              <input name="confirmpass" type="password">
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Administrador:</label>
              <p class="group">
                <label><input checked name="admin" type="radio" value="1">Si</label>
                <label><input name="admin" type="radio" value="0">No</label>
              </p>
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Nacimiento:</label>
              <input name="date" type="text" placeholder="yy-mm-dd" class="selector">
              <span class="error"></span>
            </div>
            <div class="field">

              <center><img src="foto_perfil/usuario_sin_foto.jpg" id="fotoUsuario" name="fotoUsuario"></center>
            <div></div>
            <div class="field">
              <label class="main">Foto:</label>
              <input id="picture" name="picture" type="file" multiple>
              <span class="error"></span>
            </div>
			
			     <div class="field">
              <label class="main">Sexo:</label>
              <p class="group">
                <label><input checked name="sex" type="radio" value="Masculino">Masculino</label>
                <label><input name="sex" type="radio" value="Femenino">Femenino</label>
              </p>
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Pais:</label>
              <select name="selPais" id="selPais" onChange="seleccionarCiudad(this.value)">
                <option value="default">&ndash; Selecciona un Pais &ndash;</option>
                <?php while ($registroPais = mysqli_fetch_array($resultadoPais)) {?>
                    <option value="<?php echo $registroPais["id"]; ?>"><?php echo $registroPais["nombre_pais"]; ?></option>
                <?php }?>
              </select>
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Ciudad:</label>
              <select name="selCiudad" id="selCiudad">
                <option value="default">&ndash; Selecciona una ciudad &ndash;</option>
              </select>
              <span class="error"></span>
            </div>

            <div class="field">
              <label class="main">Telefono:</label>
              <input name="phone" type="text" id="phone" placeholder="00000000">
              <span class="error"></span>
            </div>


            <div class="field buttons">
              <label class="main">&nbsp;</label>
              <button type="submit" class="submit">Guardar</button>
              <a href="index.php" style="padding:8px 15px; border-radius: 5px; text-decoration:none;display:inline-block; color:black; #F8F8F8: white;border:1px solid rgba(0,0,0,0.3); box-shadow: rgba(0,0,0,0.2) 0px 0px 5px">Cancelar</a> 
            </div>

          </section>

        </div>

        <span id="invalid"></span>

      </form>

    </div>

  </div>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/out/jquery.idealforms.js"></script>
  <script>
    var errores = 0;
    $('form.idealforms').idealforms({

      silentLoad: false,

      rules: {
        'name': 'required username',
        'email': 'required email',
        'password': 'required pass',
        'confirmpass': 'required equalto:password',
        'date': 'required date',
        'picture': 'extension:jpg:png',
        'website': 'url',
        'phone': 'phone',
        'zip': 'required zip',
        'selCiudad': 'required select:default',
      },

      errors: {
        'username': {
          ajaxError: 'Username not available'
        }
      },

      onSubmit: function(invalid, e) {
        
        $('#invalid')
          .show()
          .toggleClass('valid', ! invalid)
          .text(invalid ? ('Se encontraron ' + invalid +' problemas') : "");
          if($("#errorEmail").html())
          {
            errores = 1;
          }
          else
          {
            errores = 0;
          }

          if(errores > 0 || invalid > 0)
          {
            e.preventDefault();
          }
          alert("Registro completado");

      }
    });



    $('form.idealforms').find('input, select, textarea').on('change keyup', function() {
      $('#invalid').hide();
    });

    $('form.idealforms').idealforms('addRules', {
      'comments': 'required minmax:50:200'
    });

    $('.prev').click(function(){
      $('.prev').show();
      $('form.idealforms').idealforms('prevStep');
    });
    $('.next').click(function(){
      $('.next').show();
      $('form.idealforms').idealforms('nextStep');
    });

    jQuery('#picture').on('change', function(e) {
    var Lector;
    oFileInput = this;
    if (oFileInput.files.length === 0) {
      return;
    };
    Lector = new FileReader();
    Lector.onloadend = function(e) {
      var num = e.target.result.indexOf("/");
      var ext = e.target.result.substring(num + 1, num + 5);

      if(ext == "jpeg" || ext.substring(0,3) == "png" )
      {
        jQuery('#fotoUsuario').attr('src', e.target.result);          
      }
      else
      {
       jQuery('#fotoUsuario').attr('src', "foto_perfil/usuario_sin_foto.jpg"); 
      }
    };
    Lector.readAsDataURL(oFileInput.files[0]);
  });


  $(document).ready(function()
  {
    $( ".selector" ).datepicker({ dateFormat: "yy-mm-dd" });
    $("input[type=email]").on("blur", validarCorreo);
   
  });
  function validarCorreo()
  {
    $.ajax({
      url: 'registro_usuario.php',
      type: 'GET',
      data: {email: $(this).val()},
    })
    .done(function(html) {
        $("#errorEmail").show();
        $("#errorEmail").html(html);
    });    
    
  }

  function seleccionarCiudad(str){
        <!---->
        var xmlhttp;
        <!---->
        if (str == 0) {
          document.getElementById("txtHint").innerHTML = "";
          return;
        }
        <!---->
        if(window.XMLHttpRequest){
          xmlhttp = new XMLHttpRequest();
        }
        else{
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        <!---->
        xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.getElementById("selCiudad").innerHTML = xmlhttp.responseText;
          }
        }
        <!---->
        xmlhttp.open("GET", "ciudades.php?q="+str, true);
        xmlhttp.send();
      }
  </script>
</body>
</html>
