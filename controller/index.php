<?php 
class Index extends Controller {
	function __construct($input) {
		parent::__construct($input);

		$this->View->setActiveNav("HOME");
	}

	public function index($sere = array()) {
		$smth = array("smth" => "ggs", "num2" => "js", "three" => "jj");
		$sere['GROUPS'] = $this->createAccordionGroups($smth);
		parent::index($sere);
	}

	private function createAccordionGroups($group) {
		$output = "";
		$i = 0;

		foreach ($group as $title => $content) {
			$sere_collapse['GROUP_TITLE'] = $title;
			$sere_collapse['GROUP_CONTENT'] = $content;
			$sere_collapse['GROUP_NR'] = number_to_word($i, "en-US");

			$output .= $this->View->fillTemplate("collapse_group", $sere_collapse);
			$i++;
		}

		return $output;
	}
}
?>