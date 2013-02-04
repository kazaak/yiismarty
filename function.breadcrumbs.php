<?php

function smarty_function_breadcrumbs($params,&$smarty) {
    $controller = $smarty->tpl_vars['this']->value;
    if(!isset($params['var'])) {
        if(isset($controller->module)) {
            $controller->breadcrumbs = $controller->module->breadcrumbs;
        }
        return;
    }
    $var = $params['var'];
    $value = $params['value'];
    $controller->breadcrumbs[$var] = $value;
} // function smarty_function_breadcrumbs($params,&$smarty)
