<?php

$database = connectToDB();

    $sql = "SELECT * FROM users";

    $query = $database->prepare($sql);

    $query->execute();

    $users = $query->fetchAll();

?>

<?php require "parts/header.php"?>

    <div class="container mx-auto my-5" style="max-width: 800px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Users</h1>
        <div class="text-end">
          <a href="/users/add" class="btn btn-primary btn-sm"
            >Add New User</a
          >
        </div>
      </div>

      <?php require "parts/message_error.php"?>
      <?php require "parts/message_success.php"?>

      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            
          <?php foreach ($users as $i => $user) :?>

            <tr>
              <th scope="row"> <?= $user['id']?> </th>
              <td class="text-break"> <?= $user['name']?> </td>
              <td> <?= $user['email']?> </td>
              <td>

                <?php if ($user['role'] === 'admin'){
                  echo "<span class='badge bg-primary'>Admin</span>";
                } else if ($user['role'] === 'editor'){
                  echo "<span class='badge bg-info'>Editor</span>";
                } else {
                  echo "<span class='badge bg-success'>User</span>";
                }?>

              </td>
              <td class="text-end">
                <div class="buttons" style="min-width: 135px;">
                
                  <a
                    href="/users/edit?id=<?= $user['id']; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>

                  <a
                    href="/users/changepwd"
                    class="btn btn-warning btn-sm me-2"
                    ><i class="bi bi-key"></i
                  ></a>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#userDeleteModal-<?php echo $users[$i]["id"];?>">
                  <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="userDeleteModal-<?php echo $users[$i]["id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          This action cannot be undone. <?php echo $users[$i]["name"];?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                          <form method="post" action="/usermanage/delete" style="display:inline">
                            <input type="hidden" name="user_id" value="<?php echo $users[$i]["id"];?>" style="width:0px"/>
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

          <?php endforeach; ?>

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