<?php

require_once("Smarty/Smarty.class.php");

$smarty = new Smarty();
$smarty->template_dir = './';

$ar = array('一郎', '二郎', '三郎');
$smarty->assign('names', $ar);
$smarty->display('names.tpl');
