<?php

namespace common\models\services;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * Class UserService
 * @package common\models\services
 */
class UserService extends Component
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public static function getUserList()
    {
        $films = User::find()->asArray()->all();
        $list = ArrayHelper::map($films, 'id', 'username');
        krsort($list);

        return $list;
    }

}