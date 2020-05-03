<?php    
    class UsersController
    {
      
         //コンストラクタの定義
         public function __construct($models, $views)
         {
             $this->models = $models;
             $this->views = $views; 
         }
         public function init() {
             $values = array(
                 "layouts" => $this->views."layouts/",
             );
             return $values;
         }
        public function form()
        {
            $values = $this->init();
            
            include($this->models.'User.php');
            $usermodel = new User();
            $result = $usermodel->form();
            $post =$result[0];
            $error= $result[1];
            if(count($error)){
                include($this->views."posts/touroku.php");
            }else{
                header('Location: http://192.168.33.10/');
            }

        }
    
                   
        public function logon()
        {
            $values = $this->init();            
            include($this->models.'User.php');
            $usermodel = new User();
            $result = $usermodel->form();
            $post =$result[0];
            $error= $result[1];
            if(count($result) >0){
                header('Location: http://192.168.33.10/');                
            }else{
                include($this->views."posts/touroku.php");
            }

        }
        public function top()
        {
             $values = $this->init();
             include($this->views."posts/top.php");
        }
        public function login()
        {
             $values = $this->init();
             include($this->views."posts/login.php");
        }
        public function touroku()
        {
             $values = $this->init();
             include($this->views."posts/touroku.php");
        }
        
        public function logout()
        {
             $values = $this->init();
             include($this->views."posts/logout.php");
        }
        
     }