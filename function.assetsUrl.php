<?php

function smarty_function_assetsUrl($params,&$smarty) {
    if(!isset($params['alias'])) {
        throw new CException(Yii::t('app',<<<MESSAGE
Required parameter alias is missing!
MESSAGE
        ));
    }
    return WebAssetManager::singleton()->getAssetsUrl($params['alias']);
} // function smarty_function_assetsUrl($params,&$smarty)
