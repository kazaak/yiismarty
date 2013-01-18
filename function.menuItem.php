<?php

function smarty_function_menuItem($params,&$smarty) {
    $menuItem = array();
    foreach($params as $key => $value) {
        switch($key) {
        case 'label':
        case 'url':
        case 'visible':
        case 'widget':
            $menuItem[$key] = $value;
            unset($params[$key]);
            break;
        }
    }
    // this is my hack to support widgets in menus.  widgetOptions is used to
    //  initialize widgets specified with the 'widget' parameter above.
    if(!empty($params)) {
        $menuItem['widgetOptions'] = $params;
    }
    $menu = $smarty->tpl_vars['menu']->value;
    array_push($menu,$menuItem);
    $smarty->assign('menu',$menu);
} // function smarty_function_menuItem($params,&$smarty)
