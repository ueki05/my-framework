<?php

require_once("Smarty/Smarty.class.php");

$smarty = new Smarty();
// テンプレート格納ディレクトリを指定
$smarty->template_dir = './';
// テンプレートの{$abc}に「World」という文字列を割り当てる
$smarty->assign('abc', 'World');
// 結果出力
$smarty->display('sample.tpl');
