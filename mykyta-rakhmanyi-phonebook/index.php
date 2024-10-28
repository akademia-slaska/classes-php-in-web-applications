<?php
  include "./helpers/db_conn.php";
  include "./helpers/images.php";
  include "./helpers/users.php";
  include "./helpers/renders.php";

  session_start();
  $users = fetchAllUsers($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <title>PHP users Application</title>
  <link rel="stylesheet" href="./css/style.css"/>

</head>

<body>
  <nav class="navbar navbar-dark bg-dark mb-5 py-3">
  <div class="container">
    <a class="navbar-brand" href="index.php">Contact list</a>
    <form class="d-flex" action="search.php" method="GET">
      <input class="form-control me-2" type="search" name="search_query" placeholder="Search people..." aria-label="Search">
      <button class="btn btn-light" type="submit">
        <i class="fa-solid fa-magnifying-glass fs-5"></i>
      </button>
    </form>
  </div>
</nav>

  <div class="container ">
    <?php
      if (isset($_SESSION["msg"])) {
        $msg = $_SESSION["msg"];
        echo renderAlert($msg);
        unset($_SESSION["msg"]);
      }
    ?>
     <div class="row">
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <?php echo renderUserCard($user); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><div class="alert alert-warning text-center" role="alert">No users found.</div></div>
            <?php endif; ?>
        </div>
    <a href="add-new.php" class="btn btn-dark add-btn position-fixed fs-2 rounded-circle">
      <i class="fa-solid fa-plus"></i>
    </a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>