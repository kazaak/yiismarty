<?php

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
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            if(empty($params['nopublish'])) {
                $url = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias("{$controller->module->id}.assets")
                   .$params['relativeUrl']
                );
            }
            else {
                $relativeUrl = "assets/{$controller->module->id}/{$relativeUrl}";
            }
        }

        if(!isset($url)) {
            // either we're not in a module or they don't want to go the publish
            //  route
            $url = Yii::app()->request->baseUrl.$relativeUrl;
        }

        $clientScript->registerCssFile($url,$position);
    }
    else {
        $clientScript->registerCssFile(
            $params['absoluteUrl'],$media
        );
    }
} // function smarty_function_scriptFile($params,&$smarty)
