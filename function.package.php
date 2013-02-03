<?php

function smarty_function_package($params,&$smarty) {
    if(empty($params['name'])) {
        throw new CException(Yii::t('app',<<<MESSAGE
Required parameter name is missing.
MESSAGE
        ));
    }
    WebAssetManager::Singleton()->publishPackage($params['name']);
} // function smarty_function_package($params,&$smarty)
