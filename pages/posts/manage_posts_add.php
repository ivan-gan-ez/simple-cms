<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Post</h1>
      </div>
      <div class="card mb-2 p-4">

        <?php require "parts/message_error.php"?>

        <form method="post" action="/postmanage/add" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input type="text" class="form-control" id="post-title" name="title"/>
            <input type="hidden" class="form-control" id="post-user" name="user_id" value="<?= $_SESSION['user']['id']?>"/>
          </div>
          <div class="mb-3">
            <label for="post-title" class="form-label">Short description</label>
            <input type="text" class="form-control" id="post-desc" name="desc"/>
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea
              class="form-control"
              id="post-content"
              rows="8"
              name="content"
            ></textarea>
          </div>
          <div class="mb-3">
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Add</button>
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