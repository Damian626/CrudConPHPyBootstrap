<?php
include 'connect.php';

if (isset($_POST['update'])) {

   $pid = $_POST['pid'];
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre);
   $apellido = $_POST['apellido'];
   $apellido = filter_var($apellido);
   $email = $_POST['email'];
   $email = filter_var($email);
   $prev_pass = $_POST['prev_pass'];
   $password = sha1($_POST['password']);
   $password = filter_var($password);

 if($password!=$prev_pass){
      echo '<div class="container-fluid alert alert-danger" role="alert">
      La contraseña actual no coincide
      </div>';
   }else{
      $actualizarUsuario = $conn->prepare("UPDATE `usuarios` SET nombre = ?, apellido = ?, email = ? WHERE id = ?");
      $actualizarUsuario->execute([$nombre, $apellido, $email, $pid]);
      echo '<div class="container-fluid alert alert-success" role="alert">
      Modificado exitosamente
      </div>';
   }
   

   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   <title>Actualizar</title>
</head>

<body>
   
  

      <?php
      $update_id = $_GET['update'];
      $seleccionar_usuarios = $conn->prepare("SELECT * FROM `usuarios` WHERE id = ?");
      $seleccionar_usuarios->execute([$update_id]);
      if ($seleccionar_usuarios->rowCount() > 0) {
         while ($fila = $seleccionar_usuarios->fetch(PDO::FETCH_ASSOC)) {
      ?>
            <section class="justify-content-center container">


               <form action="" method="post" class="w-75 mx-auto col-lg-6">
                  <input type="hidden" name="pid" value="<?= $fila['id']; ?>">
                  <div class="row g-3">
                     <div class="col-auto col-sm">
                        <span>Nombre del Usuario</span>
                        <input type="text" class="form-control" required maxlength="20" value="<?= $fila['nombre']; ?>" minlength="2" placeholder="ingrese el nombre" name="nombre" pattern="[A-Za-z]{2,20}" title="Ingrese solo letras. Tamaño mínimo: 2. Tamaño máximo: 20">
                     </div>
                     <div class="col-auto col-sm">
                        <span>Apellido del Usuario</span>
                        <input type="text" class="form-control" required maxlength="20" minlength="2" value="<?= $fila['apellido']; ?>" placeholder="ingrese el apellido" name="apellido" pattern="[A-Za-z]{4,20}" title="Ingrese solo letras. Tamaño mínimo: 2. Tamaño máximo: 20">
                     </div>
                  </div>



                  <div class="input-caja">
                     <span>Correo</span>
                     <input type="email" class="form-control" required maxlength="30" minlength="6" placeholder="ingrese el correo" value="<?= $fila['email']; ?>" name="email" pattern="{6,30}" title="Tamaño máximo: 30" title="Ingrese solo letras y números. Tamaño mínimo: 6. Tamaño máximo: 30">
                  </div>



                  <div class="col-auto col-sm">
                     <span>Ingrese su contraseña para poder actualizar</span>
                     <input type="password" placeholder="ingrese una contraseña" maxlength="20" require minlength="4"  class="form-control" title="Tamaño mínimo: 4. Tamaño máximo: 20" name="password"  oninput="this.value = this.value.replace(/\s/g, '')">
                  </div>
                  <input type="hidden" name="prev_pass" value="<?= $fila['password']; ?>">


                  </div>
                     <div class="row"> 
                       <div class="col d-flex justify-content-start"> <input type="submit" value="Actualizar" class=" mt-2 mb-3 btn btn-danger btn-sm "      name="update">
                       </div>
                     
                      <div class="col d-flex justify-content-end"><a class=" mt-2 mb-3 btn btn-danger btn-sm " href="index.php">Volver</a></div> 
                     

                  </div>
                  
               </form>

            </section>






      <?php
         }
      } 
      ?>

   
</body>

</html>