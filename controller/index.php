<?php 
class Index extends Controller {
	function __construct($input) {
		parent::__construct($input);

		$this->View->setActiveNav("HOME");
	}

	public function index($sere = array()) {
		$smth = array("smth" => "ggs", "num2" => "js", "three" => "jj");
		$sere['MAGAZINE_GROUPS'] = "";
		$sere['GROUP_GROUPS'] = "";
		$i = 0;

		foreach ($smth as $title => $content) {
			$sere['MAGAZINE_GROUPS'] .= $this->createAccordion($title, $content, $i, 1);
			$i++;
		}

		foreach ($smth as $title => $content) {
			$sere['GROUP_GROUPS'] .= $this->createAccordion($title, $content, $i, 2);
			$i++;
		}

		parent::index($sere);
	}

	private function createAccordion($title, $content, $id, $parentId) {
		$sere_collapse['GROUP_TITLE'] = $title;
		$sere_collapse['GROUP_CONTENT'] = $content;
		$sere_collapse['GROUP_NR'] = number_to_word($id, "en-US");
		$sere_collapse['PARENT_NR'] = number_to_word($parentId, "en-US");

		return $this->View->fillTemplate("collapse_group", $sere_collapse);
	}
}
?>