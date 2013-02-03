<?php
/**
 * Invokes Yii::app()->clientScript->registerScriptFile
 *
 * Syntax:
 * {scriptFile absoluteUrl="..."}
 * {scriptFile relativeUrl="..."}
 * {scriptFile ... position="ClientScript::POS_HEAD"}
 */

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_scriptFile($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }

    $position = NULL;
    if(!empty($params['position'])) {
        $position = $params['position'];
        switch($position) {
            case 'POS_HEAD': $position = CClientScript::POS_HEAD; break;
            case 'POS_BEGIN': $position = CClientScript::POS_BEGIN; break;
            case 'POS_END': $position = CClientScript::POS_END; break;
            default: throw new CException(Yii::t('app','Invalid position {position}',array('{position}' => $position)));
        }
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
        Yii::app()->clientManager->registerScriptFile(
            $params['absoluteUrl'],$position
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)
