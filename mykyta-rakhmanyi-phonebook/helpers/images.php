<?php 

function uploadAvatar($file, $target_dir) {
    $uploadOk = 1;
    $target_file = "";
    
    if (!empty($file["name"])) {
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $unique_id = uniqid(); 
        $target_file = $target_dir . $unique_id . '.' . $imageFileType; 

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($file["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return false;
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file; 
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }
    
    return "";
}

function deleteAvatar($avatar_path) {
    if (file_exists($avatar_path)) {
        if (!unlink($avatar_path)) {
            echo "Error deleting the avatar image.";
        }
    }
}

?>