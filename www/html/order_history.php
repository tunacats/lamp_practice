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

    if (is_admin($user)) {
        $histories = get_all_order_history($db);
    } else {
        $histories = get_order_history($db, $user['user_id']);
    }

    $order_id = get_post('order_id');

    include_once VIEW_PATH . 'order_history_view.php';
?>