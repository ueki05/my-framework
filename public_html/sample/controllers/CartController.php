<?php

class CartController
{
  private $request;
  private $view;

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
    $req= new Request();
    $params = $req->getQuery();
    $userId = $params['user_id'];

    // カート基本情報を取得
    $cart = new CartHeader();
    $cartInfo = $cart->getUserCart($userId);

    // 商品一覧を取得
    $cartDetail = new CartDetail();
    $products = $cartDetail->getProductList($cartInfo['cart_id']);

    // テンプレートへ変数割り当て
    $this->view->assign('cart_info', $cartInfo);
    $this->view->assign('prouducts', $products);

    // テンプレート表示
    $this->view->display('cart/display.tpl');
  }

  public function addAction()
  {
    // 追加する商品の商品IDをPOSTから取得
    $post = $this->request->getPost();
    $productId = $post['product_id'];

    // カートへの商品の追加処理
    echo 'add';
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

