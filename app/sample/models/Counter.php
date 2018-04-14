<?php

class Counter extends ModelBase
{
  // カウンター値取得
  public function getCounterCount()
  {
    $sql = sprintf(
      "SELECT IFNULL(visit_count, 0) AS visit_count FROM %s WHERE date = :date",
      $this->name
    );
    $params = array('date' => date('Ymd'));
    $rows = $this->query($sql, $params);
    $row = $rows[0];
    return $row['visit_count'];
  }

  // カウンター加算処理
  public function increment()
  {
    // 本日の日付のレコードが存在するか確認
    $sql = sprintf(
      "SELECT COUNT(*) AS cnt FROM %s  WHERE date = :date",
      $this->name
    );
    $params = array('date' => date('Ymd'));
    $rows = $this->query($sql, $params);
    $row = $rows[0];
    $res = false;

    // なければINSERT、あればUPDATE
    if ($row['cnt'] == 0) {
      $sql = sprintf(
        "INSERT INTO %s (date, visit_count) VALUES ('%s', 1)",
        $this->name,
        date('Ymd')
      );
      $res = $this->db->exec($sql);
    } else {
      $sql = sprintf(
        "UPDATE %s SET visit_count = visit_count + 1 WHERE date = '%s'",
        $this->name,
        date('Ymd')
      );
      $res = $this->db->exec($sql);
    }
    return $res;
  }
}
