<?php

if ( !isAdmin() ){
  header("Location: /dashboard");
  exit;
};

$database = connectToDB();

$id = $_GET["id"];

$sql = "SELECT * FROM users WHERE id = :id";
$query = $database->prepare($sql);
$query->execute(["id" => $id]);
$user = $query->fetch();

$name = $user["name"];
$email = $user["email"];
$role = $user["role"];
?>

<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit User</h1>
      </div>
      <div class="card mb-2 p-4">

      <?php require "parts/message_error.php"?>

        <form method="post" action="/usermanage/update">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>"/>
                <input type="hidden" name="id" value="<?= $id?>" style="width:0px"/>
              </div>
              <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" disabled/>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" value=" <?= $role ?> ">
              <option value="">Select an option</option>
              <option value="user" <?php echo ( $user["role"] === "user" ? "selected" : "" ); ?>>User</option>
              <option value="editor" <?php echo ( $user["role"] === "editor" ? "selected" : "" ); ?>>Editor</option>
              <option value="admin" <?php echo ( $user["role"] === "admin" ? "selected" : "" ); ?>>Admin</option>
            </select>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/users/manage" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>

    <?php require "parts/footer.php"?>