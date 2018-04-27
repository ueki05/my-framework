<?php

class BbsController extends ControllerBase
{
  protected function preAction()
  {
    $this->view->assign('parent_no', 0);
  }

  // 記事表示
  public function indexAction()
  {
    // URLパラメータよりページ数取得
    $page = 1;
    if (null != $this->request->getParam('page')) {
      $page = $this->request->getParam('page');
    }

    // データ取得
    $bbs = new Bbs();
    $threads = $bbs->getThreads(10, $page);
    // テンプレートへ出力
    $this->view->assign('threads', $threads);
  }

  // 返信モードへ以降
  public function resAction()
  {
    $post = $this->request->getPost();

    $this->view->assign('parent_no', $post["parent_no"]);
    $this->indexAction();
    $this->templatePath = 'bbs/index.tpl';
  }

  // 投稿処理
  public function registAction()
  {
    $post = $this->request->getPost();

    $bbs = new Bbs();
    $bbs->regist($post);

    $this->redirect('/bbs/index');
  }

  // 削除処理
  public function deleteAction()
  {
    $post = $this->request->getPost();

    $bbs = new Bbs();
    $bbs->del($post['no']);

    $this->redirect('/bbs/index');
  }
}
