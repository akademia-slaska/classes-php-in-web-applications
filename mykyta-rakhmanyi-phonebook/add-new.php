<?php
include "./helpers/db_conn.php";
include "./helpers/users.php";
include "./helpers/images.php";

session_start();

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    
    $target_dir = "uploads/";
    $target_file = uploadAvatar($_FILES["avatar"], $target_dir);

    $result = saveUser($conn, $first_name, $last_name, $email, $gender, $target_file);

    if ($result) {
        $_SESSION['msg'] = "New record created successfully";
        header("Location: index.php");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }

   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP users Application</title>
   
   <link rel="stylesheet" href="./css/style.css"/>
</head>

<body>
   <nav class="navbar navbar-dark bg-dark mb-5 py-3">
   <div class="container">
      <a class="navbar-brand" href="index.php">Contact list</a>
      <form class="d-flex">
         <input class="form-control me-2" type="search" placeholder="Search people..." aria-label="Search">
         <button class="btn btn-light" type="submit">
         <i class="fa-solid fa-magnifying-glass fs-5"></i>
         </button>
      </form>
   </div>
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form class="needs-validation" novalidate action="" method="post" enctype="multipart/form-data" >
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Albert" required>
                   <div class="invalid-feedback">
                     First name must not be empty!
                  </div>
               </div>

               <div class="col">
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Einstein" required>
                  <div class="invalid-feedback">
                     Last name must not be empty!
                  </div>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
               <div class="invalid-feedback">
                  Provide a correct email!
               </div>
            </div>

            <div class="form-group mb-3">
               <label>Gender:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="male" required value="male">
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="female" required value="female">
               <label for="female" class="form-input-label">Female</label>
               <div class="invalid-feedback">
                  Choose a gender!
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Upload Avatar:</label>
               <div class="input-group">
                  <input type="file" id="img-input" class="form-control" name="avatar" accept="image/*">        
                  <button class="btn btn-outline-secondary" type="button" id="clear-img-btn">Clear</button>
               </div>
               <div class="avatar-preview mt-2">
                  <img id="avatar-preview-img" src="#" alt="Current Avatar">
               </div>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <script src="./js/form-validate.js"></script>
   <script src="./js/script.js"></script>
</body>

</html>