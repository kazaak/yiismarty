<?php

function smarty_function_resolveName($params,&$smarty) {
    if(!array_key_exists('model',$params)
    || !array_key_exists('attribute',$params)) {
        throw new Exception("model or attribute not specified");
    }
    $model = $params['model'];
    $attribute = $params['attribute'];
    if(array_key_exists('htmlOptions',$params)) {
        $htmlOptions = $smarty->tpl_vars[$params['htmlOptions']];
        CHtml::resolveNameId($model,$attribute,$htmlOptions);
        $smarty->assign($params['htmlOptions'],$htmlOptions);
        return $htmlOptions['name'];
    }
    elseif(array_key_exists('idHack',$params) && $params['idHack']) {
        $htmlOptions = array();
        CHtml::resolveNameId($model,$attribute,$htmlOptions);
        return $htmlOptions['id'];
    }
    return CHtml::resolveName($model,$attribute);
} // function smarty_function_resolveName($params,&$smarty)
