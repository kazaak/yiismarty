<?php

require_once dirname(__FILE__).'/determineUrl.php';

/**
 * Invokes Yii::app()->clientScript->registerLinkTag
 *
 * Syntax:
 * {linkTag rel="stylesheet" type="text/css" relativeUrl="..."}
 * {linkTag rel="stylesheet" type="text/css" relativeUrl="..." media="..."}
 * {linkTag rel="stylesheet" type="text/css" absoluteUrl="..."}
 * {linkTag rel="stylesheet" type="text/css" absoluteUrl="..." media="..."}
 */
function smarty_function_linkTag($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }

    if(!isset($params['rel'])) {
        throw new CException(Yii::t('yiiext','You must specify the rel attribute!'));
    }
    $rel = $params['rel'];

    if(!isset($params['type'])) {
        throw new CException(Yii::t('yiiext','You must specify the type attribute!'));
    }
    $type = $params['type'];

    $media = null;
    if(isset($params['media'])) {
        $media = $params['media'];
    }

    if(!empty($params['relativeUrl'])) {
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            $url = $controller->module->publishAssetFile($relativeUrl);
        }
        else {
            $url = Yii::app()->publishAssetFile($relativeUrl);
        }
    }
    else {
        $url = $params['absoluteUrl'];
    }

    Yii::app()->clientScript->registerLinkTag(
        $rel,$type,$url,$media
    );
} // function smarty_function_linkTag($params,&$smarty)
