<?php
declare (strict_types = 1);

namespace app\middleware;


class Auth
{
    /**
     * 处理请求
     * 验证用户的合法性
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        echo '权限中间件';
        return $next($request);
    }
}
