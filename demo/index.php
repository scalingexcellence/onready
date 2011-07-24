<?php
require('../libs/Smarty.class.php');

$smarty = new Smarty;

$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

//$smarty->assign('onready',true);
$smarty->display('index.tpl');
