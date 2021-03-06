<?php 
class Index extends Controller {
	function __construct($input) {
		parent::__construct($input);

		$this->View->setActiveNav("HOME");
	}

	public function index($sere = array()) {
		$this->View->setView("index");

		$sere['MAGAZINE_GROUPS'] = "";
		$sere['GROUP_GROUPS'] = "";
		$i = 0;


		//-----magazines-----
		//get magazines
		$magazines = $this->Model->getMagazines();

		foreach ($magazines as $magazine) {
			$acc[$i]["title"] = $magazine['title'];
			$acc[$i]['content'] = "";
			//get recipes
			$recipes = $this->Model->getRecipesOfMagazine($magazine['ID']);
			//display recipes
			foreach ($recipes as $recipe) {
				$sere_recipe["RECIPE_TITLE"] = $recipe['title'];
				$sere_recipe["RECIPE_ID"] = $recipe['ID'];
				$acc[$i]['content'] .= $this->View->fillView("recipe", $sere_recipe);
			}
			$i++;
		}
		$sere['MAGAZINES'] = $this->View->createAccordion($acc, 1);
		
		//display magazines
		// $i = 0;
		// foreach ($magazines as $magazine) {
		// 	$content = "";
		// 	//get recipes
		// 	$recipes = $this->Model->getRecipesOfMagazine($magazine['ID']);
		// 	//display recipes
		// 	foreach ($recipes as $recipe) {
		// 		$sere_recipe["RECIPE_TITLE"] = $recipe['title'];
		// 		$sere_recipe["RECIPE_ID"] = $recipe['ID'];
		// 		$content .= $this->View->fillView("recipe", $sere_recipe);

		// 	}
		// 	$sere['MAGAZINE_GROUPS'] .= $this->createAccordion($magazine['title'], $content, $i, 1);
		// 	$i++;
		// }

		// //-----groups-----
		// //get groups
		// $groups = $this->Model->getGroups();

		// //display groups
		// foreach ($groups as $group) {
		// 	$content = "";
		// 	//get recipes
		// 	$recipes = $this->Model->getRecipesOfGroup($group['ID']);
		// 	//display recipes
		// 	foreach ($recipes as $recipe) {
		// 		$sere_recipe["RECIPE_TITLE"] = $recipe['title'];
		// 		$content .= $this->View->fillView("recipe", $sere_recipe);
		// 	}
		// 	$sere['GROUP_GROUPS'] .= $this->createAccordion($group['title'], $content, $i, 2);
		// 	$i++;
		// }

		parent::index($sere);
	}

	private function createAccordion($title, $content, $id, $parentId) {
		$sere_collapse['GROUP_TITLE'] = $title;
		$sere_collapse['GROUP_CONTENT'] = $content;
		$sere_collapse['GROUP_NR'] = number_to_word($id, "en-US");
		$sere_collapse['PARENT_NR'] = number_to_word($parentId, "en-US");

		return $this->View->fillView("collapse_group", $sere_collapse);
	}
}
?>