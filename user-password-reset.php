<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');
require_once('app/dbconnection.php');
//Validamos la peticion de cambio de contraseña
if(isset($_POST['password']) 
  && isset($_POST['password_repeat'])
  && isset($_POST['token'])){
    $count_user = DB::query('SELECT COUNT(*) FROM user WHERE token=%s',$_POST['token']);
    if($count_user[0]['COUNT(*)'] > 0){
      $token_db = DB::query('SELECT token_expires FROM user WHERE token=%s',$_POST['token']);
      if($token_db[0]['token_expires'] > date("Y-m-d H:i:s")){
        DB::update('user', ['password' => md5($_POST['password'])], "token=%s", $_POST['token']);
        DB::update('user', ['token' => null,'token_expires' => null], "token=%s", $_POST['token']);
      }else{
        die("Peticion no válida. Reporta esto a un administrador");
      }
      $response['success'] = true;
    }else{
      $response['error'] = "No existe esta peticion. Reporta esto a un administrador.";
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit; 
  }
//Verificamos que el token en URL exista
if(!isset($_GET['token'])){
  RedirectTo($config['urlpath']);
  die();
}
require_once(getThemeFile('user-password-reset'));