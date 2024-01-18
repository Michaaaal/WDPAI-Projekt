<?php
class AppController{

    private $request;

    public function __construct(){
        $this->request = $_SERVER['REQUEST_METHOD'];
    }
    protected function isPost():bool{
        return $this->request== 'POST';
    }
    protected function isGet():bool{
        return $this->request== 'GET';
    }
    protected function render(string $template = null, array $variables = []){

        $templatePath= 'app/views/'.$template.'.php';
        $output = "file not found";

        if(file_exists($templatePath)){
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    protected function checkIfLoggedIn(){
        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
            $this->render('login');
            exit;
        }
    }
}