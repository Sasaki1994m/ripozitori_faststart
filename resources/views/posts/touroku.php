<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include($values["layouts"]."meta.php");?>
</head>
<body>
  <?php include($values["layouts"]."header.php");?>
  <main>
    <div class="container my-4">
        <diV class="border p-4">
          <h5 class="mb-4">
          新規登録作成
          </h5>

          <h5 class="mb-4 text-danger">
              <?php foreach ($error as $alert):?>
              <?php echo $alert."<br>";?>
              <?php endforeach;?>
          </h5>
          <form method="POST" action="form">
            <fildset>
            <div class="form-group">
              <label for="name">
                name
              </label>
              <input 
                      id="name"
                      name="name"
                      class="form-control"
                      value="<?php echo $post["name"];?>"
                      type="text"
              >
            </div>
            <div class="form-group">
              <label for="password">
                password
              </label>
              <textarea 
                      id="password"
                      name="password"
                      class="form-control"
                      rows="10"
              ><?php echo $post["password"];?></textarea>
            </div>
            <div>
            <a class="btn btn-secondary" href="top">
            キャンセル
            </a>
            <button type="submit" class="btn btn-success">
            送信する
            </div>
            </fildset>

          </form>
        </diV>
    </div>  
  </main>
  <?php include($values["layouts"]."footer.php");?>
</body>
</html>



