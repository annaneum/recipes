<?php

class Language
{
	protected $lang;
	protected $text;

	public function __construct($lang) {
		$this->lang = $lang;
		$this->text = $this->convertLangFile(LANG_PATH . $this->lang . ".php");
	}

	private function convertLangFile($path) {
		$file = file($path);
		$output = array();

		foreach ($file as $line) {
			if (trim($line) && substr($line, 0, 2) != "//") {
				$temp = explode('=', $line);
				$temp[0] = "LANG:" . rtrim($temp[0], " ");
				$temp[1] = ltrim($temp[1], " ");
				$output[$temp[0]] = $temp[1];
			}
		}

		return $output;

	}

	public function getLang() {
		return $this->text;
	}

	public function getWord($word) {
		return $this->text["LANG:" . $word];
	}
}


?>