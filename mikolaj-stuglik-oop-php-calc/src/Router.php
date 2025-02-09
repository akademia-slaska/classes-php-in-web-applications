<?php

class Router {
    private $routes = [
        '/' => 'Controllers\\HomeController::home',
        '/calc/' => 'Controllers\CalcCorntroller::calc',
    ];

    public function __construct(
        private string $route
    ) {
    }

    public function getRoute()
    {
        return $this->routes[$this->route] ?? null;
    }

    public function fireController(string $tamplateDir) {
        $route = $this->getRoute();

        if (empty($route)) {
            echo file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/' . explode('?', $this->route)[0]);
            return;
        }
        try {
            $class = explode('::', $route);
            $controller = new $class[0]();
            $controller->setRequest($_REQUEST);
            $templateParams = $controller->{$class[1]}();

            if (is_array($templateParams) && array_key_exists('template', $templateParams) && $templateParams['template'] !== null) {
                require $tamplateDir . $templateParams['template'];
            } elseif (is_array($templateParams) || $templateParams instanceof stdClass) {
                echo json_encode($templateParams);
            }
        } catch (Exception $e) {
            http_response_code(400);
            throw $e;
        }
    }


}