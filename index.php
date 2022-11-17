<?php

include 'connect.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Usuarios</title>
   <link rel="icon" href="../img/agreagar_producto.ico">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <link rel="stylesheet" href="estilos.css">

</head>

<body>
  
  
   
  <table class="table table-hover">
         <thead>
            <tr>
            <th colspan="6" class="text-center fs-1 bg-light border">Usuarios</th>
            </tr>
            <tr>
               <th colspan="6" class="text-center"> <?php include 'agregar.php';?></th>
            </tr>
           
            <tr>
               <th scope="col"class="bg-light">Nombre</th>
               <th scope="col"class="bg-light">Apellido</th>
               <th scope="col"class="bg-light">Correo</th>
               <th scope="col"class="bg-light">Contraseña</th>
               <th scope="col"class="bg-light"></th>
               <th scope="col"class="bg-light"></th>
            </tr>
         </thead>
         <tbody>
         <?php
               $seleccionar_usuarios = $conn->prepare("SELECT * FROM `usuarios`");
               $seleccionar_usuarios->execute();
               if ($seleccionar_usuarios->rowCount() > 0) {
                  while ($fila = $seleccionar_usuarios->fetch(PDO::FETCH_ASSOC)) {
               ?>

            <tr>
               <th scope="row"><?php echo $fila["nombre"]; ?></th>
               <td><?php echo $fila['apellido']; ?></td>
               <td><?php echo $fila['email']; ?></td>
               <td><?php echo $fila['password']; ?></td>
               <td><a class="btn btn-danger btn-sm " href="editar.php?update=<?= $fila['id']; ?>">Modificar</a></td>
               <td><?php include 'eliminar.php' ?></td>
               <?php
                  }
               }
               ?>
            </tr>
         </tbody>

      </table>

      


</body>

</html>