
<?php

  $conexion = mysqli_connect("localhost","root","","apro"); 
 if(isset($_GET["id"]))
 {
    $idcategoria=$_GET["id"];
    $result=mysqli_query($conexion, "SELECT * FROM articulo where id_categoria='$idcategoria' AND cantidad > 0");
    $resultado = mysqli_query($conexion, "SELECT * FROM categoria WHERE id = $idcategoria");
    $categoria = mysqli_fetch_assoc($resultado);
    $contador = 5;
 }
?>

<div style="background: rgb(250,250,250);border: 1px solid gray; box-shadow: rgba(0,0,0,0.2) 0px 0px 10px;width:1000px; margin-bottom:20px;" >
<h4><?php echo $categoria["nombre_categoria"]; ?></h4>
<?php while($row = mysqli_fetch_assoc($result)){ 
        if($contador%5 == 0)   { ?>
          <div style="border-bottom:1px solid gray;margin:0px 10px 20px 10px; padding:10px"> 
       <?php }  ?>
    
      <div class="article" style="width:180px;display: inline-block;" >
        <img style="width:100px;height:100px" src="<?php echo 'articulos/'.$row["foto_articulo"]; ?>">
        <p><?php echo "Precio: L.".$row["precio_unidad"]; ?></p>
        <input type="button" style="padding:4px;font-size:12px" class="btn btn-default navbar-btn" name='<?php echo $row["id"]; ?>' onClick="mostrarDetalles(this.name)" value="+Detalles" />
        <a style="padding:4px;font-size:12px;" class="btn btn-primary btn-lg" onClick="agregarAlCarro(this)" value="<?php echo $row["id"]; ?>" role="button">Agregar al carro</a>
        <div style="background: white;border:1px solid rgba(0,0,0,0.1);display:none;position:absolute; width:200px;box-shadow:rgba(0,0,0,0.1) 0px 0px 10px" value="<?php echo $row["id"] ?>">
          <p><?php echo $row["descripcion"] ?></p>
          <p>Marca:<?php echo $row["marca"] ;?></p>
          <p>Existencia: <?php echo $row["cantidad"] ?></p>
        </div>
      </div>
    <?php $contador++; 
          if($contador%5 == 0)   { ?>
            </div> 
       <?php } 
    } mysqli_free_result($result); ?>
  <center><div id="selector"></div></center>
 </div>
 <script type="text/javascript">

  var items = $("#articulos-por-categoria .article");

        var numItems = items.length;
        var itemsxPage = 10;
        alert(numItems);
        if(numItems > 0)
        {
        // only show the first 2 (or "first per_page") items initially
          items.slice(itemsxPage).hide();

          $("#selector").pagination({
            items: numItems,
            itemsOnPage: itemsxPage,
            cssStyle: 'light-theme',
            onPageClick: function(pageNumber) { // this is where the magic happens
                // someone changed page, lets hide/show trs appropriately
                var showFrom = itemsxPage * (pageNumber - 1);
                var showTo = showFrom + itemsxPage;

                items.hide().slice(showFrom, showTo).show();
                     // first hide everything, then show for the new page
            } 
          });
         
        }
         else{ $("#contenido").html("No se encontraron resultados");}
      </script>
