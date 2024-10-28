<?php 

function fetchAllUsers($conn) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    mysqli_close($conn);
    return $users;
}

function getUserById($conn, $id){
     $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; 
    }
}

function searchUsers($conn, $search_query) {
    $users = [];

    if (!empty($search_query)) {
        $search_query = mysqli_real_escape_string($conn, $search_query);

        $sql = "SELECT * FROM users WHERE first_name LIKE '%$search_query%' OR last_name LIKE '%$search_query%' OR email LIKE '%$search_query%'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('Query Error: ' . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    return $users;
}

function saveUser ($conn, $first_name, $last_name, $email, $gender, $avatar_path) {
    $sql = "INSERT INTO `users`(`id`, `first_name`, `last_name`, `email`, `gender`, `avatar`) VALUES (NULL, '$first_name', '$last_name', '$email', '$gender', '$avatar_path')";
    return mysqli_query($conn, $sql);
}

function updateUser ($conn, $id, $first_name, $last_name, $email, $gender, $avatar_path) {
    $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`gender`='$gender', `avatar`='$avatar_path' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function removeUser($conn, $id){
    $sql = "DELETE FROM `users` WHERE id = $id";
    return mysqli_query($conn, $sql);
}

?>