<?php

function smarty_function_createUrl($params,&$smarty) {
    if(empty($params['route'])) {
        throw new CException(Yii::t('yiiext',<<<ERROR
You must specify the route parameter
ERROR
        ));
    }
    $route = $params['route'];
    unset($params['route']);

    $controller = $smarty->tpl_vars['this']->value;

    echo $controller->createUrl($route,$params);
} // function smarty_function_createUrl($params,&$smarty)
