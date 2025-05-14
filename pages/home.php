<?php
    $search_keyword = ( isset($_GET['search']) ? $_GET['search'] : "");

    $database = connectToDB();

    // Get data from database 
    // 2.25: recipe (sql command)
    $sql = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE status = 'published' AND ( title LIKE :keyword OR shortdesc LIKE :keyword ) ORDER BY post_id DESC";

    // 2.5: prepare material (prepare sql query)
    $query = $database->prepare($sql);

    // 2.75: cook it (execute the sql query)
    $query->execute(["keyword" => "%$search_keyword%"]);

    // 3: eat (fetch all results from the query)
    $posts = $query->fetchAll();
?>

<?php require "parts/header.php"?>
    
<div class="container mx-auto my-5" style="max-width: 500px;">
  <h1 class="h1 mb-4 text-center">Compiled Blogs Advanced</h1>

  <p><?php echo ( isUserLoggedIn() ? "Welcome back, " . $_SESSION["user"]["name"] . "!" : "" ); ?></p>

  <form method="GET" action="/" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control" placeholder="Search for something..." value="<?= $search_keyword ?>">
    <button class="btn btn-primary ms-2"><i class="bi bi-search"></i></button>
    <a href="/" class="btn btn-success ms-2"><i class="bi bi-arrow-repeat"></i></a>
  </form>

  <?php foreach ($posts as $i => $post) {?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?=$post['title']?></h5>
          <p class="card-text">by <?=$post['name']?></p>
          <p class="card-text"><?=$post['shortdesc']?></p>
          <div class="text-end">
            <form method="POST" action="/post">
              <input type="hidden" name="post_id" value="<?= $post["post_id"];?>" />
              <button class="btn btn-primary btn-sm">Read More</button>
            </form>
          </div>
        </div>
      </div>
  <?php }; ?>


      <div class="mt-4 d-flex justify-content-center gap-3">
        <?php if ( isUserLoggedIn() ) {?>
          <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
          <a href="/logout" class="btn btn-link btn-sm">Logout</a>
          <?php } else {?>
            <a href="/login" class="btn btn-link btn-sm">Login</a>
            <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
        <?php }?>
      </div>
    </div>

    <?php require "parts/footer.php"?>