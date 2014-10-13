<?php
/** used to help assess performance from within smarty templates.  To use this
 *  method, define the following in index.php:
 *
 * $ptstart = microtime(true);
 * function ptlog($msg) {
 *     global $ptstart;
 *     error_log("performance [".getmypid()."]: {$msg}: "
 *              .(microtime(true) - $ptstart));
 * }
 */
function smarty_function_ptlog($params,&$smarty) {
    ptlog($params['msg']);
}
