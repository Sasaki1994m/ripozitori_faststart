<?php
    class User{
      private $DB_HOST = "192.168.33.10";
      private $DB_NAME = "php_hacks";
      private $DB_USER = "root";
      private $DB_PASSWORD = "PHPhacks2020@";

      // そのクラスと継承先クラスからアクセス可能
      protected function db_access(){
            //PHPがエラーを表示するように設定
        error_reporting(E_ALL & ~E_NOTICE);
            //データベースへの接続（接続時にエラーが出た場合処理される｛dbh　php　pdo｝）
        try {
          $dbh = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME,$this->DB_USER,$this->DB_PASSWORD);
          return $dbh;
        } catch (PDOException $e) {
          echo "エラー!: " . $e->getMessage() . "<br/>";
          die();
        } 
      }    

      protected function validation($data_name, $data_password){
        $error = array();

        if (empty($data_name) || ctype_space($data_name)){
          $error[] = "タイトルを入力してください。";
        }
        if (empty($data_password) || ctype_space($data_password)){
          $error[] = "本文を入力してください。";
        }
        if (strlen($data_password) > 140 ){
          $error[] = "本文を140字以下にして下さい。";
        }
        return $error;
    }
      
      public function form() {
        $post = array(
          "name" =>$_POST['name'],
          "password" =>$_POST['password']
        );

        $error = $this->validation($post['name'], $post['password']);
        if (count($error)){
          //tourokuにエラーログを飛ばす
        }else {
          $dbh = $this->db_access();
          try{
            $dbh->beginTransaction();
            $sql = 'INSERT INTO users(name, password) VALUES(:name, :password)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':name', $post['name'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $post['password'], PDO::PARAM_STR);
            $stmt->execute();

            $dbh->commit();
          }catch(PDOException $Exceptipn){
            $stmt->rollback();
          }
      }
        $result = array($post, $error);
        return $result;
      }
      public function logon() {
        $post = array(
          "name" =>$_POST['name'],
          "password" =>$_POST['password']
        );

        $dbh = $this->db_access();
        $sql = 'SELECT * FROM users WHERE name = :name AND password = :password';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $post["name"], PDO::PARAM_STR);
        $stmt->bindValue(':password', $post["password"], PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        return $result;     
      }
    }