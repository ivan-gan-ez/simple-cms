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
?>

<?php require "parts/header.php"?>
    
<div class="container mx-auto my-5" style="max-width: 500px;">
  <h1 class="h1 mb-4 text-center">My Blog</h1>

  <?php foreach ($posts as $i => $post) {?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?=$posts[$i]['title']?></h5>
          <p class="card-text">by <?=$posts[$i]['user']?></p>
          <p class="card-text"><?=$posts[$i]['shortdesc']?></p>
          <div class="text-end">
            <form method="POST" action="/post">
              <input type="hidden" name="post_id" value="<?= $post["id"];?>" />
              <button class="btn btn-primary btn-sm">Read More</button>
            </form>
          </div>
        </div>
      </div>
  <?php } ?>


      <div class="mt-4 d-flex justify-content-center gap-3">
        <?php if ( isset($_SESSION['user']['name']) ) {?>
            <a href="/logout" class="btn btn-link btn-sm">Logout</a>
          <?php } else {?>
            <a href="/login" class="btn btn-link btn-sm">Login</a>
            <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
        <?php }?>
      </div>
    </div>

    <?php require "parts/footer.php"?>