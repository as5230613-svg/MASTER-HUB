<?php

include("conexion.php");


// VALIDAR DATOS
if(
    empty($_POST['nombre']) ||
    empty($_POST['correo']) ||
    empty($_POST['password']) ||
    empty($_POST['confirmPassword'])
){

    echo "
    <script>
        alert('Completa todos los campos');
        window.history.back();
    </script>
    ";

    exit();

}


// RECIBIR DATOS
$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];


// VALIDAR CONTRASEÑAS
if($password != $confirmPassword){

    echo "
    <script>
        alert('Las contraseñas no coinciden');
        window.history.back();
    </script>
    ";

    exit();

}


// VERIFICAR SI EL CORREO YA EXISTE
$verificar = "SELECT * FROM usuarios WHERE correo='$correo'";

$resultado = mysqli_query($conexion, $verificar);


if(mysqli_num_rows($resultado) > 0){

    echo "
    <script>
        alert('El correo ya está registrado');
        window.history.back();
    </script>
    ";

    exit();

}


// INSERTAR USUARIO
$sql = "INSERT INTO usuarios(nombre, correo, password)
VALUES('$nombre', '$correo', '$password')";


// EJECUTAR
if(mysqli_query($conexion, $sql)){

    echo "
    <script>
        alert('Registro exitoso');
        window.location='../inicio_sesion.html';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Error al registrar usuario');
        window.history.back();
    </script>
    ";

}


// CERRAR CONEXIÓN
mysqli_close($conexion);

?>
