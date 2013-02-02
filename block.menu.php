<?php

function smarty_block_menu($params,$content,&$smarty,$open) {
    if($open) {
        // tag opened, create the menu
        $smarty->assign('yii-menu',array());
        return;
    }

    $controller = $smarty->tpl_vars['this']->value;
    $controller->menu = $smarty->tpl_vars['menu']->value;
    $smarty->clearAssign('yii-menu');
} // function smarty_block_menu($params,$content,&$smarty,$open)
