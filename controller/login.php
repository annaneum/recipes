<?php 
class Login extends Controller {
	protected $title = "Login";
	protected $loggedInRequired = false;
	protected $logoutLink = false;

	function __construct($input) {
		parent::__construct($input);
	}

	public function index($sere = array()) {
		$sere['MSG'] = "";
		parent::index($sere);
	}

	public function login() {
		if ($this->Model->login($this->input['username'], $this->input['password'])) {
			header("location:" . LINK_URL . "index");
		} else {
			$sere_msg['MSG_TEXT'] = "Username oder Passwort stimmt nicht.";
			$sere['MSG'] = $this->View->fillTemplate("msg", $sere_msg);
			parent::index($sere);
		}
	}

	public function logout() {
		$this->Model->logout();
		header("location:" . LINK_URL . "index");
	}
}

?>