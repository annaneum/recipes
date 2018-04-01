<?php
class Recipe extends Controller {
	function __construct($input) {
		parent::__construct($input);
	}

	public function show($id) {
		$this->View->setTemplate("recipe", "show");

		$recipe = $this->Model->getRecipe($id);
		$sere["RECIPE_TITLE"] = $recipe['title'];

		$this->setMainContent($sere);
	}
}

?>