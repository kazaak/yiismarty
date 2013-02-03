<?php

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_cssFile($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }

    $media = '';
    if(!empty($params['media'])) {
        $media = $params['media'];
    }

    if(!empty($params['relativeUrl'])) {
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            $controller->module->publishCssFile($relativeUrl,$media);
        }
        else {
            Yii::app()->publishCssFile($relativeUrl,$media);
        }
    }
    else {
        Yii::app()->clientManager->registerCssFile(
            $params['absoluteUrl'],$media
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)
