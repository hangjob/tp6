<?php
/**
 * vipbic3.0
 * User: 杨航
 * Date: 2020/11/23-0:13
 * Email: <470193837@qq.com>
 */


namespace app\api\lib;


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
    private function jsonResponse($code, $message, $data, $httpCode = 200){

        $result = [
            'code' => $code, // 业务状态码
            'message' => $message,
            'result' => $data
        ];

        return json($result, $httpCode);
    }
}