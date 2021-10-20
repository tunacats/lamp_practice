<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <meta charset="UTF-8">
        <title>購入明細</title>
        <link rel="stylesheet" href="<?= (STYLESHEET_PATH . ''); ?>">
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        
        <h1>購入明細</h1>
        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <!--購入明細-->
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
                        <td><?= h($history['order_id']); ?></td>
                        <td><?= h($history['created']); ?></td>
                        <td><?= h($history['total']); ?></td>
                        <td>
                            <form method="post" action="order_detail.php">
                                <input type="submit" value="購入明細表示">
                                <input type="hidden" name="order_id" value="<?= h($history['order_id']); ?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>購入数</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($details as $detail) { ?>
                    <tr>
                        <td><?= h($detail['name']); ?></td>
                        <td><?= h($detail['price']); ?></td>
                        <td><?= h($detail['amount']); ?></td>
                        <td><?= h($detail['total']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>