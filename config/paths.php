<?php
$dir_root = $_SERVER['DOCUMENT_ROOT'] . "/cms/";
define("DIR_ROOT", $dir_root);

$incl_path = DIR_ROOT . "include/";
define("INCL_PATH", $incl_path);

$class_path = DIR_ROOT . "class/";
define("CLASS_PATH", $class_path);

$ctrl_path = DIR_ROOT . "controller/";
define("CTRL_PATH", $ctrl_path);

$admin_ctrl_path = CTRL_PATH . "admin/";
define("ADMIN_CTRL_PATH", $admin_ctrl_path);

$view_path = DIR_ROOT . "view/";
define("VIEW_PATH", $view_path);

$lang_path = DIR_ROOT . "lang/";
define("LANG_PATH", $lang_path);

$url = "http://" . $_SERVER['HTTP_HOST'] . "/cms/";
define("URL", $url);

$link_url = URL;
define("LINK_URL", $link_url);