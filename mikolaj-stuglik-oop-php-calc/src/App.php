<?php

class App
{
    public function __construct(
        private array $config
    ) {

    }

    public function run() {
        $router = new Router($_SERVER['REQUEST_URI']);
        $router->fireController($this->config['template_dir']);
    }
}