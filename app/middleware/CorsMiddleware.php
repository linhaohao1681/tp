<?php
declare (strict_types = 1);

namespace app\middleware;

class CorsMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
          // 允许所有来源访问（可以根据需求调整）
          header("Access-Control-Allow-Origin: *");

          // 允许的 HTTP 方法
          header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  
          // 允许的请求头
          header("Access-Control-Allow-Headers: Content-Type, Authorization");
          header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // 允许的HTTP方法
  
          // 如果是预检请求（OPTIONS），直接返回 200
          if ($request->method() == 'OPTIONS') {
              return response('', 200);
          }
          return $next($request);

    
    }


}
