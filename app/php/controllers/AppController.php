<?php

class AppController{
    protected function render(string $template = null){
        $templatePath= 'app/views/'.$template.'.html';

        if(file_exists($templatePath)){
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}