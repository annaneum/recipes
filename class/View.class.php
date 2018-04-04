<?php 
class View {    
    private $viewFile = null;

    private $viewMain = null;

    private $viewNav = null;

    private $viewTemplate = null;
    
    private $title = null;
    
    private $css = null;
    
    private $js = null;
    
    private $content = null;

    private $Lang;

    private $nav = array();

    private $nav_right = array();

    private $nav_active = -1;
    
    function __construct() {
        $this->Lang = new Language("de");
        $this->viewMain = VIEW_PATH . "index.php";
        $this->viewNav = VIEW_PATH . "navigation.php";
        $this->viewTemplate = VIEW_PATH . "template.php";
    }
    
    public function setView($page, $file="index") {
        $this->viewFile = VIEW_PATH . $page . "/" . $file . ".php";
        if (! file_exists($this->viewFile)) {
            die("Error loading view file ($this->viewFile).");
        }
    }

    public function viewIsSet() {
        return $this->viewFile != null;
    }
    
    public function fillView($area, $values = array(), $view = null) {
        $string = file_get_contents(($view == null) ? $this->viewFile : $view);
        
        $string = str_replace(array(
            "\r",
            "\n"
        ), '', $string);
        $pattern = "/\[" . $area . "\](.*?)(?:#{2}|[\[].+[\]]|$)/";
        
        preg_match($pattern, $string, $matches);
        
        $output = $matches[1];

        //replace Language
        $lang = $this->Lang->getLang();
        foreach ($lang as $key => $value) {
            $tagToReplace = "{" . $key . "}";
            $output = str_replace($tagToReplace, $value, $output);
        }

        //replace constants
        $const = get_defined_constants();
        foreach ($const as $key => $value) {
            $tagToReplace = "{" . $key . "}";
            $output = str_replace($tagToReplace, $value, $output);
        }

        //replace given values
        foreach ($values as $key => $value) {
            $tagToReplace = "{" . $key . "}";
            $output = str_replace($tagToReplace, $value, $output);
        }
        return $output;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function addCSS($CSSFile, $url = false) {
        $sere_css['CSS_FILE'] = ($url) ? $CSSFile : URL . "public/css/" . $CSSFile . ".css";
        $this->css .= $this->fillView("css", $sere_css, $this->viewMain);
    }
    
    public function addJS($JSFile, $url = false) {
        $sere_js['JS_FILE'] = ($url) ? $JSFile : URL . "public/js/" . $JSFile . ".js";
        $this->js .= $this->fillView("js", $sere_js, $this->viewMain);
    }
    
    public function setContent($content) {
        $this->content .= $content . " ";
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function clearContent() {
        $this->content = null;
    }
    
    public function render($header = true) {
        $sere_main["TITLE"] = $this->title;
        $sere_main["CSS"] = $this->css;
        $sere_main["NAV"] = $this->getNav();
        $sere_main["CONTENT"] = $this->content;
        $sere_main['JS'] = $this->js;
        
        return $this->fillView("main", $sere_main, $this->viewMain);
    }

    public function addMenuPoint($text, $link) {
        array_push($this->nav, array("text" => $text, "link" => $link));
    }

    public function addRightMenuPoint($text, $link) {
        array_push($this->nav_right, array("text" => $text, "link" => $link));
    }

    public function setActiveNav($navText) {
        $point_count = count($this->nav);
        for ($i = 0; $i < $point_count; $i++) {
            if ($this->nav[$i]['text'] == $navText) {
                $this->nav_active = $i;
                return;
            }
        }
    }

    private function getMenuPoint($text, $link, $active = false) {
        $sere_menu_point['ACTIVE'] = ($active) ? "active" : "";
        $sere_menu_point['LINK'] = $link;
        $sere_menu_point['TEXT'] = $this->Lang->getWord($text);
        return $this->fillView("menu_point", $sere_menu_point, $this->viewNav);
    }

    private function getNav() {
        $sere_main = array();
        $sere_main['MENU_POINTS'] = "";
        $sere_main['MENU_RIGHT_POINTS'] = "";

        $point_count = count($this->nav);
        for ($i = 0; $i < $point_count; $i++) {
            $active = $this->nav_active == $i;
            $sere_main['MENU_POINTS'] .= $this->getMenuPoint($this->nav[$i]['text'], $this->nav[$i]['link'], $active);
        }

        $point_count = count($this->nav_right);
        for ($i = 0; $i < $point_count; $i++) {
            $sere_main['MENU_RIGHT_POINTS'] .= $this->getMenuPoint($this->nav_right[$i]['text'], $this->nav_right[$i]['link']);
        }
        
        return $this->fillView("main", $sere_main, $this->viewNav);
    }

    public function getTemplate($type, $content = array()) {
        return $this->fillView(strtolower($type), $content, $this->viewTemplate);
    }

    public function createAccordion($content, $nr = 0) {
        $type = "accordion";
        $element_type = "accordion_element";
        $sere['ACCORDION_ELEMENTS'] = "";
        $sere['ACC_NR'] = number_to_word($nr);
        $i = 1;
        foreach($content as $element) {
            $sere_element = array();
            $sere_element['ELEMENT_NR'] = number_to_word($i);
            $sere_element['ELEMENT_TITLE'] = $element['title'];
            $sere_element['ELEMENT_CONTENT'] = $element['content'];
            $sere_element['ACC_NR'] = number_to_word($nr);
            $sere['ACCORDION_ELEMENTS'] .= $this->getTemplate($element_type, $sere_element);
            $i++;
        }
        return $this->getTemplate($type, $sere);
    }
}

?>