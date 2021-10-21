<?php
    require_once '../conf/const.php';
    require_once MODEL_PATH . 'functions.php';
    require_once MODEL_PATH . 'cart.php';
    require_once MODEL_PATH . 'item.php';
    require_once MODEL_PATH . 'user.php';
    require_once MODEL_PATH . 'order_history.php';

    session_start();

    if (is_logined() === false) {
        redirect_to(LOGIN_URL);
    }

    $db = get_db_connect();
    $user = get_login_user($db);
    $order_id = get_post('order_id');
    
    // ユーザーIDに紐づく購入履歴を全県取得
    $histories = get_order_history($db, $user['user_id']);

    // order_idのみを$historiesから一旦全件取得
    $order_idArray = array_column($histories, 'order_id');

    // $order_idが含まれる配列番号を取得
    $array_number = array_search($order_id, $order_idArray);

    // 購入履歴から指定された配列番号のデータを $selected_historyへ代入
    $selected_history = $histories[$array_number];

    $details = get_order_detail($db, $order_id);   

    include_once VIEW_PATH . 'order_detail_view.php';
?>