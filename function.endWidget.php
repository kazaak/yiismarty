<?php

/** @see smarty_block_begin_widget.  This addresses a shortcoming of that
  *   method.  Specifically, if we use beginWidget & it in turn creates a form,
  *   we need to be able to create that form without closing it.  So, if the
  *   widget init() method has started a form, the widget run() method needs to
  *   close the form, and this method allows that.
  */
function smarty_function_endWidget($params,&$smarty) {
    smarty_block_begin_widget($params,'',$smarty,false);
} // function smarty_function_endWidget($params,&$smarty)
