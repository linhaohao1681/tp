<?php

namespace app\common\utils;

class Curl
{
    public static function request($url, $method = 'GET', $data = [], $headers = [], $timeout = 120)
    {
        $ch = curl_init();

        // 设置请求方式
        $method = strtoupper($method);
        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? http_build_query($data) : $data);
                break;
            case 'PUT':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? http_build_query($data) : $data);
                break;
            case 'GET':
                if (!empty($data)) {
                    $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($data);
                }
                break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 不直接输出
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['success' => false, 'error' => $error];
        }

        return ['success' => true, 'data' => $response];
    }
}
