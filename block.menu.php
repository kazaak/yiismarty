<?php

function smarty_block_menu($params,$content,&$smarty,$open) {
    if($open) {
        // tag opened, create the menu
        $smarty->assign('menu',array());
        return;
    }

    $controller = $smarty->tpl_vars['this']->value;
    $controller->menu = $smarty->tpl_vars['menu']->value;
} // function smarty_block_menu($params,$content,&$smarty,$open)
