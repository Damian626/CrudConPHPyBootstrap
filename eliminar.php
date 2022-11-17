<?php
include 'connect.php';


if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $deleteUser = $conn->prepare("DELETE FROM `usuarios` WHERE id = ?");
   $deleteUser->execute([$delete_id]);
   header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimiar</title>
</head>
<body>
<a class="btn btn-danger btn-sm " href="eliminar.php?delete=<?= $fila['id']; ?>" onclick="return confirm('¿Seguro que desea eliminar este usuario?');">Eliminar </a>
</body>
</html>