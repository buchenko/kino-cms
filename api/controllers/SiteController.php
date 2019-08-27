<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use api\models\LoginForm;

/**
 * Class SiteController
 * @package api\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return 'api';
    }

    /**
     * @api {POST} /auth Авторизация пользователя для получения токена доступа
     * @apiName auth
     * @apiGroup Авторизация
     * @apiParam {String} username user name
     * @apiParam {String} password user password
     * @apiSuccess {Object} result
     * @apiSuccess {String} result.token user token
     * @apiSuccess {String} result.expired datetime token expired
     *
     * @return \api\models\LoginForm|\common\models\Token|null
     * @throws \yii\base\Exception
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }
    }

    /**
     * @return array
     */
    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}
