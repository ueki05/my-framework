<?php

abstract class ControllerBase
{
  protected $systemRoot;
  protected $controller = 'index';
  protected $action = 'index';
  protected $view;
  protected $request;
  protected $templatePath;

  // コンストラクタ
  public function __construct()
  {
    $this->request = new Request();
  }

  // システムのルートディレクトリパスを設定
  public function setSystemRoot($path)
  {
    $this->systemRoot = $path;
  }

  // コントローラーとアクションの文字列設定
  public function setControllerAction($controller, $action)
  {
    $this->controller = $controller;
    $this->action = $action;
  }

  // 処理実行
  public function run()
  {
    try {

      // ビューの初期化
      $this->initializeView();

      // 共通前処理
      $this->preAction();

      // アクションメソッド
      $methodName = sprintf('%sAction', $this->action);
      $this->$methodName();

      // 表示
      $this->view->display($this->templatePath);

    } catch (Exception $e) {
      // ログ出力等の処理を記述
      echo $e->getMessage();
    }
  }

  // モデルインスタンス生成処理
  protected function createModel($className)
  {
    $classFile = sprintf('%s/app/models/%s.php', $this->systemRoot, $className);
    if (false == file_exists($classFile)) {
      return false;
    }
    require_once $classFile;
    if (false == class_exists($className)) {
      return false;
    }
    return new $className();
  }


  // ビューの初期化
  protected function initializeView()
  {
    $this->view = new Smarty();

    $this->view->setTemplateDir(sprintf('%s/views/templates/', $this->systemRoot));
    $this->view->setCompileDir(sprintf('%s/views/templates_c/', $this->systemRoot));

    $this->templatePath = sprintf('%s/%s.tpl', $this->controller, $this->action);
  }

  // 共通前処理（オーバーライド前提）
  protected function preAction()
  {
  }
}
