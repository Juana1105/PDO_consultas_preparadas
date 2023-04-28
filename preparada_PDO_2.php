

<style>
table{
  width: 70%;
  margin: 0 auto;
}
td{
  border: 1px solid black;
  text-align: center;
  padding: 5px 10px 5px 10px;
  width: 16.6%;
  border-collapse: collapse;
  margin: 0;
}
#referencia{
  color: blue;
  font-weight: bold;
}
</style>

<?php

$busqueda=$_GET["buscar"];

try{ 

            //Creamos la conexion_ new PDO pide tres argumentos
            $conexion=new PDO('mysql:host=localhost; dbname=pruebas', 'root', 'iusenma');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//LE DAMOS ATRIBUTOS
            $conexion->exec("SET CHARACTER SET utf8");

            //La consulta -sql- preparada
            $consulta="SELECT * FROM artículos WHERE `NOMBRE ARTÍCULO`=?";
          

//OBJETO PDO STMT-statment-
$resultados=$conexion->prepare($consulta);//RECORDSET VIRTUAL(tabla virtual donde tenemos los resultados)

//EJECUTAR LA CONSULTA__dentro del array va el nombre del articulo ?_ variable $busqueda
$resultados->execute(array($busqueda)); 

//Ejecutar resultados(recorrer el array)
  while($fila=$resultados->fetch(PDO::FETCH_ASSOC)){//fetch es el método y FETCH_ASSOC es el atributo---fetch recorre linea a linea
?>

    <table><tr><td id='referencia'>
    <?php echo $fila['CÓDIGO']?>   </td><td>
    <?php echo $fila['SECCIÓN']?>  </td><td>
    <?php echo $fila['NOMBRE ARTÍCULO']?>  </td><td>
    <?php echo $fila['FECHA']?>  </td><td>
    <?php echo $fila['PAÍS DE ORIGEN']?>  </td><td>
    <?php echo $fila['PRECIO']?>  </td></tr></table>
    <?php echo "<br>"?>
<?php
  }
    //Cerrar el RECORDSET
    $resultados->closeCursor();


}catch(Exception $e){ 
  die ("Se ha producido el error: " . $e->getMessage());
}finally{
  $conexion=null; // VACIAR
}
?>


