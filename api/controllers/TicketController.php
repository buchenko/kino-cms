<?php

namespace api\controllers;

use common\models\search\TicketSearch;
use common\models\services\TicketService;
use common\models\Ticket;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class TicketController
 * @package api\controllers
 */
class TicketController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'common\models\Ticket';

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::class,
            HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['create', 'update', 'delete'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    /**
     * @api {POST} /ticket Бронирование билета
     * @apiHeader {String} authorization Bearer or Basic user token
     * @apiHeaderExample {json} Request-Example:
    { "Authorization": "Bearer FWZf3OtFy-YR7rcFUC7WzRlM3o7eoGd5" }
     * @apiName reserve
     * @apiGroup Билеты
     * @apiParam {Object} ticket
     * @apiParam {Number} ticket.showtime_id showtime id
     * @apiParam {Number} ticket.seat_id seat id
     * @apiParam {Number} ticket.user_id user id
     * @apiSuccess {Object} result
     * @apiSuccess {Number} result.id ticket id
     * @apiSuccess {Boolean} result.paid ticket paid status
     * @apiError {Object[]} errors
     * @apiError {String} errors.field field name on error
     * @apiError {String} errors.message error message
     *
     * @return \common\models\Ticket
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\ServerErrorHttpException
     */
    public function actionCreate()
    {
        $model = new Ticket();
        $model->user_id = Yii::$app->user->id;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->validate() && $model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }

    /**
     * @api {PUT, PATH} /ticket/:id Оплата билета
     * @apiHeader {String} authorization Bearer or Basic user token
     * @apiHeaderExample {json} Request-Example:
    { "Authorization": "Bearer FWZf3OtFy-YR7rcFUC7WzRlM3o7eoGd5" }
     * @apiName pay
     * @apiGroup Билеты
     * @apiSuccess {Object} result
     * @apiSuccess {Number} result.id ticket id
     * @apiSuccess {Boolean} result.paid ticket paid status
     * @apiError {Object[]} errors
     * @apiError {String} errors.field field name on error
     * @apiError {String} errors.message error message
     *
     * @param $id
     *
     * @return \common\models\Ticket
     * @throws \yii\web\ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\web\ServerErrorHttpException
     */
    public function actionUpdate($id)
    {
        /* @var $model Ticket */
        $model = $this->findModel($id);
        $this->checkAccess('update', $model);

        $model->scenario = Model::SCENARIO_DEFAULT;
        $ticketService = new TicketService($model);
        if ($model->paid = $ticketService->pay()) {
            if ($model->save(false, ['paid']) === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            }
        } else {
            $model->addError('paid', 'Failed payment');
        }

        return $model;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new TicketSearch();

        return $searchModel->search(Yii::$app->request->queryParams);
    }

    /**
     * @param $id
     *
     * @return \common\models\Ticket|null
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param string $action
     * @param null|Ticket $model
     * @param array $params
     *
     * @throws \yii\web\ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete'])) {
            if (empty($model) || $model->user_id != Yii::$app->user->id || $model->paid) {
                throw  new ForbiddenHttpException('Forbidden.');
            }
        }
    }
}