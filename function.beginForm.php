<?php

/** @see smarty_block_beginWidget
  */
function smarty_function_beginForm($params,&$smarty) {
    // don't ask :(
    require_once Yii::getPathOfAlias('application.extensions.smarty.plugins')
                .DIRECTORY_SEPARATOR.'block.form.php';

    $repeat = true;
    smarty_block_form($params,'',$smarty,$repeat);
} // function smarty_function_beginWidget($params,&$smarty)
