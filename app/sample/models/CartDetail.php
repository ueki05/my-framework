<?php

class CartDetail extends ModelBase
{
  private $name = 'cart_detail';

  // 商品リスト取得
  public function getList($cartId)
  {
    $sql = sprintf('SELECT * FROM %s where cart_id = :cart_id', $this->name);
    $params = array('cart_id' => $cartId);
    $rows = $this->query($sql, $params);
    return $rows;
  }

  // 商品追加
  public function add($data)
  {
    $sql = sprintf('INSERT INTO %s ・・・・・・・・', $this->name);
    $res = $this->insert($sql);
    return $res;
  }

  // 商品削除
  public function remove($productId)
  {
    $sql = sprintf('DELETE FROM %s WHERE ・・・・・・・・', $this->name);
    $res = $db->query($sql);
    return $res;
  }
}
