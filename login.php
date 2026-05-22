<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("conexion.php");

if(isset($_POST['correo']) && isset($_POST['password'])){

    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($resultado) > 0){

        $fila = mysqli_fetch_assoc($resultado);

        // VALIDAR PASSWORD
        if($password === $fila['password']){

            /* =========================
               GUARDAR SESIONES
            ========================= */

            $_SESSION['id'] = $fila['id'];
            $_SESSION['id_usuario'] = $fila['id'];
            $_SESSION['usuario'] = $fila['nombre'];
            $_SESSION['correo'] = $fila['correo'];
            $_SESSION['rol'] = $fila['rol'];

            // REDIRECCIONES POR ROL
            if($fila['rol'] == "cliente"){

                echo "
                <script>

                    localStorage.setItem('usuario', '".$fila['nombre']."');
                    localStorage.setItem('rol', '".$fila['rol']."');

                    window.location.href='../cliente.php';

                </script>
                ";

                exit();

            }elseif($fila['rol'] == "admin"){

                echo "
                <script>

                    localStorage.setItem('usuario', '".$fila['nombre']."');
                    localStorage.setItem('rol', '".$fila['rol']."');

                    window.location.href='../admin.php';

                </script>
                ";

                exit();

            }elseif($fila['rol'] == "maestro"){

                echo "
                <script>

                    localStorage.setItem('usuario', '".$fila['nombre']."');
                    localStorage.setItem('rol', '".$fila['rol']."');

                    window.location.href='../maestro.php';

                </script>
                ";

                exit();

            }else{

                echo "Rol inválido";

            }

        }else{

            echo "Contraseña incorrecta";

        }

    }else{

        echo "Usuario no encontrado";

    }

}else{

    echo "Completa todos los campos";

}

?>