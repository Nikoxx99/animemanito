<?php
require_once('app/config.php');
require_once('app/session.php');
require_once('app/functions.php');

if (isset($_POST['email']) )
    {
      
        require_once('app/dbconnection.php');
        $response = array();
        $email = trim($_POST['email']);

        $mail_test = DB::query('SELECT COUNT(*) FROM user WHERE email=%s',$email);
        if($mail_test[0]['COUNT(*)'] < 1){
          $response['error'] = "El Correo que ingresaste no corresponde con ninguna cuenta.";
        }else{
          $data['user'] = DB::query('SELECT * FROM user WHERE email=%s',$email);
          $token = bin2hex(random_bytes(16));
          DB::update('user', ['token' => $token, 'token_expires' => DB::sqleval("NOW() + INTERVAL 48 HOUR")], "email=%s", $email);
          $send_token = DB::query('SELECT token FROM user WHERE email=%s',$email);
          if($data['user'][0]['token_expires'] > date("Y-m-d H:i:s")){
            send_mail($email,$token);
            $response['success'] = true;
          }else{
            $response['error'] = "Esta peticion expiro.";
          }
        }
        if (!isset($response['error']))
        {
            $response['success'] = true;
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
        exit;
    }


require_once(getThemeFile('user-forgot-password'));
