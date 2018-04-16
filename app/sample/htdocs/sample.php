<?php
// システムのルートディレクトリパス
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
// ライブラリのディレクトリパス
define('LIB_PATH', realpath(dirname(__FILE__) . '/../../../library'));

// ライブラリとモデルのディレクトリをinclude_pathに追加
$includes = array(LIB_PATH . '/mvc', ROOT_PATH . '/models');
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

require_once("Smarty/Smarty.class.php");

$smarty = new Smarty();
// テンプレート格納ディレクトリを指定
$smarty->template_dir = './';
// テンプレートの{$abc}に「World」という文字列を割り当てる
$smarty->assign('abc', 'World');
// 結果出力
$smarty->display('sample.tpl');
