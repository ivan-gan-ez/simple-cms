<?php
    $database = connectToDB();
    
    // Get data from database
    // 2.25: recipe (sql command)
    $sql = "SELECT * FROM users";

    // 2.5: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 2.75: cook it (execute the sql query)
    $query->execute();

    // 3: eat (fetch all results from the query)
    $users = $query->fetchAll();

    // Get data from database again
    // 3.25: recipe (sql command)
    $sql = "SELECT * FROM posts";

    // 3.5: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 3.75: cook it (execute the sql query)
    $query->execute();

    // 4: eat (fetch all results from the query)
    $posts = $query->fetchAll();

    $id = $_POST["post_id"] - 1;
?>

<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?=$posts[$id]['title']?></h1>
      <h1 class="h6 mb-4 text-center">by <?=$posts[$id]['user']?></h1>
      <?=$posts[$id]['content']?>
      <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"?>