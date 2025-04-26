<?php

namespace app\controller;

use app\common\utils\Curl;
use think\annotation\route\Route;

class Chat
{
    #[Route('GET','/chat/settext')]
    public function settext(){
        $token =  env("OPENROUTE_TOKEN");
        $url = env("OPENROUTE_CHAT");
        $model = env("MDS","deepseek/deepseek-chat-v3-0324:free");
        // $message = request()->param("text");
// 构造 JSON 数据
$data = [
    "model" => $model,
    "messages" => [
        [
            "role" => "user",
            "content" => "request()->param('text')"
        ]
    ],
    "stream" => true,
    "max_tokens" => 1024,
    "stop" => null,
    "temperature" => 0.7,
    "top_p" => 0.7,
    "top_k" => 50,
    "frequency_penalty" => 0.5,
    "n" => 1,
    "response_format" => [
        "type" => "text"
    ],
];
        $result = Curl::request($url,'POST',json_encode($data),[
            'Content-Type: application/json',
            "$token",
        ]);
        return json($result);
    }
    #[Route('GET','/models')]
    public function models(){
        $url = env("OPENROUTE_MODELS");
        $result = Curl::request($url,'GET');
        return json($result);
    }
}