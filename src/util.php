<?php
namespace this7\util;
/**
 * This7 Frame
 * @Author: else
 * @Date:   2018-01-11 14:04:08
 * @Last Modified by:   else
 * @Last Modified time: 2018-01-12 02:23:05
 */

class util {

    private $postPayload = NULL;

    public function getHttpHeader($headerKey = '') {
        $headerKey = strtoupper($headerKey);
        $headerKey = str_replace('-', '_', $headerKey);
        $headerKey = 'HTTP_' . $headerKey;
        return isset($_SERVER[$headerKey]) ? $_SERVER[$headerKey] : '';
    }

    public function writeJsonResult($obj, $statusCode = 200) {
        header('Content-type: application/json; charset=utf-8');

        http_response_code($statusCode);
        echo json_encode($obj, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);

        logger::debug("util::writeJsonResult => [{$statusCode}]", $obj);
    }

    public function getPostPayload() {
        if (is_string(self::$postPayload)) {
            return self::$postPayload;
        }

        return file_get_contents('php://input');
    }

    public function setPostPayload($payload) {
        self::$postPayload = $payload;
    }
}