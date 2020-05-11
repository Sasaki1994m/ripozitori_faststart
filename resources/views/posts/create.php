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
          新規投稿作成
          </h5>

          <h5 class="mb-4 text-danger">
              <?php foreach ($error as $alert):?>
              <?php echo $alert."<br>";?>
              <?php endforeach;?>
          </h5>
          <form method="POST" action="store">
            <fildset>
            <div class="form-group">
              <label for="title">
                タイトル
              </label>
              <input 
                      id="title"
                      name="title"
                      class="form-control"
                      value="<?php echo htmlspecialchars( $post["title"],ENT_QUOTES, "UTF-8");?>"
                      type="text"
              >
            </div>

            <div class="form-group">
              <label for="body">
                本文
              </label>
              <textarea 
                      id="body"
                      name="body"
                      class="form-control"
                      rows="10"
              ><?php echo htmlspecialchars($post["body"],ENT_QUOTCES, "UTF-8");?></textarea>
            </div>

            <div>
            <a class="btn btn-secondary" href="/">
            キャンセル
            </a>
            <button type="submit" class="btn btn-success">
            投稿する
            </div>
            </fildset>

          </form>
        </diV>
    </div>  
  </main>
  <?php include($values["layouts"]."footer.php");?>
</body>
</html>


