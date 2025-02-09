<?php

function autoload($class) {
    require __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php';
}