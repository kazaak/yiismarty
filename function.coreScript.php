<?php

function smarty_function_coreScript($params,&$smarty) {
    if(empty($params['name'])) {
        throw new CException(Yii::t('yiiext','You must specify the core script name'));
    }
    $clientScript = Yii::app()->clientScript;
    $clientScript->registerCoreScript($params['name']);
} // function smarty_function_scriptFile($params,&$smarty)

