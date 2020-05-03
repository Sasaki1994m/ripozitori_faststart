<?php
    class Post{
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
      protected function validation($data_title, $data_body){
          $error = array();

          if (empty($data_title) || ctype_space($data_title)){
            $error[] = "タイトルを入力してください。";
          }
          if (empty($data_body) || ctype_space($data_body)){
            $error[] = "本文を入力してください。";
          }
          if (strlen($data_body) > 140 ){
            $error[] = "本文を140字以下にして下さい。";
          }

          return $error;
      }
      public function index() {
        // データベースアクセスを呼び出す
        $dbh = $this->db_access();
       
        $sql = 'SELECT * FROM posts';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }
      public function store() {
        $post = array(
          "title" =>$_POST['title'],
          "body" =>$_POST['body']
        );

        $error = $this->validation($post['title'], $post['body']);
        // var_dump($error);die;

        if (count($error)){
          //createにエラーログを飛ばす
        }else {

          $dbh = $this->db_access();
          try{
            $dbh->beginTransaction();

            $sql = 'INSERT INTO posts(title, body) VALUES(:title, :body)';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $post['title'], PDO::PARAM_STR);
            $stmt->bindValue(':body', $post['body'], PDO::PARAM_STR);
            $stmt->execute();

            $dbh->commit();

          }catch(PDOException $Exceptipn){
            $stmt->rollback();
          }
      }  
        $result = array($post, $error);

        return $result;
      }
      public function show($article_id) {
        $dbh = $this->db_access();
        
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
      }
      public function edit($article_id) {
        $dbh = $this->db_access();
        
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
      }
      public function update($article_id) {
        $dbh = $this->db_access();
        try{
          $dbh->beginTransaction();

          $sql = 'UPDATE posts SET title= :title, body = :body WHERE id= :id';
          $stmt = $dbh->prepare($sql);
          $stmt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
          $stmt->bindValue(':body', $_POST['body'], PDO::PARAM_STR);
          $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);
          $stmt->execute();

          $dbh->commit();

        }catch(PDOException $Exceptipn){
          $stmt->rollback();
        }
        $result = array($_POST['title'],$_POST['body']);

        return $result;
      }
      public function destroy($article_id) {
        $dbh = $this->db_access();
        
        $sql = 'DELETE FROM posts WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return "OK";
      }
    }