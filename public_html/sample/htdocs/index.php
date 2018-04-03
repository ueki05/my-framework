<?php

// システムのルートディレクトリパス
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
// ライブラリのディレクトリパス
define('LIB_PATH', realpath(dirname(__FILE__) . '/../../../library'));

// ライブラリとモデルのディレクトリをinclude_pathに追加
$includes = array(LIB_PATH . '/mvc', ROOT_PATH . '/models');
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

// クラスのオートロード
function __autoload($className){
  require_once $className . ".php";
}

// データベース接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'sample',
    'dbuser'   => 'hoge',
    'password' => 'xxxxxxxx'
);

ModelBase::setConnectionInfo($connInfo);

// リクエスト処理
$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot(ROOT_PATH);
$dispatcher->dispatch();
