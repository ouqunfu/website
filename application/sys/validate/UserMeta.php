<?php

namespace app\sys\validate;

use think\Validate;

/**
 * @author: qunfu
 * @date: 2018/3/20
 * @description:
 */
class UserMeta extends Validate
{
    protected $rule = [
        'safe_question' => 'require',
        'answer' => 'require',
        'ID' => 'require|number'
    ];

    protected $message = [
        'safe_question.require' => 'Param safe question can not be empty!',
        'answer.require' => 'Param safe question answer can not be empty!',
        'ID.number' => 'Param userId only numbers!'
    ];

    //validate scene
    protected $scene = [
        'create' => ['safe_question', 'answer'],
        'edit' => ['safe_question', 'answer', 'ID']
    ];
}