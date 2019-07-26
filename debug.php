<?php
/**
 * @link https://github.com/lav45/debug
 * @author Alexey Loban <lav451@gmail.com>
 *
 * Example use:
 *    debug();
 *    debug($_POST);
 *    debug($_GET, $_POST, ...);
 */
function debug()
{
    // Install: https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc
    // if (empty($_COOKIE['XDEBUG_SESSION'])) return;
    ob_get_level() && ob_clean();
    $wrap = true;
    switch (func_num_args()) {
        case 0:
            $res = (new \Exception())->getTraceAsString();
            $wrap = false;
            break;
        case 1:
            $res = func_get_arg(0);
            break;
        default:
            $res = func_get_args();
            break;
    }
    if ($wrap && !is_string($res)) {
        $func = is_scalar($res) || null === $res ? 'var_export' : 'print_r';
        $res = $func($res, true);
    }
    $isAjax =
        (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') &&
        (isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json');

    $isHtml = isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'text/html') !== false;

    if ($isHtml && !$isAjax) {
        $res = '<pre>' . htmlspecialchars($res, ENT_IGNORE) . '</pre>';
    }
    exit($res);
}

