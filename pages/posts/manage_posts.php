<?php

if ( !isUser() ){
  header("Location: /dashboard");
  exit;
};

$database = connectToDB();

$user_id = $_SESSION['user']['id'];

// Get data from database 

if ( isEditor() ) {
    // 2.25: recipe (sql command)
  $sql = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY post_id DESC";

  // 2.5: prepare material (prepare sql query)
  $query = $database->prepare($sql);

  // 2.75: cook it (execute the sql query)
  $query->execute();
} else {
    // 2.25: recipe (sql command)
  $sql = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :user_id ORDER BY post_id DESC";

  // 2.5: prepare material (prepare sql query)
  $query = $database->prepare($sql);

  // 2.75: cook it (execute the sql query)
  $query->execute(["user_id" => $user_id]);
}

// 3: eat (fetch all results from the query)
$posts = $query->fetchAll();

?>

<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        
        <div class="text-end">
          <a href="/posts/add" class="btn btn-primary btn-sm"
          >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        
        <?php require "parts/message_success.php"?>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 30%;">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>


            <?php foreach ($posts as $i => $post) {?>

            <tr>
              <th scope="row"> <?= $post['post_id'] ?> </th>
              <td class="text-break"> <?= $post['title'] ?> </td>
              <td class="text-break"> <?= $post['name'] ?> </td>
              <td>

              <?php if ($post['status'] === "published") {?>
                <span class="badge bg-success">Published</span>
              <?php } else if ($post['status'] === "pending") {?>
                <span class="badge bg-warning">Pending Review</span>
              <?php } ?>

              </td>
              <td class="text-end">
                <div class="buttons" style="min-width: 135px;">

                  <form method="post" action="/post" style="display:inline">
                    <input type="hidden" name="post_id" value="<?php echo $post['post_id'];?>" style="width:0px"/>
                    <button class="btn btn-primary btn-sm me-2 <?= ( $post['status'] === "published" ? "" : "disabled" ) ?>">
                    <i class="bi bi-eye"></i>
                    </button>
                  </form>

                  <a
                    href="/posts/edit?id=<?= $post['post_id']; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#postDeleteModal-<?php echo $posts[$i]["post_id"];?>">
                  <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="postDeleteModal-<?php echo $posts[$i]["post_id"];?>" tabindex="-1" aria-labelledby="postDeleteModal" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="postDeleteModal">Are you sure you want to delete?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                          <form method="post" action="/postmanage/delete" style="display:inline">
                            <input type="hidden" name="post_id" value="<?php echo $posts[$i]["post_id"];?>" style="width:0px"/>
                            <button class="btn btn-danger">Yes, I'm sure</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal end -->

                </div>
              </td>
            </tr>

            <?php }; ?>
            
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"?>