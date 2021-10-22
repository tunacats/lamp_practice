<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <meta charset="UTF-8">
        <title>購入履歴</title>
        <link rel="stylesheet" href="<?= (STYLESHEET_PATH . ''); ?>">
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <h1>購入履歴</h1>

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <?php if (!empty($histories)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>購入日時</th>
                        <th>合計金額</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($histories as $history) { ?>
                        <tr>
                            <td><?= number_format($history['order_id']); ?></td>
                            <td><?= h($history['created']); ?></td>
                            <td><?= number_format($history['total']); ?></td>
                            <td>
                                <form method="post" action="order_detail.php">
                                    <input type="submit" value="購入明細表示">
                                    <input type="hidden" name="order_id" value="<?= number_format($history['order_id']); ?>">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <p>購入履歴はありません。</p>
        <?php } ?>
    </body>
</html>