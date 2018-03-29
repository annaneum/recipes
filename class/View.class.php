<?php 
class View {    
    private $templateFile = null;

    private $templateMain = null;

    private $templateNav = null;
    
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
        $this->templateMain = VIEW_PATH . "index.php";
        $this->templateNav = VIEW_PATH . "navigation.php";
    }
    
    public function setTemplate($page, $file="index") {
        $this->templateFile = VIEW_PATH . $page . "/" . $file . ".php";
        if (! file_exists($this->templateFile)) {
            die("Error loading template file ($this->templateFile).");
        }
    }
    
    public function fillTemplate($area, $values = array(), $template = null) {
        $string = file_get_contents(($template == null) ? $this->templateFile : $template);
        
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
        $this->css .= $this->fillTemplate("css", $sere_css, $this->templateMain);
    }
    
    public function addJS($JSFile, $url = false) {
        $sere_js['JS_FILE'] = ($url) ? $JSFile : URL . "public/js/" . $JSFile . ".js";
        $this->js .= $this->fillTemplate("js", $sere_js, $this->templateMain);
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
        
        return $this->fillTemplate("main", $sere_main, $this->templateMain);
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
        return $this->fillTemplate("menu_point", $sere_menu_point, $this->templateNav);
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
        
        return $this->fillTemplate("main", $sere_main, $this->templateNav);
    }
}

?>