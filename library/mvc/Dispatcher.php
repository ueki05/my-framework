<?php

require_once("Smarty/Smarty.class.php");
require_once '../../library/Request.php';

class Dispatcher
{
  private $sysRoot;

  public function setSystemRoot($path)
  {
    $this->sysRoot = rtrim($path, '/');
  }

  /**
   * 振分け処理実行
   */
  public function dispatch()
  {
    // パラメーター取得（末尾の / は削除）
    $param = preg_replace('/\/?$/', '', $_SERVER['REQUEST_URI']);

    $params = array();
    if ('' != $param) {
      // パラメーターを / で分割
      $params = explode('/', $param);
    }

    // １番目のパラメーターをコントローラーとして取得
    $controller = "index";
    if (1 < count($params)) {
      $controller = $params[1];
    }

    // １番目のパラメーターをもとにコントローラークラスインスタンス取得
    $controllerInstance = $this->getControllerInstance($controller);
    if (null == $controller) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }

    // 2番目のパラメーターをコントローラーとして取得
    $action= 'index';
    if (2 < count($params)) {
      $action= $params[2];
    }
    // アクションメソッドの存在確認
    if (false == method_exists($controllerInstance, $action . 'Action')) {
      header("HTTP/1.0 404 Not Found");
      exit;
    }

    // コントローラー初期設定
    $controllerInstance->setSystemRoot($this->sysRoot);
    $controllerInstance->setControllerAction($controller, $action);
    // 処理実行
    $controllerInstance->run();
  }

  // コントローラークラスのインスタンスを取得
  private function getControllerInstance($controller)
  {
    // 一文字目のみ大文字に変換＋"Controller"
    $className = ucfirst(strtolower($controller)) . 'Controller';
    // コントローラーファイル名
    $controllerFileName = sprintf('%s/app/controllers/%s.php', $this->sysRoot, $className);
    // ファイル存在チェック
    if (false == file_exists($controllerFileName)) {
      return null;
    }
    // クラスファイルを読込
    require_once $controllerFileName;
    // クラスが定義されているかチェック
    if (false == class_exists($className)) {
      return null;
    }
    // クラスインスタンス生成
    $controllerInstarnce = new $className();

    return $controllerInstarnce;
  }

  protected function transferControler($controller)
  {
    $iniPath = $this->systemRoot . '/ini/transfer.ini';
    if (true == file_exists($iniPath)) {
      $ini = parse_ini_file($iniPath);
      if (true == array_key_exists($controller, $ini)) {
        $controller = $ini[$controller];
      }
    }
    return $controller;
  }
}
