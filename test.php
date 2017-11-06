<?php
ini_set("display_errors", "On");
include_once("Smarty.class.php");

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->config_dir = 'configs';
$smarty->cache_dir = 'cache';
$smarty->caching = false;

$smarty->left_delimiter = "{";
$smarty->right_delimiter = "}";

$smarty->assign("title", "測試用的網頁標題");
$smarty->assign("content","測試用的網頁內容");
$smarty->display("test.tpl");
?>