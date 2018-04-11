<?php

class Cart
{
  // カート情報を取得
  public function getCartInfo($userId)
  {
    $cart = new CartHeader();
    $cartDetail = new CartDetail();

    $cartInfo = $cart->getUserCart($userId);
    $products = $cartDetail->getProductList($cartInfo['cart_id']);
    $cartInfo['products'] = $products;

    return $cartInfo;
  }

  // 商品追加
  public function addProduct($cartId, $productId)
  {
    $db = new PDO();
    $db->beginTransaction();
    try
    {
      $cart = new CartHeader();
      $cartDetail = new CartDetail();

      // カートに商品を追加
      $cartDetail->add($productId);

      // カート情報の合計金額を更新
      $cart->updateTotalPrice($cartId);

      $db->commit();
      return true;

    } catch (Exception $e) {
      $db->rollback();
      throw $e;
    }
  }
}
