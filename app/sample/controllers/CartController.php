<?php

class CartController extends ControllerBase
{
  // コンストラクタ
  public function __counstruct()
  {
    // リクエスト
    $this->request = new Request();

    // ビュー
    $this->view = new Smarty();
    $this->view->template_dir = '../view/templates';
  }

  public function displayAction()
  {
    $params = $this->request->getParam();
    $userId = $params['user_id'];

    // カート基本情報を取得
    $cart = new Cart();
    $cartInfo = $cart->getInfo($userId);
    $this->view->assign('cart_info', $cartInfo);
  }

  public function addAction()
  {
    // 追加する商品の商品IDをPOSTから取得
    $post = $this->request->getPost();
    // 商品追加処理
    $cart = new Cart();
    $cartInfo = $cart->addProduct($post['cart_id'], $post['product_id']);

    // カート商品一覧へリダイレクト
    header('Location: http://www.xxx.com/cart/display');
  }

  public function inputAction()
  {
    // 購入情報入力フォーム表示処理
    echo 'input';
  }

  public function buyAction()
  {
    if (isset($_POST['buy'])) {
      // 購入処理
      echo 'buy post';
    }

    // 購入完了画面表示処理
    echo 'buy';
  }
}

