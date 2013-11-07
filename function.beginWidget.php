<?php

/** @see smarty_block_begin_widget.  this addresses a shortcoming of that
  *   method.  Specifically, if we use beginWidget & it in turn creates a form,
  *   we need to be able to create that form without closing it.  So, if the
  *   widget init() method renders a smarty template that needs to open a form,
  *   it needs this method to do that.
  */
function smarty_function_beginWidget($params,&$smarty) {
    smarty_block_begin_widget($params,'',$smarty,true);
} // function smarty_function_beginWidget($params,&$smarty)
