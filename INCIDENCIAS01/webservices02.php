<?php
    require("config.php");
    $datos = array();
    $accion = "";

    if(isset($_POST["accion"])){
        $accion = $_POST["accion"];
    }

        
    if($accion == "registrar_usuario"){
    
        $nombre_completo = $_POST["nombre_completo"];
        $nombre_usuario = $_POST["nombre_usuario"];
        $password = $_POST["password"];
        $idTipoUsuario = $_POST["idTipoUsuario"];
        $correo = $_POST["correo"];

        if(registrar_usuario($nombre_completo,$nombre_usuario,$password,$idTipoUsuario,$correo) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Datos Almacenados con éxito"; 
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo almacenar los datos"; 
        }        
    }

    else if ($accion == "editar_usuario"){
        $id_usuario = $_POST["id_usuario"];
        $nombre_completo = $_POST["nombre_completo"];
        $nombre_usuario = $_POST["nombre_usuario"];
        $password = $_POST["password"];
        $idTipoUsuario = $_POST["idTipoUsuario"];
        $correo = $_POST["correo"];

        if (editar_usuario($id_usuario, $nombre_completo, $nombre_usuario ,$password, $idTipoUsuario, $correo) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Datos modificados con exito";
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo modificar los datos"; 
        }
    }

    else if ($accion == "eliminar_usuario"){
        $id_usuario = $_POST["id_usuario"];
        if (eliminar_usuario($id_usuario) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Usuario eliminado con éxito"; 
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo eliminar el usuario"; 
        }
        
    }

    else if($accion == "obtener_usuario_por_id"){
        $id_usuario = (int)$_POST["id_usuario"];
        $datos["estado"] = 1;
        $datos["resultado"] = obtener_usuario_por_id($id_usuario);
    }

    else if ($accion == "obtener_incidencia_por_id"){
        $id_incidencia = (int)$_POST["id_incidencia"];
        $datos["estado"] = 1;
        $datos["resultado"] = obtener_incidencia_por_id( $id_incidencia );
    }

    else if ($accion == "agregar_incidencia"){
        $descripcion = $_POST["descripcion"];
        $fecha = date("d-m-Y h:i:s");
        $id_usuario = $_POST["idUsuario"];
        $id_tipo_incidente = $_POST["id_tipo_incidente"];
        $img = $_POST["img"];

        if (agregrar_incidencia($descripcion,$fecha, $id_usuario, $id_tipo_incidente,$img) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Incidente registrado correctamente"; 
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo registrar el incidente"; 
        }        
    }

    else if ($accion == "editar_incidencia"){
        $id_incidencia = $_POST["id_incidencia"];
        $descripcion = $_POST["descripcion"];
        $id_tipo_incidente = $_POST["id_tipo_incidente"];
        $img = $_POST["img"];

        if (editar_incidencia($id_incidencia, $descripcion, $id_tipo_incidente, $img) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Datos modificados con exito";
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo modificar los datos"; 
        }
    }

    else if ($accion == "eliminar_incidencia"){
        $id_incidencia = $_POST["id_incidencia"];

        if (eliminar_incidencia($id_incidencia) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "Incidencia eliminada con éxito"; 
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo eliminar el registro"; 
        }
    }

    else if ($accion == "actualizar_estado_incidencia"){
        $id_incidencia = $_POST["id_incidencia"];
        if (actualizar_estado_incidencia($id_incidencia) == 1){
            $datos["estado"] = 1;
            $datos["resultado"] = "El estado se actualizo con exito";
        }else{
            $datos["estado"] = 0;
            $datos["resultado"] = "Error, no se pudo modificar el estado"; 
        }
    }

    else if ($accion == "listar_incidencias"){
        $datos["estado"] = 1;
        $datos["resultado"] = listar_incidencias();
    }
    
    else if ($accion == "listar_usuarios"){
        $datos["estado"] = 1;
        $datos["resultado"] = listar_usuarios();
    }
    
    else if ($accion == "listar_tipo_usuario") {
        $datos["estado"] = 1;
        $datos["resultado"] = listar_tipo_usuario();
    }
    
   /*
        else if($accion == "modificar"){
         $id_contacto = $_POST["id_contacto"];
         $nombre = $_POST["nombre"];
         $telefono = $_POST["telefono"];
         $genero = $_POST["genero"];  // Nuevo campo para el género
 
         if(modificarContacto($id_contacto, $nombre, $telefono, $genero) == 1){
             $datos["estado"] = 1;
             $datos["resultado"] = "Datos Modificados con éxito"; 
         }else{
             $datos["estado"] = 0;
             $datos["resultado"] = "Error, no se pudo modificar los datos"; 
         }
    }
    
    else if($accion == "eliminar"){
      $id_contacto = $_POST["id_contacto"];        
      if(eliminarContacto($id_contacto) == 1){
          $datos["estado"] = 1;
          $datos["resultado"] = "Datos Eliminados con éxito"; 
      }else{
          $datos["estado"] = 0;
          $datos["resultado"] = "Error, no se pudo eliminar los datos"; 
      }
  }*/

    echo json_encode($datos);

    ?>