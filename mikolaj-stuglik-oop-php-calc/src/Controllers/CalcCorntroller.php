<?php

namespace Controllers;

use Controllers\Base\ControllerBase;
use Validators\CalculateValidator;
use Exception;
class CalcCorntroller extends ControllerBase
{
    public function calc() {
        $toCalc = $this->request['toCalc'];

        if(!CalculateValidator::validateCalc($toCalc)) {
            throw new Exception('Nieporawne działanie');
        }

        $rs = null;

        eval('$rs = ' . str_replace('^', '**', $toCalc) . ';');
        return ['result' => $rs];
    }
}