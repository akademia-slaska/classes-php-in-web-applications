<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "todo";
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Błąd połączenia: " . $e->getMessage());
        }
    }
}

class Task {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addTask($task) {
        $sql = "INSERT INTO tasks (task) VALUES (:task)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(['task' => $task]);
    }

    public function getTasks() {
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}

$db = new Database();
$task = new Task($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task->addTask($_POST['task']);
    header("Location: index.php");
}

if (isset($_GET['delete'])) {
    $task->deleteTask($_GET['delete']);
    header("Location: index.php");
}

$tasks = $task->getTasks();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista zadań</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            width: calc(100% - 22px);
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
        }
        a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista zadań</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Nowe zadanie" required>
            <button type="submit">Dodaj</button>
        </form>
        <ul>
            <?php foreach ($tasks as $t): ?>
                <li>
                    <?= htmlspecialchars($t['task']) ?>
                    <a href="?delete=<?= $t['id'] ?>">&#10060;</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
