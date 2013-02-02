<?php
/**
 * Invokes complex logic to publish a module asset file
 *
 * Syntax:
 * {assetFile absoluteUrl="..."}
 * {assetFile relativeUrl="..."}
 */

require_once dirname(__FILE__).'/determineUrl.php';

function smarty_function_assetFile($params,&$smarty) {
    $url = determineUrl($params,$smarty);

    echo $url;
} // function smarty_function_assetFile($params,&$smarty)
