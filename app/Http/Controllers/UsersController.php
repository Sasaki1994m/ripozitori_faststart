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
            session_start();
            $values = $this->init();            
            include($this->models.'User.php');
            $usermodel = new User();
            $result = $usermodel->form();
            
            var_dump($result);
            if (!isset($result['name'])){
                echo '名前とパスワードが間違っています。';
                return false;
            }
            if(count($result) > 0){
                $_session['name'] = $result['id'];
                $_session['password'] = $result['password'];
                echo'ログインしました';
                include($this->views."posts/touroku.php");
                             
            }else{
                header('Location: http://192.168.33.10/logon');  
            
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