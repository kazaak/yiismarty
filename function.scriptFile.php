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

    $url = determineUrl($params,$smarty);

    $clientScript = Yii::app()->clientScript;
    $clientScript->registerScriptFile($url,$position);
} // function smarty_function_scriptFile($params,&$smarty)
