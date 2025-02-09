<?php

namespace Controllers\Base;
abstract class ControllerBase
{
    protected array $request;
    public function setRequest(?array $request)
    {
        $this->request = $request;
    }
}