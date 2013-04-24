<?php

function smarty_function_css($params,$content,&$smarty,$open) {
    if($open) {
        // tag opened, nothing to do here
        return;
    }

    if(empty($params['id'])) {
        throw new CException(Yii::t('yiiext','You must specify an id'));
    }

    $clientScript = Yii::app()->clientScript;
    $media = '';
    if(!empty($params['media'])) {
        $media = $params['media'];
    }
    $clientScript->registerCss(
        $params['id'],$content,$media
    );
} // function smarty_function_css($params,$content,&$smarty,$open)
