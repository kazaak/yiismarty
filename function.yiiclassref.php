<?php

function smarty_function_yiiclassref($params,&$smarty) {
    if(empty($params['class'])) {
        throw new CException(Yii::t('yiiext','You must specify the class parameter.'));
    }
    $class = $params['class'];
    $version = '1.1';
    // hopefully, 2.0 will use the same structure for documentation >.>
    if(!empty($params['version'])) {
        $version = $params['version'];
    }
    echo CHtml::link(
        CHtml::encode($params['class'])
       ,"http://www.yiiframework.com/doc/api/{$version}/{$class}/"
       ,array('target' => '_blank')
    );
} // function smarty_function_yiiclassref($params,&$smarty)
