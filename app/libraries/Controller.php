<?php
    // load the models and the view
    class Controller{
        public function model($model) {
            // require the model
            require_once '../app/models/' . $model . '.php';
            //Instantiate a model
            return new $model();
        }
        //load view and check if file exists
        public function view($view, $data = []){
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            }else{
                die("View does not exists.");
            }
        }
    }


?>