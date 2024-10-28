<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>To-Do List</title>
</head>

<body>
    <div class="wrapper">
        <div class="todo">
            <h1 class="todo__title">To-Do List</h1>
            <div class="todo__add">
                <form class="todo__form" action="add_task.php" method="post">
                    <input class="todo__input" type="text" placeholder="Add new activity..." name="new_task">
                    <button class="todo__button todo__button_add">Add</button>
                </form>
            </div>
            <div class="todo__current">
                <h2 class="todo__sub-title">Current activities</h2>
                <ul class="todo__list">

                    <?php
                    include 'db.php';

                    $items = $db->query('SELECT * FROM task ORDER BY is_completed, created_at DESC');

                    while ($item = $items->fetchArray()) {
                    ?>
                        <li class="todo__item item-todo">
                            <p class="item-todo__text"><?php echo $item['name'] ?></p>
                            <form class="item-todo__form" action="update_task.php" method="post" name="update_form">
                                <input type="hidden" name="task_id" value="<?php echo $item['id'] ?>">
                                <input class="item-todo__input"
                                    name="is_task_completed"
                                    type="checkbox"
                                    <?php echo $item['is_completed'] === 1 ? 'checked' : '' ?>>
                            </form>
                            <a class="item-todo__button" href="delete_task.php? id= <?php echo $item['id'] ?>">Delete</a>
                        </li>

                    <?php
                    };
                    ?>

                </ul>
            </div>
        </div>
    </div>
    
    <script async src="js/script.js"></script>
</body>

</html>