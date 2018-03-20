<?php

namespace app\sys\service;

use app\common\service\BaseService;
use app\sys\model\Usermeta;

/**
 * @author: qunfu
 * @date: 2018/3/20
 * @description:
 */
class UserMetaService extends BaseService
{
    /**
     * create user meta
     * @param array $info
     * @return bool|int|string
     */
    public function create(array $info = [])
    {
        if (empty($info)) {
            return false;
        }
        $userMetaModel = new Usermeta();
        $res = $userMetaModel->addInfo($info);
        return $res;
    }

    /**
     * update user meta info
     * @param array $map
     * @param array $data
     * @return bool|int|string
     */
    public function update(array $map = [], array $data = [])
    {
        if (empty($data) || !is_array($data) || empty($map)) {
            return false;
        }
        $userMetaModel = new Usermeta();
        $res = $userMetaModel->updateInfo($map, $data);
        if ($res || (0 == $res)) {
            return true;
        }
        return $res;
    }

    /**
     * batch insert user meta data
     * @param array $list
     * @return bool|int|string
     */
    public function insertAll(array $list = [])
    {
        if (empty($list)) {
            return false;
        }
        $userMetaModel = new Usermeta();
        $res = $userMetaModel->addAll($list);
        return $res;
    }

    /**
     * use primary key batch update user meta data
     * @param array $data
     * @return array|bool|false
     */
    public function updateAll(array $data = [])
    {
        if (empty($data)) {
            return false;
        }
        $userMetaModel = new Usermeta();
        $res = $userMetaModel->updateAll($data);
        return $res;
    }

    /**
     * add user meta data
     * @param array $data
     * @param int $userId
     * @return bool
     */
    public function addUserMetaData(array $data = [], $userId = 0)
    {
        if (empty($data) || !is_numeric($userId) || $userId < 0) return false;
        $i = 0;
        $metaData = [];
        foreach ($data as $key => $datum) {
            $metaData[$i]['user_id'] = $userId;
            $metaData[$i]['meta_key'] = $key;
            $metaData[$i]['meta_value'] = $datum;
            $i++;
        }
        $res = $this->insertAll($metaData);
        return $res;
    }

    public function updateUserMetaData(array $data = [], $userId = 0)
    {
        if (empty($data) || !is_numeric($userId) || $userId < 0) return false;
        
    }
}