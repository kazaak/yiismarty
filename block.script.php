<?php

function smarty_block_script($params,$content,&$smarty,$open) {
    if($open) {
        // tag opened, nothing to do here
        return;
    }

    if(empty($params['id'])) {
        throw new CException(Yii::t('yiiext','You must specify id.'));
    }

    $clientScript = Yii::app()->clientScript;
    $position = NULL;
    if(!empty($params['position'])) {
        $position = $params['position'];
    }
    $clientScript->registerScript(
        $params['id'],$content,$position
    );
} // function smarty_block_script($params,$content,&$smarty,$open)
