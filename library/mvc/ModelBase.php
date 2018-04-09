<?php

class ModelBase
{
  private static $connInfo;
  protected $db;
  protected $name;

  public function __construct()
  {
    $this->initDb();
  }

  public function initDb()
  {
    $dsn = sprintf(
      'mysql:host=%s;dbname=%s;port=8889;',
      self::$connInfo['host'],
      self::$connInfo['dbname']
    );
    $this->db = new PDO($dsn, self::$connInfo['dbuser'], self::$connInfo['password']);
  }

  public static function setConnectionInfo($connInfo)
  {
    self::$connInfo = $connInfo;
  }

    // クエリ結果を取得
    public function query($sql, array $params = array())
    {
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

  // INSERTを実行
  public function insert($data)
  {
    $fields = array();
    $values = array();
    foreach ($data as $key => $val) {
      $fields[] = $key;
      $values[] = ':' . $key;
    }
    $sql = sprintf(
      "INSERT INTO %s (%s) VALUES (%s)", 
      $this->name,
      implode(',', $fields),
      implode(',', $values)
    );
    $stmt = $this->db->prepare($sql);
    foreach ($data as $key => $val) {
      $stmt->bindValue(':' . $key, $val);
    }
    $res  = $stmt->execute();

    return $res;
  }

  // DELETEを実行
  public function delete($where, $params = null)
  {
    $sql = sprintf("DELETE FROM %s", $this->name);
    if ($where != "") {
      $sql .= " WHERE " . $where;
    }
    $stmt = $this->db->prepare($sql);
    if ($params != null) {
      foreach ($params as $key => $val) {
        $stmt->bindValue(':' . $key, $val);
      }
    }
    $res = $stmt->execute();

    return $res;
  }

}
