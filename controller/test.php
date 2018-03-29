<?php
class Test extends Controller {
	function __construct($input) {
		parent::__construct($input);

		$this->View->setActiveNav("TEST");
	}
}

?>