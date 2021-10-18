<?
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// ユーザごとの購入履歴の取得 (動作確認済)
function get_order_history($db, $user_id) {
    $sql = 'SELECT order_histories.order_id, order_histories.created,
            SUM(order_details.price * order_details.amount) AS total
            FROM order_histories JOIN order_details 
            ON order_histories.order_id = order_details.order_id
            WHERE user_id=?
            GROUP BY order_id
            ORDER BY created desc';
    return fetch_all_query($db, $sql, array($user_id));
}

// ユーザごとの購入明細の取得 (動作確認済)
function get_order_detail($db, $order_id) {
    $sql = 'SELECT order_details.price, order_details.amount, order_details.created,
            SUM(order_details.price * order_details.amount) AS total,
            items.name
            FROM order_details JOIN items
            ON order_details.item_id = items.item_id
            WHERE order_id=?
            GROUP BY order_details.price, order_details.amount, order_details.created, items.name';
    return fetch_all_query($db, $sql, array($order_id));
}