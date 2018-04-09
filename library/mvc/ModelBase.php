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
}
