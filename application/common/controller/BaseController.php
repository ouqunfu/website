<?php

namespace app\common\controller;

use app\common\service\BaseService;
use app\common\service\CommonUtil;
use app\common\service\Log;
use think\Controller;
use app\common\service\Constants;
use think\exception\HttpResponseException;
use think\Request;
use think\Session;
use think\Response;

/**
 * @author: qunfu
 * @date: 2017/6/14
 * @description:
 */
class BaseController extends Controller
{
    protected $beforeActionList = [
        'loginFilter' => ['except' => 'login'],
        'accessControl' => ['except' => 'login,logout'],
        'logFilter' => ['except' => 'login']
    ];

    /**
     * 登陆验证
     */
    protected function loginFilter()
    {
        if (!Session::get('user')) {
            return $this->_res(Constants::ERROR_LOGIN, 'Not logged in!');
        }
    }

    /**
     * 日志记录
     */
    protected function logFilter()
    {
        if (!($this->request->isGet())) {
            $user = Session::get('user');
            $log = [
                'log_type' => $this->request->module() . '/' . $this->request->controller(),
                'request_method' => $this->request->method(),
                'action_function' => $this->request->action(),
                'action_param' => json_encode($this->request->param()),
                'user_id' => $user['ID'],
                'user_name' => $user['user_login'],
                'create_time' => time(),
                'action_device' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
                'action_ip' => CommonUtil::getClientIP()
            ];
            Log::create($log);
        }
    }

    /**
     * 访问权限控制
     */
    protected function accessControl()
    {
        $user = Session::get('user');
        //super administrators role
        if (1 == intval($user['role_id'])) {
            return;
        }
        $function = [
            'module' => $this->request->module(),
            'controller' => $this->request->controller(),
            'action' => $this->request->action(),
            'status' => 'active'
        ];
        $baseService = new BaseService();
        $res = $baseService->accessControl($function);
        if (!$res) {
            return $this->_res(Constants::ERROR_ACCESS, 'Permission denied!');
        }
        return;
    }

    /**
     * 参数非空验证
     * @param array $notEmptyParams 值不得为空的参数
     * @param string $method 请求方式
     * @param array $requiredParams 需要传递的参数
     * @return array
     */
    protected function _validateParams($notEmptyParams, $method = Constants::HTTP_GET, $requiredParams = [])
    {
        $params = [];
        foreach ($notEmptyParams as $notEmptyParam) {
            if (empty(input("{$method}.{$notEmptyParam}"))) {
                return $this->_res(Constants::ERROR_PARAMS, "Param {$notEmptyParam} can not be empty!");
            }
            $params[] = input("{$method}.$notEmptyParam", '', 'trim,strip_tags');
        }
        foreach ($requiredParams as $requiredParam) {
            if (input("{$method}.{$requiredParam}") === null) {
                return $this->_res(Constants::ERROR_PARAMS, "Param {$requiredParam} must passed!");
            }
            $params[] = input("{$method}.$requiredParam", '', 'trim,strip_tags');
        }
        return $params;
    }

    /**
     * 参数接收
     * @param array $inputParams
     * @param string $method
     * @return array
     */
    protected function _receiveParams(array $inputParams = [], $method = Constants::HTTP_GET)
    {
        $params = [];
        $values = input("{$method}.");
        foreach ($inputParams as $param) {
            if (!isset($values[$param])) {
                $values[$param] = '';
            }
            $params[] = $values[$param];
        }
        return $params;
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
        header("Access-Control-Allow-Origin: *");
        $data = ['code' => $code, 'message' => $message, 'data' => $data, 'page_count' => $pageCount, 'count' => $count, 'added_data' => $addedData];
        throw new HttpResponseException(Response::create(json_encode($data, JSON_UNESCAPED_UNICODE), '', 200));
    }

    /**
     * IO file upload
     * @return array
     */
    protected function _upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['size' => Constants::MAX_UPLOAD_FILE_SIZE, 'ext' => Constants::UPLOAD_FILE_EXT])->move(ROOT_PATH . 'frontend/dist/public' . DS . 'uploads');
        if ($info) {
            // 成功上传后 获取上传信息
            $data['filePath'] = 'http://' . $_SERVER['HTTP_HOST'] . '/public/uploads/' . $info->getSaveName();
            return $this->_res(Constants::ERROR_OK, 'File upload successfully!', $data);
        } else {
            // 上传失败获取错误信息
            return $this->_res(Constants::ERROR_SERVER, $file->getError());
        }
    }

    /**
     * file upload
     * @param int $fileSize
     * @param string $fileExt
     * @param string $filePath
     * @return array
     */
    protected function _uploadFile($fileSize = Constants::MAX_UPLOAD_FILE_SIZE, $fileExt = Constants::UPLOAD_FILE_EXT, $filePath = '/public/uploads/')
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        $rule = [];
        if (intval($fileSize) > 0) {
            $rule['size'] = intval($fileSize);
        }
        if (!empty($fileExt)) {
            $rule['ext'] = $fileExt;
        }
        $filePath = $filePath ? $filePath : '/public/uploads/';
        $info = $file->validate($rule)->move(ROOT_PATH . 'frontend/dist' . $filePath);
        if ($info) {
            // 成功上传后 获取上传信息
            $data['filePath'] = 'http://' . $_SERVER['HTTP_HOST'] . $filePath . $info->getSaveName();
            return $this->_res(Constants::ERROR_OK, 'File upload successfully!', $data);
        } else {
            // 上传失败获取错误信息
            return $this->_res(Constants::ERROR_SERVER, $file->getError());
        }
    }
}