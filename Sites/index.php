<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Preguntale a tu máquina </h1>
  <p style="text-align:center;">Aquí podrás encontrar información útil para tu próxima compra.</p>

  <br>

  <h3 align="center"> Mostrar todas las tiendas y sus comunas de despacho</h3>

  <form align="center" action="consultas/consulta_tienda_despacho.php" method="post">
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar jefe de tienda por comuna?</h3>

  <form align="center" action="consultas/consulta_jefes.php" method="post">
    Comuna:
    <input type="text" name="comuna">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres conocer los usuarios que compraron un producto con esta descripción?</h3>

  <form align="center" action="consultas/consulta_producto_descripcion.php" method="post">
    Descripción:
    <input type="text" name="descripcion">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">¿Quieres mostrar todas las tiendas que venden productos de esta categoría?</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT descripcion FROM productos;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_tipo.php" method="post">
    Seleccinar un tipo:
    <select name="tipo">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por categoría">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
</html>
