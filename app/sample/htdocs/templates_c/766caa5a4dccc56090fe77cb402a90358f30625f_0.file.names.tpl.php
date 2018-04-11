<?php
/* Smarty version 3.1.30, created on 2018-04-09 03:51:33
  from "/Applications/MAMP/htdocs/my-framework/public_html/sample/htdocs/names.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aca64b53dcd97_67177596',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '766caa5a4dccc56090fe77cb402a90358f30625f' => 
    array (
      0 => '/Applications/MAMP/htdocs/my-framework/public_html/sample/htdocs/names.tpl',
      1 => 1523213424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aca64b53dcd97_67177596 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Smartyサンプル</title>
</head>
<body>

<ul>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['names']->value, 'name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['name']->value) {
?>
  <li><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</li>
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</ul>

</body>
</html>
<?php }
}
