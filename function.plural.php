<?php

// whatta >.>
require_once Yii::getPathOfAlias('application.extensions.yiiext.'
                                .'renderers.smarty.plugins')
            .'/function.t.php';

function smarty_function_plural($params, &$smarty) {
    if(isset($params['count'])) {
        $count = $params['count'];
        unset($params['count']);
        $text = $params['text'];
        if($count != 1) {
            $last = strtolower(substr($text,-1));
            if($last == 's') {
                $text .= 'es';
            }
            elseif($last == 'y') {
                $text = substr($text,0,-1).'ies';
            }
            else {
                $text .= 's';
            }
            $params['text'] = $text;
        }
    }
    return smarty_function_t($params,$smarty);
} // function smarty_function_plural($params, &$smarty) {
