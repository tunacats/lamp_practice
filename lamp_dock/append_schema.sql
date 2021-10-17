-- ----------------------------------------------- 
-- テーブルの構造
-- -----------------------------------------------
CREATE TABLE 'order_histories' (
    'order_id' int(11) NOT NULL,
    'user_id' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE 'order_details' (
    'order_id' int(11) NOT NULL,
    'item_id' int(11) NOT NULL,
    'price' int(11) NOT NULL,
    'amount' int(11) NOT NULL,
    'created' datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------
-- テーブルのAUTO_INCREMENT 
-- -----------------------------------------------
ALTER TABLE 'order_histories'
    MODIFY 'order_id' int(11) NOT NULL AUTO_INCREMENT;

-- -----------------------------------------------
-- テーブルのインデックス 
-- -----------------------------------------------
ALTER TABLE 'order_histories' (
    ADD PRIMARY KEY ('order_id'),
    ADD KEY 'user_id' ('user_id');
)

ALTER TABLE 'order_details' (
    ADD KEY 'item_id' ('item_id');
)
