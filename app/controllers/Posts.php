<?php
    namespace App\Controllers;
    use App\Models\Post;
    use Core\View;

    class Posts extends \Core\Controller{

        public function indexAction(){
            $posts = Post::GetAll();
            View::renderTemplate('Posts/index.html' , ['posts' => $posts]);
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
            
            return true;
        }

        protected function after(){
           
        }
    }

?>