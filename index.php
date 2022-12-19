<?php
/**
 * Hlavni controller
 */

$application = new Application();


//TODO cyhbové hlášky

class Application{

    public function __construct()
    {
        session_start();
        require_once('settings.php');

        //Přesměrování všech errorů
        set_error_handler(function(){
            header('Location: /'.ROOT_DIR.ERROR_PAGE);
            exit();
        });

        register_shutdown_function(function(){
            if (!empty(error_get_last())) {
                header('Location: /'.ROOT_DIR.ERROR_PAGE);
                exit();
            }
            
        });


        $page = $this->get_requested_page();
        $this->run_controller(page: $page);
        $data = $this->get_data_from_model(page: $page);

        $this->render_twig(
            page: $page,
            data: $data
        );
    }


    /**
     * Zjistí na kterou stránku přesměrovat
     */
    private function get_requested_page():string{

        /*Legacy
        if(!isset($_GET["page"])){
            return DEFAULT_PAGE;
        }*/

        //Parsuje stránku kterou zadal uživatel
        $url = str_replace("/".ROOT_DIR, "", strtok($_SERVER["REQUEST_URI"], '?'));
        
        //Přesměruje na hlavní stránku
        if ($url == "") {
            return DEFAULT_PAGE;
        }

        //Kontroluje jestli stránka existuje
        if(!array_key_exists($url, PAGES)){
            return NOT_FOUND_PAGE;
        }

        //Kontroluje jestli má uživatel přístup
        $access_level = isset($_SESSION["USER_access_level"]) ? $_SESSION["USER_access_level"] : 0;

        if ($access_level < PAGES[$url]) {
            return LOGIN_PAGE;
        }

        return $url;
    }


    /**
     * Vrátí data z modelu
     */
    private function get_data_from_model(string $page):array{

        //Kontrola jestli model existuje
        if (file_exists("pages/models/".$page.".php")) {
            require_once "pages/models/".$page.".php";

            $model = new Model();
            $data = $model->data();
        }

        //Přidání základních dat
        $data["current_page"] = $page;

        if (isset($_SESSION["USER_username"])) {
            $data["USER_username"] = $_SESSION["USER_username"];
            $data["USER_access_level"] = $_SESSION["USER_access_level"];
        }

        return $data;
    }

    
    /**
     * Spustí funkci kontrolleru
     */
    private function run_controller(string $page){
        if (!file_exists("pages/controllers/".$page.".php")) {
            return array();
        }

        require_once "pages/controllers/".$page.".php";

        new Controller();
    }


    /**
     * Vyrenderuje stráku pomocí twig templating enginu
     */
    private function render_twig(string $page, array $data){

        //Kontrola jestli view existuje
        if (!file_exists("pages/views/".$page.".twig")) {
            return;
        }

        require_once "vendor/autoload.php";

        //Adresář se šablonami
        $loader = new \Twig\Loader\FilesystemLoader("pages/views");
       
        $twig = new \Twig\Environment($loader);


        //Render
        echo $twig->render($page.".twig", $data);
    }
}