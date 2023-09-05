<?php
    namespace App\Controllers;
    use \Core\View;

    class Home extends \Core\Controller{

        public function index(){
            // View::render('Home/index.php',
            // ['name' => 'Vladyslav',
            //  'age' => 20]);
            View::renderTemplate('Home/index.html',[
                'name' => 'Vladyslav',
                'age' => 20
            ]);
        }

    }
?>