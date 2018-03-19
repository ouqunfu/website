<?php

namespace app\common\service;

use think\exception\HttpResponseException;
use think\Session;
use think\Response;

/**
 * @author: qunfu
 * @date: 2017/6/14
 * @description:
 */
class BaseService
{
    /**
     * 访问权限验证
     * @param array $function
     * @return bool
     */
    public function accessControl(array $function = [])
    {
        if ($function) {

            $res = db('functions', [], false)->field('function_id')->where($function)->find();
            $user = Session::get('user');
            $roleCondition = [
                'status' => 'active',
                'role_id' => $user['role_id']
            ];
            $role = db('role', [], false)->field('role_rule')->where($roleCondition)->find();
            $roleIds = explode(',', $role['role_rule']);
            if ($res && $roleIds && in_array($res['function_id'], $roleIds)) {
                return true;
            }
        }

        return false;
    }

    /**
     * api数据返回
     * @param int $code 返回码，0表示成功，非0表示各种不同的错误
     * @param string $message 描述信息
     * @param array $data 返回的数据
     * @param int $pageCount 总页数
     * @param int $count 总记录数
     * @param array $addedData
     * @return array
     */
    protected function _res($code = 0, $message = '', $data = [], $pageCount = 0, $count = 0, array $addedData = [])
    {
        $data = ['code' => $code, 'message' => $message, 'data' => $data, 'page_count' => $pageCount, 'count' => $count, 'added_data' => $addedData];
        throw new HttpResponseException(Response::create(json_encode($data, JSON_UNESCAPED_UNICODE), '', 200));

    }
}