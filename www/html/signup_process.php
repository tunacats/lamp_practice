<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}

$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

$db = get_db_connect();

$postToken = get_post('csrf_token');
$validResult = is_valid_csrf_token($postToken);

if ($validResult === true) {
  try{
    $result = regist_user($db, $name, $password, $password_confirmation);
    if( $result=== false){
      set_error('ユーザー登録に失敗しました。');
      redirect_to(SIGNUP_URL);
    }
  }catch(PDOException $e){
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
  }
  
  set_message('ユーザー登録が完了しました。');
  login_as($db, $name, $password);
  redirect_to(HOME_URL);
} else {
  set_error('不正な操作です。最初からやり直してください。');
  redirect_to(SIGNUP_URL);
}