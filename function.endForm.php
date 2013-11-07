<?php

/** @see smarty_function_endWidget.
  */
function smarty_function_endForm($params,&$smarty) {
    $repeat = false;
    smarty_block_form($params,'',$smarty,$repeat);
} // function smarty_function_endForm($params,&$smarty)
