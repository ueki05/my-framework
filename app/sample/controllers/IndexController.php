<?php

class IndexController extends ControllerBase
{
  public function indexAction()
  {
    $counter = new Counter();
    // カウンターを加算
    $counter->increment();
    // カウンター値取得
    $cnt = $counter->getCounterCount();

    // テンプレートに出力
    $this->view->assign('counter', $cnt);
  }
}
