<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/23-0:13
 * Email: <470193837@qq.com>
 */


namespace app\api\lib;


use think\facade\Request;

class ResponseJson
{
    /**
     * @param null $data
     * @param int $httpCode
     * @return \think\response\Json
     */
    public function success($data = null, $httpCode = 200){

        $code = 1;
        $message = 'success';
        return $this->jsonResponse($code, $message, $data, $httpCode);
    }

    /**
     * @param $code
     * @param $message
     * @param null $data
     * @param int $httpCode
     * @return \think\response\Json
     */
    public function error($code, $message, $data = null, $httpCode = 500){

        return $this->jsonResponse($code, $message, $data, $httpCode);
    }

    /**
     * @param $code
     * @param $message
     * @param $data
     * @param int $httpCode
     * @return \think\response\Json
     */
    public function jsonResponse($code = 1, $message = '请求成功', $data, $httpCode = 200){

        $result = [
            'code' => $code, // 业务状态码
            'message' => $message,
            'data' => $data,
            'url' => Request::url(true)
        ];
        return json($result, $httpCode);
    }
}