<?php

class CartController
{
  private $request;

  // コンストラクタ
  public function __counstruct()
  {
    // リクエスト
    $this->request = new Request();
  }

  public function displayAction()
  {
    // カート内容表示処理
    echo 'display';
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

