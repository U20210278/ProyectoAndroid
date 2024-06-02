<?php
    function conectar(){
        //Credenciales
        $server = "localhost";
        $username = "root";
        $passwordd = "";
        $bd = "db_incidencias";        
        $idConexion = mysqli_connect($server,$username,$passwordd,$bd);
        if(!$idConexion){
            $idConexion = mysqli_error($idConexion);
        }
        return $idConexion;
    }

    function desconectar($idConexion){
        try{
            mysqli_close($idConexion);
            $estado = 1;
        }catch(Exception $e) {
            $estado = 0;
        }
         return $estado;
     }

    function registrar_usuario($nombre_completo,$nombre_usuario,$password, $idTipoUsuario, $correo){
        $idConexion = conectar();
        $sql = "INSERT INTO tbl_usuarios (nombre_completo,nombre_usuario,password,idTipoUsuario,correo) 
        VALUES ('$nombre_completo','$nombre_usuario','$password','$idTipoUsuario','$correo')";
        if(mysqli_query($idConexion, $sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function editar_usuario($id,$nombre_completo,$nombre_usuario,$password, $idTipoUsuario, $correo)
    {
        $idConexion = conectar();
        $sql = "UPDATE tbl_usuarios SET 
            nombre_completo = '$nombre_completo',
            nombre_usuario = '$nombre_usuario',
            password = '$password',
            idTipoUsuario = '$idTipoUsuario',
            correo = '$correo'
            WHERE idUsuario = $id
        ";

        if (mysqli_query($idConexion, $sql)){
            $estado = 1;
        }
        else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function eliminar_usuario($id){
        $idConexion = conectar();
        $sql = "DELETE FROM tbl_usuarios WHERE idUsuario = '$id'";

        if(mysqli_query($idConexion,$sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function listar_usuarios(){
        $idConexion = conectar();
        $datosFila = array();

        $consulta = "SELECT * FROM tbl_usuarios";
        $query = mysqli_query($idConexion, $consulta);
        $nfilas = mysqli_num_rows($query);

        if ($nfilas != 0){
            while ($aDatos = mysqli_fetch_array($query)) {
                $jsonfila = array();
                $jsonfila["idUsuario"] = $aDatos["idUsuario"];
                $jsonfila["nombre_completo"] = $aDatos["nombre_completo"];
                $jsonfila["nombre_usuario"] = $aDatos["nombre_usuario"];
                $jsonfila["password"] = $aDatos["password"];
                $jsonfila["idTipoUsuario"] = $aDatos["idTipoUsuario"];
                $jsonfila["correo"] = $aDatos["correo"];
                $datosFila[] = $jsonfila;
            }
        }   
        desconectar($idConexion);
        return array_values($datosFila);
    }

    function obtener_usuario_por_id($id){
        $idConexion = conectar();
        $datosFila = array();

        $consulta = "SELECT * FROM tbl_usuarios WHERE idUsuario = '$id'";
        $query = mysqli_query($idConexion, $consulta);
        $nfilas = mysqli_num_rows($query);
        
        if ($nfilas != 0){
            while ($aDatos = mysqli_fetch_array($query)) {
                $jsonfila = array();
                $jsonfila["idUsuario"] = $aDatos["idUsuario"];
                $jsonfila["nombre_completo"] = $aDatos["nombre_completo"];
                $jsonfila["nombre_usuario"] = $aDatos["nombre_usuario"];
                $jsonfila["password"] = $aDatos["password"];
                $jsonfila["idTipoUsuario"] = $aDatos["idTipoUsuario"];
                $jsonfila["correo"] = $aDatos["correo"];
                $datosFila[] = $jsonfila;
            }
        }   
        desconectar($idConexion);
        return array_values($datosFila);
    }

    function obtener_incidencia_por_id($id){
        $idConexion = conectar();
        $datosFila = array();

        $consulta = "SELECT * FROM tbl_incidentes WHERE idIncidente = '$id'";
        $query = mysqli_query($idConexion, $consulta);
        $nfilas = mysqli_num_rows($query);

        if ($nfilas != 0){
            $aDatos = mysqli_fetch_array($query);

            $jsonfila = array();
            $jsonfila["idIncidente"] = $aDatos["idIncidente"];
            $jsonfila["descripcion"] = $aDatos["descripcion"];
            $jsonfila["fecha"] = $aDatos["fecha"];
            $jsonfila["status"] = $aDatos["status"];   
            $jsonfila["idUsuario"] = $aDatos["idUsuario"];
            $jsonfila["idTipoIncidente"] = $aDatos["idTipoIncidente"];
            $jsonfila["img"] = $aDatos["img"];
            $datosFila[] = $jsonfila;
        }

        desconectar($idConexion);
        return array_values($datosFila);
    }

    function listar_incidencias(){
        $idConexion = conectar();
        $datosFila = array();

        $consulta = "SELECT * FROM tbl_incidentes";
        $query = mysqli_query($idConexion, $consulta);
        $nfilas = mysqli_num_rows($query);

        if ($nfilas != 0){
            while ($aDatos = mysqli_fetch_array($query)) {
                $jsonfila = array();
                $jsonfila["idIncidente"] = $aDatos["idIncidente"];
                $jsonfila["descripcion"] = $aDatos["descripcion"];
                $jsonfila["fecha"] = $aDatos["fecha"];
                $jsonfila["status"] = $aDatos["status"];
                $jsonfila["idUsuario"] = $aDatos["idUsuario"];
                $jsonfila["idTipoIncidente"] = $aDatos["idTipoIncidente"];
                $jsonfila["img"] = $aDatos["img"];
                $datosFila[] = $jsonfila;
            }
        }
        desconectar($idConexion);
        return array_values($datosFila);
    }

    function agregrar_incidencia(
        $descripcion,
        $fecha,
        $idUsuario,
        $idTipoIncidente,
        $img
    )
    {
        $idConexion = conectar();
        $sql = "INSERT INTO tbl_incidentes 
            (descripcion, fecha, idUsuario, idTipoIncidente, img)
            VALUES ('$descripcion', '$fecha', '$idUsuario', '$idTipoIncidente', '$img')";
        
        if (mysqli_query($idConexion, $sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function editar_incidencia(
        $id,
        $descripcion,
        $idTipoIncidente,
        $img
    )
    {
        $idConexion = conectar();
        $sql = "UPDATE tbl_incidentes SET 
            descripcion = '$descripcion',
            idTipoIncidente = '$idTipoIncidente',
            img = '$img'
            WHERE idIncidente = '$id'
        ";

        if (mysqli_query($idConexion, $sql)){
            $estado = 1;
        }
        else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function eliminar_incidencia($id){
        $idConexion = conectar();
        $sql = "DELETE FROM tbl_incidentes WHERE idIncidente = '$id'";

        if(mysqli_query($idConexion,$sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function actualizar_estado_incidencia($id) {
        $idConexion = conectar();
        $sql = "UPDATE tbl_incidentes SET 
            status = 'Inactivo'
            WHERE  idIncidente = '$id'";

        if (mysqli_query($idConexion, $sql)){
            $estado = 1;
        }
        else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }

    function listar_tipo_usuario(){
        $idConexion = conectar();
        $datosFila = array();
        // Consulta SQL con filtro
        $consulta = "SELECT idTipoUsuario, tipo_usuario FROM tbl_tipo_usuario ORDER BY tipo_usuario ASC";

        $query = mysqli_query($idConexion, $consulta);
        $nfilas = mysqli_num_rows($query);

        if($nfilas != 0){
            while($aDatos = mysqli_fetch_array($query)){
                $jsonfila = array();
                $jsonfila["idTipoUsuario"] = $aDatos["idTipoUsuario"];
                $jsonfila["tipo_usuario"] = $aDatos["tipo_usuario"];
                $datosFila[] = $jsonfila;
            }
        }
        desconectar($idConexion);
        return array_values($datosFila);
    }

    

    /*

    function modificarContacto($id_contacto, $nombre, $telefono, $genero){
        $idConexion = conectar();
        $sql = "UPDATE contactos SET nombre='$nombre', telefono='$telefono', genero='$genero' WHERE id_contacto='$id_contacto'";
        if(mysqli_query($idConexion, $sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }







    function eliminarContacto($id_contacto){
        $idConexion = conectar();
        $sql = "DELETE FROM contactos WHERE id_contacto='$id_contacto'";
        if(mysqli_query($idConexion,$sql)){
            $estado = 1;
        }else{
            $estado = "Error: ". mysqli_error($idConexion);
        }
        desconectar($idConexion);
        return $estado;
    }
*/?>