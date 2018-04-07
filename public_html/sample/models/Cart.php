<?php

class Cart
{
  private $db;
  private $headerTable = 'cart_header';
  private $detailTable = 'cart_detail';

  public function __construct($user, $pass)
  {
    $this->db = new PDO($user, $pass);
  }

  // 新規カート作成
  public function create($userId)
  {
    $sql = sprintf('INSERT INTO %s ・・・・・・・・', $this->headerTable);
    $res = $this->db->query($sql);
    return $res;
  }

  // 商品リスト取得
  public function getList($cartId)
  {
    $sql = sprintf('SELECT * FROM %s where cart_id = :cart_id', $this->detailTable);
    $stmt = $this->db->query($sql);
    $stmt->bindValue(':cart_id', $cartId);
    $rows = $stmt->fetchAll();
    return $rows;
  }

  // 商品追加
  public function add($data)
  {
    $sql = sprintf('INSERT INTO %s ・・・・・・・・', $this->detailTable);
    $res = $this->db->query($sql);
    return $res;
  }

}
