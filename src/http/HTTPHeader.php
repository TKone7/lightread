<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 11:23
 */

namespace http;


class HTTPHeader implements HTTPStatusCode
{
    use HTTPStatusHeader;

    public static function redirect($redirect_path, $statusCode = HTTPStatusCode::HTTP_301_MOVED_PERMANENTLY) {
        header("Location: " . $GLOBALS["ROOT_URL"] . $redirect_path, true, self::getStatusCodeNumber($statusCode));
        exit;
    }
}