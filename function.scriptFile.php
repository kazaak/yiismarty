<?php
/**
 * Invokes Yii::app()->clientScript->registerScriptFile
 *
 * Syntax:
 * {scriptFile absoluteUrl="..."}
 * {scriptFile relativeUrl="..."}
 * {scriptFile ... position=ClientScript::POS_HEAD}
 */

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_scriptFile($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }

    $position = NULL;
    if(isset($params['position'])) {
        $position = $params['position'];
    }

    if(!empty($params['relativeUrl'])) {
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            $controller->module->publishScriptFile($relativeUrl,$position);
        }
        else {
            Yii::app()->publishScriptFile($relativeUrl,$position);
        }
    }
    else {
        Yii::app()->clientScript->registerScriptFile(
            $params['absoluteUrl'],$position
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)
