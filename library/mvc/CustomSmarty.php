<?php

require_once("Autoloader.php");
require_once("Smarty.class.php");

class CustomSmarty extends Smarty{
  function __construct(){
    parent::__construct();

    Smarty_Autoloader::register();
  }
}
