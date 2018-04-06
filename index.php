<?php

require_once './public_html/mvc/Dispatcher.php';

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot('./public_html/tuuhan');
$dispatcher->dispatch();

