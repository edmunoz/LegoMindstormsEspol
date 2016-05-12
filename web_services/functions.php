<?php
include_once "connection.php";

/**
 * Login del usuario.
 *
 * @param string $email
 * @param string $password
 * @return array
 */
function login_user($email, $password){
    $connection = db_connect();
    $login = array();    
    $query = "SELECT * FROM User WHERE email = '$email';";
    $result = mysqli_query($connection,$query);    
    if (!$result){
        $login[] = array(
            'idUser'    => '',
            'Name'      => '',
            'Username'  => '',
            'Email'     => '',
            'Password'  => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            if ($row['Password'] == $password){
                $login[] = array(
                    'idUser'    => $row['idUser'],
                    'Name'      => $row['Name'],
                    'Username'  => $row['Username'],
                    'Email'     => $row['Email'],
                    'Password'  => $row['Password']
                );
            }
        }
    }
    mysqli_close($connection);
    return $login;
}

/**
 * Método para insertar un nuevo usuario
 * a la base de datos.
 *
 * @param string $name
 * @param string $username
 * @param string $email
 * @param string $password
 * @return string
 */
function insert_user($name, $email, $password){
    $connection = db_connect();
    $response = '';
    $query = "INSERT INTO User(Name, Email, Password) "
            ."VALUES "
            ."('$name', '$email', '$password');";
    $result = mysqli_query($connection, $query);
    if (!$result){
        $response = 'ERROR : Insert fallido -> ' . mysqli_error($connection);
    }
    else{
        $response = '1';
    }
    mysqli_close($connection);
    return $response;
}

function get_categories(){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Category;";
    $result = mysqli_query($connection,$query);
    if (!$result){
        $response[] = array(
            'idCategory'    => '',
            'Name'  => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idCategory'    => $row['idCategory'],
                'Name'          => $row['Name']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function get_bloques(){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Bloque;";
    $result = mysqli_query($connection,$query);
    if (!$result){
        $response[] = array(
            'idBloque'              => '',
            'Category_idCategory'   => '',
            'Title'                 => '',
            'Description'           => '',
            'Image'                 => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idBloque'              => $row['idBloque'],
                'Category_idCategory'   => $row['Category_idCategory'],
                'Title'                 => $row['Title'],
                'Description'           => $row['Description']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function get_talleres(){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Taller;";
    $result = mysqli_query($connection,$query);
    if (!$result){
        $response[] = array(
            'idTaller'    => '',
            'Title'  => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idTaller'    => $row['idTaller'],
                'Title'          => $row['Title']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function get_preguntas($idTaller){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Pregunta WHERE Taller_idTaller = '$idTaller';";
    $result = mysqli_query($connection, $query);
    if (!$result){
        $response[] = array(
            'idPregunta'        => '',
            'Taller_idTaller'   => '',
            'Name'              => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idPregunta'        => $row['idPregunta'],
                'Taller_idTaller'   => $row['Taller_idTaller'],
                'Name'              => $row['Name']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function get_respuestas($idPregunta){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Respuesta WHERE Pregunta_idPregunta = '$idPregunta';";
    $result = mysqli_query($connection, $query);
    if (!$result){
        $response[] = array(
            'idRespuesta'           => '',
            'Pregunta_idPregunta'   => '',
            'Name'                  => '',
            'Valido'                => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idRespuesta'           => $row['idRespuesta'],
                'Pregunta_idPregunta'   => $row['Pregunta_idPregunta'],
                'Name'                  => $row['Name'],
                'Valido'                => $row['Valido']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function get_imagen_taller($idTaller){
    $connection = db_connect();
    $response = array();
    $query = "SELECT * FROM Imagen_Taller WHERE Taller_idTaller = '$idTaller';";
    $result = mysqli_query($connection, $query);
    if (!$result){
        $response[] = array(
            'idImagenTaller'    => '',
            'Foto'              => '',
            'Taller_idTaller'   => 'Error en consulta -> '. mysqli_error($connection));
    }
    else{
        while ($row = mysqli_fetch_array($result)){
            $response[] = array(
                'idImagenTaller'    => $row['idImagenTaller'],
                'Foto'              => $row['Foto'],
                'Taller_idTaller'   => $row['Taller_idTaller']
            );
        }
    }
    mysqli_close($connection);
    return $response;
}

function insert_user_taller($idUser, $idTaller, $puntaje){
    $connection = db_connect();
    $response = '';
    $query = "INSERT INTO User_has_Taller (User_idUser, Taller_idTaller, Puntaje) "
        ."VALUES "
        ."('$idUser', '$idTaller', '$puntaje');";
    $result = mysqli_query($connection, $query);
    if (!$result){
        $response = 'ERROR : Insert fallido -> ' . mysqli_error($connection);
    }
    else{
        $response = '1';
    }
    mysqli_close($connection);
    return $response;
}

//var_dump(get_preguntas('1'));
