<?php
/**
 * Invokes Yii::app()->clientScript->registerScriptFile
 *
 * Syntax:
 * {scriptFile absoluteUrl="..."}
 * {scriptFile relativeUrl="..."}
 * {scriptFile ... position="ClientScript::POS_HEAD"}
 */

function smarty_function_scriptFile($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }
    $clientScript = Yii::app()->clientScript;
    $position = NULL;
    if(!empty($params['position'])) {
        $position = $params['position'];
    }
    if(!empty($params['relativeUrl'])) {
        $clientScript->registerScriptFile(
            Yii::app()->request->baseUrl.$params['relativeUrl'],$position
        );
    }
    else {
        $clientScript->registerScriptFile(
            $params['absoluteUrl'],$position
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)

function smarty_function_script($params,&$smarty) {
    if(empty($params['id']) || empty($params['script'])) {
        throw new CException(Yii::t('yiiext','You must specify id and script.'));
    }
    $clientScript = Yii::app()->clientScript;
    $position = NULL;
    if(!empty($params['position'])) {
        $position = $params['position'];
    }
    $clientScript->registerScript(
        $params['id'],$params['script'],$position
    );
} // function smarty_function_script($params,&$smarty)

function smarty_function_cssFile($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }
    $clientScript = Yii::app()->clientScript;
    $media = '';
    if(!empty($params['media'])) {
        $media = $params['media'];
    }
    if(!empty($params['relativeUrl'])) {
        $clientScript->registerCssFile(
            Yii::app()->request->baseUrl.$params['relativeUrl'],$media
        );
    }
    else {
        $clientScript->registerCssFile(
            $params['absoluteUrl'],$media
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)

function smarty_function_css($params,&$smarty) {
    if(empty($params['id']) || empty($params['css'])) {
        throw new CException(Yii::t('yiiext','You must specify both id and css'));
    }
    $clientScript = Yii::app()->clientScript;
    $media = '';
    if(!empty($params['media'])) {
        $media = $params['media'];
    }
    $clientScript->registerCss(
        $params['id'],$params['css'],$media
    );
} // function smarty_function_scriptFile($params,&$smarty)
