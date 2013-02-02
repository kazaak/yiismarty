<?php

function smarty_block_jSmart($params,$content,&$smarty,$open) {
    if($open) {
        $smarty->assign('jsmart-state',array(
            $smarty->left_delimiter
           ,$smarty->right_delimiter
        ));
        $smarty->left_delimiter = '{{';
        $smarty->right_delimiter = '}}';
        return;
    }

    $state = $smarty->tpl_vars['jsmart-state']->value;
    $smarty->left_delimiter = $state[0];
    $smarty->right_delimiter = $state[1];
    $smarty->clearAssign('jsmart-state');

    if(isset($params['assign'])) {
        $smarty->assign($params['assign'],$content);
        return;
    }
    echo $content;
} // function smarty_block_jSmart($params,$content,&$smarty,$open)
