<?php

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_cssFile($params,&$smarty) {
    $media = '';
    if(!empty($params['media'])) {
        $media = $params['media'];
    }

    $url = determineUrl($params,$smarty);

    $clientScript = Yii::app()->clientScript;
    $clientScript->registerCssFile($url,$media);
} // function smarty_function_scriptFile($params,&$smarty)
