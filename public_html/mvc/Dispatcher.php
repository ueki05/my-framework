<?php

abstract class Dispatcher
{
  private $sysRoot;

  public function setSystemRoot($path)
  {
    $this->sysRoot = rtrim($path, '/');
  }

  public function dispatch()
  {
    // パラメーター取得（末尾の / は削除）
    $param = ereg_replace('/?$', '', $_GET['param']);
    $params = array();
    if ('' != $param) {
      // パラメーターを / で分割
      $params = explode('/', $param);
    }

    // １番目のパラメーターをコントローラーとして取得
    $controller = 'index';
    if (0 < count($params)) {
      $controller = $params[0];
    }

    // パラメータより取得したコントローラー名によりクラス振分け
    $className = ucfirst(strtolower($controller)) . 'Controller';

    // クラスファイル読込
    require_once $this->sysRoot . '/controllers/' . $className . '.php';

    // クラスインスタンス生成
    $controllerInstance = new $className();

    // 2番目のパラメーターをコントローラーとして取得
    $action= 'index';
    if (1 < count($params)) {
      $action= $params[1];
    }

    // アクションメソッドを実行
    $actionMethod = $action . 'Action';
    $controllerInstance->$actionMethod();
  }

  // 振分け処理を抽象化
  abstract protected function dispatchController($controller);
}

// 通販サイト振分け処理クラス
class TuuhanDispatcher extends Dispatcher
{
  // 振分け処理メソッドを実装
  protected function dispatchController($controller)
  {
    $controllerInstance = null;
    switch ($controller) {
    case 'list': 
      $controllerInstance = new ListController();
      break;
    case 'detail': 
      $controllerInstance = new DetailController();
      break;
    case 'cart': 
      $controllerInstance = new CartController();
      break;
    case 'customer': 
      $controllerInstance = new CustomerController();
      break;
    }
    return $controllerInstance;
  }
}

// お料理サイト振分け処理クラス
class CockingDispatcher extends Dispatcher
{
  // 振分け処理メソッドを実装
  protected function dispatchController($controller)
  {
    $controllerInstance = null;
    switch ($controller) {
    case 'recipe': 
      $controllerInstance = new RecipeController();
      break;
    case 'bbs': 
      $controllerInstance = new BbsController();
      break;
    case 'link': 
      $controllerInstance = new LinkController();
      break;
    }
    return $controllerInstance;
  }
}

?>
