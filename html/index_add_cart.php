<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$post_CSRFtoken = $_POST['csrf_token'];

$db = get_db_connect();
$user = get_login_user($db);

$item_id = get_post('item_id');

if (is_valid_csrf_token($post_CSRFtoken)) {
  if(add_cart($db,$user['user_id'], $item_id)){
    set_message('カートに商品を追加しました。');
    $_SESSION['csrf_token'] = array();
    unset($_SESSION['csrf_token']);    
  } else {
    set_error('カートの更新に失敗しました。');
  }
}

redirect_to(HOME_URL);