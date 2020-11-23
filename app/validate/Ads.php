<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class Ads extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'adURL' => 'require|max:25|min:3|checkAdURL',
        'adName' => 'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'adURL.require' => 'adURL必须',
        'adURL.max'     => 'adURL最多不能超过25个字符',
        'adURL.min'     => 'adURL最少不能小于过3个字符'
    ];


    protected function checkAdURL($value, $rule, $data, $field, $title){
        return $value != '123456' ? true : '不能为123456';
    }
}
