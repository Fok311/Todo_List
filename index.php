<?php
    $database = new PDO('mysql:host=devkinsta_db;dbname=My_Todo_List', 'root', 'zfIy4pGBfg44X1nE'); //Your database password

    $query = $database->prepare('SELECT * FROM My_Todo_List');
    $query->execute();

    $My_Todo_List = $query->fetchAll();

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
    ) {
        var_dump($_POST['action']);

        if($_POST['action'] === 'add') {
            //add new student
            $statement = $database->prepare(
                'INSERT INTO My_Todo_List (`name`) 
                values (:name)'
            );
            $statement->execute([
                'name' => $_POST['Todo']
            ]);
    
            header('Location: /');
            exit;
        }

        if($_POST['action'] === 'delete') {
            // delete student
            $statement = $database->prepare('DELETE FROM My_Todo_List WHERE id = :id');
            $statement->execute ([
                'id' => $_POST['Todo_id']
            ]);
        }
    }
    //var_dump( $students );
?>


<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <?php foreach ( $My_Todo_List as $My_Todo_List) : ?>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <button class="btn btn-sm btn-success">
                <i class="bi bi-check-square"></i>
              </button>
              <span class="ms-2">
                <?php echo $My_Todo_List['name']; ?> 
              </span>
            </div>
            <div>
              <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                <input
                type="hidden"
                name="Todo_id"
                value="<?php echo $My_Todo_List['id']; ?>"
                />
                <input
                type="hidden"
                name="action"
                value="delete"
                />
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
              </form>
            </div>
          </li>
          <?php endforeach; ?>
          <!-- <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <button class="btn btn-sm btn-light">
                <i class="bi bi-square"></i>
              </button> -->
              <!-- <span class="ms-2 text-decoration-line-through">Task 2</span>
            </div>
            <div>
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </li>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <button class="btn btn-sm btn-light">
                <i class="bi bi-square"></i>
              </button>
              <span class="ms-2 text-decoration-line-through">Task 3</span>
            </div>
            <div>
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </li> -->
        </ul>
        <div class="mt-4">
          <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="Todo"
              required
            />
            <input
            type="hidden"
            name="action"
            value="add"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
