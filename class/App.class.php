<?php
class App {

	private $Controller = null;

	private $ctrl = null;

	private $funct = null;

	private $param = null;

	private $admin = false;

	function __construct($url) {
		session_start();

		$url = rtrim($url, "/");
		$url = explode("/", $url);

		if ($url[0] == "admin") {
			$this->admin = true;
		}

		$url = $this->createController($url);
		$url = $this->getFunction($url);
		$this->param = $url;

		$this->Controller->{$this->funct}(...$this->param);
	}

	private function createController($url) {
		$admin = $this->admin;

		$index = ($admin) ? 1 : 0;
		$ctrl = (! empty($url[$index])) ? $url[$index] : "index";

		$path = ($admin) ? ADMIN_CTRL_PATH : CTRL_PATH;

		$file = $path . $ctrl . ".php";

		if (file_exists($file)) {
		    require $file;
		} else {
		    require $path . "error.php";
		    $ctrl = "ErrorController";
		}

		$this->ctrl = $ctrl;

		$input = array_merge($_GET, $_POST, $_SESSION);

		$this->Controller = new $ctrl($input);

		//shorten url
		do {
			array_delete_row($url, $index);
			$index--;
		} while ($index >= 0);

		return $url;
	}

	private function getFunction($url) {
		 $funct = (isset($url[0])) ? $url[0] : "index";
		 $this->funct = $funct;

		 if (count($url) > 0) {
		 	array_delete_row($url, 0);
		 }

		 return $url;
	}
}


?>