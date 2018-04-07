<?php

class CartController
{
  public function displayAction()
  {
    // カート内容表示処理
    echo 'display';
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

