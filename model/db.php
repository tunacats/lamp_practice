<?php

function get_db_connect(){
  // MySQL用のDSN文字列
  $dsn = 'mysql:dbname='. DB_NAME .';host='. DB_HOST .';charset='.DB_CHARSET;
 
  try {
    // データベースに接続
    $dbh = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    exit('接続できませんでした。理由：'.$e->getMessage() );
  }
  return $dbh;
}

function fetch_query($db, $sql, $params = array()){
  try{
    $statement = $db->prepare($sql);
    $statement->execute($params);
    return $statement->fetch();
  }catch(PDOException $e){
    set_error('データ取得に失敗しました。');
  }
  return false;
}

function fetch_all_query($db, $sql, $params = array()){
  try{
    $statement = $db->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll();
  }catch(PDOException $e){
    set_error('データ取得に失敗しました。');
  }
  return false;
}

function execute_query($db, $sql, $params = array()){
      // バインドのデータ型は必須か確認。必要な場合は実装方法検討。
    // 現状arrayで持ってきたパラメータはすべてSTRっぽい。
    // foreach($params as $key => $bind) {
    //   switch(gettype($bind)) {
    //     case 'boolean':
    //       $type = PDO::PARAM_BOOL;
    //       break;
    //     case 'integer':
    //       $type = PDO::PARAM_INT;
    //       break;
    //     case 'double':
    //       $type = PDO::PARAM_STR;
    //       break;
    //     case 'string':
    //       $type = PDO::PARAM_STR;
    //       break;
    //     case 'NULL':
    //       $type = PDO::PARAM_NULL;
    //       break;
    //     default:
    //       $type = PDO::PARAM_STR;
    //   }
    // }
    //$statement->bindValue($param_id, $value, $param_type);
    
  try{
    $statement = $db->prepare($sql);
    return $statement->execute($params);
  }catch(PDOException $e){
    set_error('更新に失敗しました。');
  }
  return false;
}