<?php

class DataBase extends SQLite3 {
    function __construct() {
        $this->open('todo.db');
    }
}

$db = new DataBase();

// $db->exec('DROP TABLE IF EXISTS task');

$db->exec('CREATE TABLE IF NOT EXISTS task (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    is_completed INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT current_timestamp
)');

