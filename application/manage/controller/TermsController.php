<?php

namespace app\manage\controller;

use app\common\controller\BaseController;
use app\common\service\Constants;
use app\manage\service\TermmetaService;
use app\manage\service\TermsService;
use app\manage\service\TermTaxonomyService;

/**
 * @author: qunfu
 * @date: 2018/3/21
 * @description:
 */
class TermsController extends BaseController
{
    /**
     * get list
     * @return array
     */
    public function lists()
    {
        list($page) = $this->_receiveParams(['page'], Constants::HTTP_GET);
        $termsService = new TermsService();
        $res = $termsService->getList($page);
        return $this->_res(Constants::ERROR_OK, 'Terms list!', $res['list'], $res['page_count'], $res['count']);
    }

    /**
     * create and update post data
     * @return mixed
     */
    public function inputParams()
    {
        $inputParams = ['name', 'slug', 'meta_is_show_nav', 'meta_title', 'meta_keywords', 'meta_description', 'meta_is_show'];
        $requiredParams = ['meta_ext_link', 'meta_cover_content', 'meta_img', 'meta_privilege', 'parent'];
        list($data['name'],
            $data['slug'],
            $data['meta_is_show_nav'],
            $data['meta_title'],
            $data['meta_keywords'],
            $data['meta_description'],
            $data['meta_is_show'],
            $data['meta_ext_link'],
            $data['meta_cover_content'],
            $data['meta_img'],
            $data['meta_privilege'],
            $data['parent']) = $this->_validateParams($inputParams, Constants::HTTP_POST, $requiredParams);
        $data['meta_privilege'] = json_decode($data['meta_privilege'], true);
        //数据验证

        $splitData['terms_data'] = ['name' => $data['name'], 'slug' => $data['slug']];
        $splitData['term_meta_data'] = [
            ['meta_key' => 'category_is_nav', 'meta_value' => $data['meta_is_show_nav']],
            ['meta_key' => 'category_meta_title', 'meta_value' => $data['meta_title']],
            ['meta_key' => 'category_meta_keywords', 'meta_value' => $data['meta_keywords']],
            ['meta_key' => 'category_meta_description', 'meta_value' => $data['meta_description']],
            ['meta_key' => 'category_meta_is_show', 'meta_value' => $data['meta_is_show']],
            ['meta_key' => 'category_meta_ext_link', 'meta_value' => $data['meta_ext_link']],
            ['meta_key' => 'category_meta_cover_content', 'meta_value' => $data['meta_cover_content']],
            ['meta_key' => 'category_meta_img', 'meta_value' => $data['meta_img']],
//            ['meta_key' => 'category_meta_privilege', 'meta_value' => $data['meta_privilege']],
        ];
        $splitData['term_taxonomy_data'] = ['taxonomy' => 'category', 'parent' => $data['parent']];
        return $splitData;
    }


    public function create()
    {
        $data = $this->inputParams();
        //terms data
        $termsService = new TermsService();
        $termsRes = $termsService->create($data['terms_data']);
        //terms meta data
        if (!$termsRes) {
            return $this->_res(Constants::ERROR_SERVER, 'Create terms data failed!');
        }
        foreach ($data['term_meta_data'] as $key => $item) {
            $data['term_meta_data'][$key]['term_id'] = $termsRes;
        }
        $termMetaService = new TermmetaService();
        $termsMetaRes = $termMetaService->insertAll($data['term_meta_data']);
        if (!$termsMetaRes) {
            return $this->_res(Constants::ERROR_SERVER, 'Create terms meta data failed!');
        }
        //term taxonomy data
        $data['term_taxonomy_data']['term_id'] = $termsRes;
        $termTaxService = new TermTaxonomyService();
        $termTaxRes = $termTaxService->create($data['term_taxonomy_data']);
        if (!$termTaxRes) {
            return $this->_res(Constants::ERROR_SERVER, 'Create terms taxonomy data failed!');
        }
        return $this->_res(Constants::ERROR_OK, 'Create terms data successfully!');
    }

    /**
     * change term's sort
     * @return array
     */
    public function sort()
    {
        list($input['sort_data']) = $this->_validateParams(['sort_data'], Constants::HTTP_GET);
        $sortData = json_decode($input['sort_data'], true);
        $map['meta_key'] = 'category_sort';
        $map['term_id'] = ['in', array_keys($sortData)];
        $termMetaService = new TermmetaService();
        $termMeta = $termMetaService->getListAll($map);
        $data = [];
        foreach ($termMeta as $key => $item) {
            $data[$key]['meta_id'] = $item['meta_id'];
            $data[$key]['meta_value'] = $sortData[$item['term_id']];
        }
        $res = $termMetaService->updateAll($data);
        if ($res) return $this->_res(Constants::ERROR_OK, 'Update terms sort successfully!');
        return $this->_res(Constants::ERROR_SERVER, 'Update terms sort failed!');
    }

    public function changeParent()
    {

    }
}