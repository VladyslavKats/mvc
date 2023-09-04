<?php
    namespace App\Controllers;

    class Posts extends \Core\Controller{

        public function index(){
            echo htmlspecialchars(print_r($_GET , true));
        }

        public function addNew(){
            echo 'Hello from the addNew action in the post controller';
        }

        public function edit(){
            echo $this->route_params['id'];
        }

    
    }

?>