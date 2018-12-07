<?php

/**
 * Created by PhpStorm.
 * User: Катерина
 * Date: 05.12.2018
 * Time: 17:11
 */
function calculateResult($calcVar1, $calcVar2, $calcOper, &$vars) {


    if (isset($calcVar1) && isset($calcVar2)) {
        if (is_numeric($calcVar1) && is_numeric($calcVar2)) {
            $calculate = $calcVar1 . $calcOper . $calcVar2;
            if (($calcOper == "/") && ($calcVar2 == 0)) {
                $vars['result'] = "На ноль делить нельзя";
            } else {
                $resultOfCalc = eval("return $calculate;");
                $vars['result'] = $calcVar1 . ' ' . $calcOper . ' ' . $calcVar2 . ' = ' . $resultOfCalc;
            }
        } else {$vars['result'] = "не вверно введены данные";}
//        header('Location: http://php1.oleg/calc/');
    } 
}
