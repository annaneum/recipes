<?php 
class Controller {
    protected $Model;
    protected $View;
    protected $User;
    protected $input;
    protected $title = "Recipes";
    protected $loggedInRequired = true;
    protected $logoutLink = true;
    
    public function __construct($input) {
        header('Content-type: text/html; charset=utf-8');
        $this->Model    = new Model();
        $this->View     = new View();
        $this->User     = $this->getUser();

        $this->input = $input;

        if($this->loggedInRequired) {
            $this->checkLogin();
        }

        $this->View->addCSS("bootstrap.min");
        $this->View->addCSS("https://use.fontawesome.com/releases/v5.0.4/css/all.css", true);
        $this->View->addCSS("style");

        $this->View->addJS("jquery-3.3.1.min");
        $this->View->addJS("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js", true);
        $this->View->addJS("bootstrap.min");

        //create Navigation
        $this->View->addMenuPoint("HOME", LINK_URL . "index");
        $this->View->addMenuPoint("TEST", LINK_URL . "test");

        if ($this->logoutLink) {
            $this->View->addRightMenuPoint("LOGOUT", LINK_URL . "login/logout");
        }

        $this->View->setTitle($this->title);
    }
    
    public function __destruct() {
        echo $this->View->render();
    }

    public function getUser() {
        if (isset($_SESSION['user']) && $_SESSION['user'] != false) {
            return new User($_SESSION['user']);
        } else {
            return null;
        }
    }

    public function checkLogin() {
        if ($this->User === NULL) {
            header("location:" . LINK_URL . "login");
        }
    }

    public function checkLoggedIn() {
        if (is_object($this->User)) {
            header("location:" . LINK_URL . "index");
        }
    }

    public function index($sere = array()) {
        $this->View->setView(strtolower(get_called_class()));
        $this->setMainContent($sere);
    }

    protected function setMainContent($sere) {
        $content = $this->View->fillView("main", $sere);
        $this->View->setContent($content);
    }
}

?>