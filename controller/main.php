<?php
    require_once ('../model/connect.php');

    class Session{

    public function verifyData()
    {
        $connect = new SQL_Connect();
        $usuarios = $->getConn();


            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $enContrasena = md5($_POST['contrasena']);


            $validar_login = $usuarios->query("SELECT * FROM tbl_usuarios WHERE pass_user='$enContrasena' and mail_user='$correo'");

            if(mysqli_num_rows($validar_login) > 0){
                session_start();
                $_SESSION ['user'] = $correo;


                header('Location: ../view/panel.php');

            }else{
                header('Location: ../view/login.php');

            }
    }

}

    $validar = new Sesion();
    $ver = $validar->validarDatos();

?>