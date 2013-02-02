<?php

function determineUrl($params,&$smarty) {
    if((empty($params['relativeUrl']) && empty($params['absoluteUrl']))
     &&(!empty($params['relativeUrl']) && !empty($params['absoluteUrl']))) {
        throw new CException(Yii::t('yiiext','You must specify one of relativeUrl or absoluteUrl, but not both'));
    }

    if(!empty($params['relativeUrl'])) {
        $relativeUrl = $params['relativeUrl'];
        $controller = $smarty->tpl_vars['this']->value;
        if(isset($controller->module) && empty($params['nomodule'])) {
            if(empty($params['nopublish'])) {
                $hashByName = false;
                if(!empty($params['hasbyname'])) {
                    $hashByName = true;
                }
                $url = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias("{$controller->module->id}.assets")
                   .$params['relativeUrl']
                   ,$hashByName
                );
            }
            else {
                $relativeUrl = "assets/{$controller->module->id}/{$relativeUrl}";
            }
        }
        elseif(empty($params['nopublish'])) {
            $hashByName = false;
            if(!empty($params['hashbyname'])) {
                $hashByName = true;
            }
            $url = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias("application.assets").$params['relativeUrl']
               ,$hashByName
            );
        }

        if(!isset($url)) {
            // either we're not in a module or they don't want to go the publish
            //  route
            $url = Yii::app()->request->baseUrl.$relativeUrl;
        }
    }
    else {
        $url = $params['absoluteUrl'];
    }

    return $url;
} // function determineUrl($params,&$smarty)
