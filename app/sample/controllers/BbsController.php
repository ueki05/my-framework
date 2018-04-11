<?php

class BbsController
{
  // 記事表示
  public function threadsAction()
  {
    // URLパラメータよりページ数取得
    $page = 1;
    if (null != $this->request->getParam('page')) {
      $page = $this->request->getParam('page');
    }
    // 記事データ取得
    $data = $this->model->getThreadsData($page);
    // 表示
    $this->view->assign('parent', $data);
  }
}
