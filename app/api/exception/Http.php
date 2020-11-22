<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/22-23:41
 * Email: <470193837@qq.com>
 */


namespace app\api\exception;

use app\api\lib\ResponseJson;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

class Http extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render($request, Throwable $e): Response
    {
        $status = $e->getCode();

        // 参数验证错误
        if ($e instanceof ValidateException) {
//            return json($e->getError(), 422);
            return (new ResponseJson)->error($status,$e->getError(),null,422);
        }

        // 请求异常
        if ($e instanceof HttpException && $request->isAjax()) {
            return (new ResponseJson)->error($status,$e->getMessage(),null,$e->getStatusCode());
        }


        if(env('app_debug')){
            // 其他错误交给系统处理
            return parent::render($request, $e);
        }else{
            return (new ResponseJson)->error($status,$e->getMessage(),null);
        }

    }
}