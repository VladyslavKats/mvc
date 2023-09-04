<?php
    /**
     * Router
     */
    class Router{
        /**
         * Associative array of routes (the routing table)
         * @var array
         */
        protected $routes = [];

        /**
         * @var array
         */
        protected $params = [];

        /**
         * @return void
         */
        public function add($route, $params = []){
            //Convert the route to a regular expression : escape forward slashes
            $route = preg_replace('/\//' , '\\/', $route);
            //Convert variabless e.g. {controller}
            $route = preg_replace('/\{([a-z]+)\}/' , '(?P<\1>[a-z-]+)' , $route);
            //Convert variables with custom regular expression e.g. {id:\d+}
            $route = preg_replace('/\{([a-z]+):([^\}]+)\}/' , '(?P<\1>\2)', $route);
            //Add start and end delimeters , and case insensetive flag
            if(!$route){
                $route = '/^' . $route . '$/i';
            }else{
                $route = '/^\/' . $route . '$/i';
            }
            $this->routes[$route] = $params;
        }

        public function getRoutes(){
            return $this->routes;
        }

        /**
         * @return array
         */
        public function getParams(){
            return $this->params;
        }

        /**
         * @param string $url The route URL
         * 
         * @return boolean true if a match found , false otherwise
         */
        public function match($url){
            foreach($this->routes as $route => $params){
                if(preg_match($route , $url , $matches)){
                    foreach($matches as $key => $match){
                        if(is_string($key)){
                            $params[$key] = $match;
                        }
                    }
                    $this->params = $params;
                    return true;
                }
            }
            return false;
        }

        public function dispatch($url){
            if($this->match($url)){
                $controller = $this->params['controller'];
                $controller = $this->convertToStudlyCaps($controller);
                if(class_exists($controller)){
                    $controller_object = new $controller();
                    $action = $this->params['action'];
                    $action = $this->convertToCamelCase($action);
                    if(is_callable([$controller_object, $action])){
                        $controller_object->$action();
                    }
                }
            }
        }

        protected function convertToStudlyCaps($string){
            return str_replace(' ','',ucwords(str_replace('-' , ' ' , $string)));
        }

        protected function convertToCamelCase($string){
            return lcfirst($this->convertToStudlyCaps($string));
        }
    }
?>