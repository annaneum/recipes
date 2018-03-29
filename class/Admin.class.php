<?php
class Admin extends Controller {
	protected $loggedInRequired = true;

	function __construct() {
		parent::__construct();
	}
}
?>