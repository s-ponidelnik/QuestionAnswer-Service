<?php

namespace frontend\controllers;

use common\models\AnswerVote;
use Yii;
use common\models\Answer;
use common\models\AnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * AnswerController implements the CRUD actions for Answer model.
 */
class AnswerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    $this->redirect(Url::to(['site/login']));
                },
                'only' => ['create', 'vote'],
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Answer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnswerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Vote method
     * @return string
     */
    public function actionVote()
    {
        if (Yii::$app->user->isGuest)
            return json_encode(['code' => 400, 'text' => 'Not authorized']);

        $position = Yii::$app->request->get('position', null);
        $answer_id = Yii::$app->request->get('answer_id', null);


        if (is_null($position) || is_null($answer_id))
            return json_encode(['code' => 400, 'text' => 'Not enough parameters']);


        $selfVoteCheck = boolval(AnswerSearch::find()->where(['author_id' => Yii::$app->user->id, 'answer_id' => $answer_id])->count());

        if ($selfVoteCheck) {//Нельзая голосовать за собственный ответ
            return json_encode(['code' => 400, 'text' => 'Can"t vote for own answer']);
        }

        //Пользователь уже голосовол за этот ответ
        $alreadyVote = AnswerVote::find()->where(['author_id' => Yii::$app->user->id, 'answer_id' => $answer_id])->one();

        if (is_object($alreadyVote)) {//Уже голосовал, отмена голоса за данный ответ
            if ($alreadyVote->position == $position) {
                if (!AnswerVote::deleteAll(['author_id' => Yii::$app->user->id, 'answer_id' => $answer_id])) {
                    return json_encode(['code' => 400, 'text' => 'Error']);
                } else {
                    return json_encode(['code' => 200, 'text' => 'OK', 'position' => 0]);
                }
            } else {//Изменил мнение по данному ответу
                $alreadyVote->position = $position;
                if (!$alreadyVote->save()) {
                    return json_encode(['code' => 400, 'text' => 'Error']);
                } else {
                    return json_encode(['code' => 200, 'text' => 'OK', 'position' => 1]);
                }
            }
        } else {//Впервый голосует за данный ответ
            $vote = new AnswerVote();
            $vote->answer_id = $answer_id;
            $vote->author_id = Yii::$app->user->id;
            $vote->position = $position;
            if (!$vote->save()) {
                return json_encode(['code' => 400, 'text' => 'Error']);
            } else {
                return json_encode(['code' => 200, 'text' => 'OK', 'position' => 2]);
            }
        }


    }

    /**
     * Creates a new Answer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Answer();
        $model->author_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question/view', 'id' => $model->question_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Answer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Answer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
