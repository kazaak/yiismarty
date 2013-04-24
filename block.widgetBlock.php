<?php

function smarty_block_widgetBlock($params,$content,&$smarty,$open) {
    if($open) {
        return;
    }
    if(empty($params['property'])) {
        throw new CException(
            Yii::t('yiiext'
                  ,'You must specify property, the name of the property to set.'
            )
        );
    }
    $property = $params['property'];
    $widget = $smarty->tpl_vars['widget']->value;
    $widget->$property = $content;
} // function smarty_block_widgetBlock($params,$content,&$smarty,$open)
