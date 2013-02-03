<?php
/**
 * Invokes complex logic to publish a module asset file
 *
 * Syntax:
 * {assetFile absoluteUrl="..."}
 * {assetFile relativeUrl="..."}
 */

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_assetFile($params,&$smarty) {
    if(!empty($params['relativeUrl'])) {
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            echo $controller->module->publishCssFile($relativeUrl,$media);
        }
        else {
            echo Yii::app()->publishCssFile($relativeUrl,$media);
        }
    }
    else {
        echo $params['absoluteUrl'];
    }

    echo $url;
} // function smarty_function_assetFile($params,&$smarty)
