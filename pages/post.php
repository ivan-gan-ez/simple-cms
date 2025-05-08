<?php
    $database = connectToDB();
    
    $id = $_POST["post_id"];

    // Get data from database 
    // 2.25: recipe (sql command)
    $sql = "SELECT posts.*, users.* FROM posts INNER JOIN users ON posts.user_id = users.id WHERE post_id = :id";

    // 2.5: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 2.75: cook it (execute the sql query)
    $query->execute(["id" => $id]);

    // 3: eat (fetch all results from the query)
    $post = $query->fetch();
?>

<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?=$post['title']?></h1>
      <h1 class="h6 mb-4 text-center">by <?=$post['name']?></h1>
      <?=$post['content']?>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"?>