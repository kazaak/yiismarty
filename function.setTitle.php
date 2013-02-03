<?php

function smarty_function_setTitle($params,&$smarty) {
    if(!isset($params['title'])) {
        throw new CException(Yii::t('yiiext','Required parameter title missing.'));
    }
    $controller = $smarty->tpl_vars['this']->value;
    $controller->pageTitle = $params['title'];
} // function smarty_function_setTitle($params,&$smarty)
