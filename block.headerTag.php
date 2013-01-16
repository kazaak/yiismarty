<?php

function smarty_block_headerTag($params,$content,$template,$open) {
    if($open) {
        // tag opened, nothing to do here
        return;
    }

    $htmlOptions = array();
    foreach($params as $key => $value) {
        if($key === 'id') {
            $id = $params['id'];
            continue;
        }
        if($key == 'tag') {
            $tag = $params['tag'];
            continue;
        }
        $htmlOptions[$key] = $value;
    }

    if(!isset($id)) {
        throw new CException(Yii::t('yiiext',<<<ERROR
id parameter must be specified.
ERROR
        ));
    }

    if(!isset($tag)) {
        $tag = 'script';
    }
    Yii::app()->clientScript->registerHeaderTag($id,$tag,$content,$htmlOptions);
} // function smarty_block_headerTag($params,$content,$template,&$repeat)
