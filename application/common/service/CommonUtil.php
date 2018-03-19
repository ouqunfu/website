<?php

namespace app\common\service;

/**
 * 公共方法
 */

class CommonUtil
{
    /**
     * 用户密码生产器
     * @param $value
     * @param $salt
     * @return string
     */
    public static function generatePwd($value, $salt)
    {
        return substr(md5($value), 1, 5) . md5($salt);
    }

    /**
     * login_salt 生成
     * @param int $length
     * @return string
     */
    public static function generateSalt($length = 17)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $salt = '';
        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $salt .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $salt;
    }

    /**
     * 获取客户端IP地址
     * @return array|false|string
     */
    public static function getClientIP()
    {
        global $_SERVER;
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * 二维关联数组排序
     * @param array $arr 排序二维关联数组
     * @param string $field 排序字段
     * @param string $sort 排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
     * @return array
     */
    public static function assocArraySort(array $arr = [], $field = '', $sort = 'SORT_DESC')
    {
        $sort = array(
            'direction' => $sort, //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field' => $field,       //排序字段
        );
        $arrSort = array();
        foreach ($arr AS $uniqid => $row) {
            foreach ($row AS $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if ($sort['direction']) {
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arr);
        }

        return $arr;
    }

    /**
     * format number
     * @param int $data
     * @param int $decimals
     * @return int|string
     */
    public static function numberFormat($data = 0, $decimals = 3)
    {
        if (0 == $data) {
            return $data;
        }

        $data = number_format($data, $decimals, '.', '');

        return $data;
    }

    /**
     * 计算两个日期之間的所有月份
     * @param string $date1 [格式如：2011-11-5]
     * @param string $date2 [格式如：2012-12-01]
     * @return array
     */
    public static function diffMoth($date1, $date2)
    {
        $time1 = strtotime($date1); // 自动为00:00:00 时分秒
        $time2 = strtotime($date2);
        $monthArr[] = date('Ym', $time1);
        while (($time1 = strtotime('+1 month', $time1)) <= $time2) {
            $monthArr[] = date('Ym', $time1); // 取得递增月;
        }
        return $monthArr;
    }

    /**
     * 生成csv文件
     * @param array $csvBody
     * @param string $fileName
     * @return bool|string
     */
    public static function toCSV(array $csvBody = [], $fileName = '')
    {
        $fileName = $fileName ? $fileName : date('YmdH000000');
        // 打开文件资源，不存在则创建
        $fp = fopen($fileName, 'w');
        if ($csvBody) {
            foreach ($csvBody as $line) {
                fputcsv($fp, $line);
            }
        }
        fclose($fp);
        return 1;
    }

    /**
     * 获取最新group的生成的csv的日期
     * 作为定时任务的查询条件
     * get group data time
     * @param string $dir
     * @return false|mixed|string
     */
    public static function getFileName($dir = '')
    {
//        $dir = RUNTIME_PATH . 'stats_group_csv_file/';
        // Open a known directory, and proceed to read its contents
        $fileNames = [];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file && $file != "." && $file != "..") {
                        $fileNames[] = $file;
                    }
                }
                closedir($dh);
            }
        }
        if ($fileNames) {
            $fileNames = array_map(
                function ($file) {
                    $arr = explode('.', $file);
                    $date = substr($arr[0], -14, 14);
                    return $date;
                },
                $fileNames
            );
        }
        $date = $fileNames ? max($fileNames) : date('YmdH0000', strtotime("now -1 hour"));
        return $date;
    }

    /**
     * 返回real status
     * @param $value
     * @return mixed|string
     */
    public static function switchRealStatus($value)
    {
        $arrayStatus = [Constants::STATUS_PAUSED => -2, Constants::STATUS_ACTIVE => -1, Constants::STATUS_PENDING => 1];
        $res = '';
        if (is_numeric($value)) {
            $res = array_search($value, $arrayStatus);
        }
        if (is_string($value)) {
            $res = isset($arrayStatus[$value]) ? $arrayStatus[$value] : '';
        }
        return $res;
    }
}

