
<?php 
    require("Conexion.php");
    

    $consulta = "SELECT T1.id, T1.nombre_articulo, T1.foto_articulo, T1.visitas, T1.id_categoria, 
            T1.marca,T1.precio_unidad, T2.nombre_categoria FROM 
  ((SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 1 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 2  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION 
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 3  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 4  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 5  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 6  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 7  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 8  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 9  AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5 ) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 10 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION 
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 11 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 12 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5) UNION
  (SELECT * FROM ARTICULO WHERE ID_CATEGORIA = 13 AND cantidad > 0 ORDER BY VISITAS DESC LIMIT 5)) AS T1,
  (SELECT id_categoria, nombre_categoria FROM ARTICULO, CATEGORIA WHERE ARTICULO.ID_CATEGORIA = CATEGORIA.ID
  GROUP BY ID_CATEGORIA ORDER BY SUM(VISITAS) DESC LIMIT 5 ) AS T2 WHERE T1.ID_CATEGORIA = T2.ID_CATEGORIA";
  $resultado = mysqli_query($conexion, $consulta);
  
  


?>