<?php
    namespace App\Controllers;

    class Posts extends \Core\Controller{

        public function indexAction(){
            echo htmlspecialchars(print_r($_GET , true));
        }

        public function addNewAction(){
            echo 'Hello from the addNew action in the post controller';
        }

        public function editAction(){
            echo $this->route_params['id'];
        }

        public function __call($name , $args){
            $method = $name . 'Action';
            if(method_exists($this , $method)){
                if($this->before()){
                    call_user_func_array([$this , $method],$args);
                    $this->after();
                }
            }
        }

        protected function before() : bool{
            echo '(before)';
            return true;
        }

        protected function after(){
            echo '(after)';
        }
    }

?>