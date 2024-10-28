<?php 

function renderAlert($msg) {
    return '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($msg) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

function renderUserCard($user) {
    return '<div class="col-md-3 mb-4 d-flex flex-wrap">
                <div class="card w-100">
                    <img src="' . ($user['avatar'] ? $user['avatar'] : './images/default-user.png') . '" class="card-img-top" alt="User  Avatar" style="object-fit: cover; height: 200px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">' . htmlspecialchars($user["first_name"] . ' ' . $user["last_name"]) . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted">' . htmlspecialchars($user["email"]) . '</h6>
                        <p class="card-text">Gender: ' . htmlspecialchars($user["gender"]) . '</p>
                        <div class="card-footer border-0 bg-white">
                            <a href="edit.php?id=' . $user["id"] . '" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=' . $user["id"] . '" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>';
}

?>
