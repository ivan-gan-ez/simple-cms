<?php

$database = connectToDB();

$post_id = $_GET['id'];

$sql = "SELECT * FROM posts WHERE post_id = :id";
$query = $database->prepare($sql);
$query->execute(["id" => $post_id]);
$post = $query->fetch();

if ( !isEditor() && $post['user_id'] !== $_SESSION['user']['id']){
  header("Location: /posts/manage");
  exit;
};

$title = $post['title'];
$shortdesc = $post['shortdesc'];
$content = $post['content'];
$status = $post['status'];

?>
<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit <?= $title ?> </h1>
      </div>
      <div class="card mb-2 p-4">

      <?php require "parts/message_error.php"?>

        <form method="post" action="/postmanage/update">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="post-title"
              name="title"
              value="<?= $title ?>"
            />
            <input
              type="hidden"
              class="form-control"
              id="post-id"
              name="post_id"
              value="<?= $post_id ?>"
            />
          </div>
          <div class="mb-3">
            <label for="post-desc" class="form-label">Short description</label>
            <input
              type="text"
              class="form-control"
              id="post-desc"
              name="desc"
              value="<?= $shortdesc ?>"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea
            class="form-control"
            id="post-content"
            rows="8"
            name="content"
            placeholder="Content"><?= $content ?></textarea>
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Status</label>
            <select class="form-control" id="post-status" name="status">
              <option value="pending" <?php echo ( $post["status"] === "pending" ? "selected" : "" ); ?>>Pending for Review</option>
              <option value="published" <?php echo ( $post["status"] === "published" ? "selected" : "" ); ?>>Publish</option>
            </select>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/posts/manage" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"?>