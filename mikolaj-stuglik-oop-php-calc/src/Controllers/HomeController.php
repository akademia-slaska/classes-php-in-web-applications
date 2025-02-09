<?php

namespace Controllers;

use Controllers\Base\ControllerBase;
class HomeController extends ControllerBase
{
    public function home() {
        return ['template' => 'home.php'];
    }
}