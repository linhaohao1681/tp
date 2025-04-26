<?php

namespace app\controller;

use app\BaseController;
use think\annotation\route\route;
use think\Response;
use think\facade\Db;

class Index extends BaseController
{
    #[Route('GET','/iii')]
    public function iii(): Response
    {
      $remoteZip = 'http://my2025.ct.ws/dow_ev/wp-content/uploads/2025/04/vendor.zip'; // <-- 替换成你的地址
        $targetZip = dirname(__DIR__, 2) . '/vendor.zip';  // 项目根目录
        $extractPath = dirname(__DIR__, 2) . '/';    // 解压到 vendor/

        // 下载远程文件
        $zipData = @file_get_contents($remoteZip);
        if ($zipData === false) {
            return json(["code" => 201,"msg" =>"❌ 无法下载 zip 文件"]);
        }

        file_put_contents($targetZip, $zipData);

        // 解压
        $zip = new \ZipArchive;
        if ($zip->open($targetZip) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
            unlink($targetZip);
            return json(["code" => 201,"msg" =>"✅ 安装成功！"]);
        } else {
            return json(["code" => 201,"msg" =>"❌ 解压失败"]);
        }
    }
    public function index(){
        echo "成功 ✌ ";
    }
    #[Route('GET','/ccc')]
    function ccc(){
        $tables = Db::query("SHOW TABLES");

        return json([
            'tables' => array_map(fn($t) => array_values($t)[0], $tables)
        ]);
    }

}
