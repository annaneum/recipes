<?php 
include "config/paths.php";
include "config/db.php";
include INCL_PATH . "lib.inc.php";
include CLASS_PATH . "App.class.php";
include CLASS_PATH . "MysqliDb.php";
include CLASS_PATH . "Model.class.php";
include CLASS_PATH . "Controller.class.php";
include CLASS_PATH . "View.class.php";
include CLASS_PATH . "Language.class.php";
include CLASS_PATH . "Admin.class.php";
include CLASS_PATH . "User.class.php";

$App = new App((isset($_GET['url'])) ? $_GET['url'] : null);
?>