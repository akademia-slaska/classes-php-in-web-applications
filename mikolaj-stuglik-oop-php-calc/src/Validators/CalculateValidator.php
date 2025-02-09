<?php

namespace Validators;

class CalculateValidator
{
    public static function validateCalc(string $calculation) {
        $isValid = true;
        if(preg_match('/([A-Z]|[a-z])+/', $calculation)) {
            $isValid = false;
        }

        return $isValid;
    }
}