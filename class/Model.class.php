<?php
class Model extends MysqliDb{
    private $conn_centron;
    
    function __construct() {
        parent::__construct(DB_HOST, DB_USER, DB_PASS, DB);
    }

    public function login($username, $password) {
        $this->where("username", $username);
        $user = $this->getOne("user");
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = 1;
            return true;
        }
        return false;
    }

    public function logout() {
        unset($_SESSION['user']);
    }

    public function getMagazines() {
        $magazines = $this->get("magazine", null, "ID, title, date, edition");
        return $magazines;
    }

    public function getGroups() {
        $groups = $this->get("groups", null, "ID, title, prio");
        return $groups;
    }

    public function getRecipe($recId) {
        $this->where("ID", $recId);
        $recipe = $this->getOne("recipe", "ID, title");
        return $recipe;
    }

    public function getRecipesOfMagazine($magID) {
        $this->where("fk_magazine_ID", $magID);
        $recipes = $this->get("recipe", null, "ID, title");
        return $recipes;
    }

    public function getRecipesOfGroup($groupID) {
        $this->join("group_recipe", "fk_recipe_ID = recipe.ID");
        $this->where("fk_group_ID", $groupID);
        $recipes = $this->get("recipe", null, "recipe.ID, recipe.title");
        return $recipes;
    }
}

?>