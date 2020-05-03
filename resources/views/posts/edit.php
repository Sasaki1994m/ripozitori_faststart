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
          編集画面
          </h5>
          <form method="POST" action=<?php echo "/update/".$post["id"];?>>
            <fildset>
            <div class="form-group">
              <label for="title">
                タイトル
              </label>
              <input 
                      id="title"
                      name="title"
                      class="form-control"
                      value=<?php echo $post["title"];?>
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
                      
                      
              ><?php echo $post["body"];
                     ?></textarea>
            </div>

            <div>
            <a class="btn btn-secondary" href="/">
            キャンセル
            </a>
            <button type="submit" class="btn btn-success">
            更新する
            </div>
            </fildset>

          </form>
        </diV>
    </div>  
  </main>
  <?php include($values["layouts"]."footer.php");?>
</body>
</html>


