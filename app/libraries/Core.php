<?php
    // Core App Class
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];


        public function __construct()
        {
            $url = $this->getUrl();
            //Look in 'controllers' for first value
            //ucwords to capitalize first letter
            if(file_exists('../app/controllers/' .ucwords($url[0]) .'.php')){
                // set a new controller
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
            // require the controller
            require_once('../app/controllers/'). $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            // check for second string in the url
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //Get Parameters
            $this->params = $url ? array_values($url) : [];

            // call a callback with array of params
            // call a callback with an array of parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }


        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/'); // strip whitespace and '/' at the end of the string
                // allows only strings/number
                $url = filter_var($url, FILTER_SANITIZE_URL); // removes all illegal characters
                // split into array
                $url = explode('/', $url);
                return $url;
            }
        }
    }


?>