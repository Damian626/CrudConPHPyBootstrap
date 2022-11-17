<?php

include 'connect.php';


if (isset($_POST['agregar'])) {

    $nombre = $_POST['nombre'];
    $nombre = filter_var($nombre);
    $apellido = $_POST['apellido'];
    $apellido = filter_var($apellido);
    $email = $_POST['email'];
    $email = filter_var($email);
    $password = sha1($_POST['password']);
    $password = filter_var($password);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass);



    $selec_usuario = $conn->prepare("SELECT * FROM `usuarios` WHERE email = ?");
    $selec_usuario->execute([$email]);

    if ($selec_usuario->rowCount() > 0) {
        echo '<div class="container-fluid alert alert-danger" role="alert">
        El correo electronico ya esta en uso
        </div>';
    } else {
        if ($password != $cpass) {
            echo '<div class="container-fluid alert alert-danger" role="alert">
               ¡No coinciden las contraseñas! Vuelva a intertarlo
            </div>';
        } else {
            $sql = $conn->prepare("INSERT INTO `usuarios`(nombre, apellido, email, password) VALUES(?,?,?,?)");
            $sql->execute([$nombre, $apellido, $email, $password]);
            echo '<div class="container-fluid alert alert-success" role="alert">
            Nuevo usuario agregado
          </div>';
        }
    }
};




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
    <title>Agregar</title>
</head>

<body>
    <div class="row m-0 text-center align-items-center justify-content-center">
        <div class="col-auto"> <button type="button" class=" btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
        Agregar Usuario
    </button></div>
    </div>
    
   
    
    
    
    <div class=" modal opacity-100 " id="myModal">
        <div class="modal-dialog ">
            <div class="modal-content">

                
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                
                <div class="modal-body flex-colum">

                    <section class="justify-content-center container">


                        <form action="" method="post" class="w-75 mx-auto col-lg-6">

                            <div class="row g-3">
                                <div class="col-auto col-sm">
                                    <span>Nombre del Usuario</span>
                                    <input type="text" class="form-control" required maxlength="20" minlength="2" placeholder="ingrese el nombre" name="nombre" pattern="[A-Za-z]{2,20}" title="Ingrese solo letras. Tamaño mínimo: 2. Tamaño máximo: 20">
                                </div>
                                <div class="col-auto col-sm">
                                    <span>Apellido del Usuario</span>
                                    <input type="text" class="form-control" required maxlength="20" minlength="2" placeholder="ingrese el apellido" name="apellido" pattern="[A-Za-z]{4,20}" title="Ingrese solo letras. Tamaño mínimo: 2. Tamaño máximo: 20">
                                </div>
                            </div>



                            <div class="input-caja">
                                <span>Ingrese un correo</span>
                                <input type="email" class="form-control" required maxlength="30" minlength="6" placeholder="ingrese el correo" name="email" pattern="{6,30}" title="Tamaño máximo: 30" title="Ingrese solo letras y números. Tamaño mínimo: 6. Tamaño máximo: 30">
                            </div>



                            <div class="col-auto col-sm">
                                <span>Ingrese una contraseña</span>
                                <input type="password" required placeholder="ingrese una contraseña" maxlength="20" minlength="4" class="form-control" title="Tamaño mínimo: 4. Tamaño máximo: 20" name="password">
                            </div>

                            <div class="col-auto col-sm">
                                <span>Repita contraseña</span>
                                <input type="password" required placeholder="ingrese una contraseña" maxlength="20" minlength="4" class="form-control" title="Tamaño mínimo: 4. Tamaño máximo: 20" name="cpass">
                            </div>


                </div>

                <input type="submit" value="Agregar Usuario" class="d-block mx-auto mt-2 mb-3 btn btn-danger btn-sm " name="agregar">
                </form>

                </section>
            </div>


        </div>
    </div>
    </div>
</body>

</html>