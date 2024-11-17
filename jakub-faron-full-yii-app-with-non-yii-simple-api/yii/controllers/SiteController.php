<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Komis;
use app\models\Samochod;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
        public function actionCreateKomis()
    {
        $model = new Komis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Komis został dodany.');
            return $this->redirect(['komisy']);
        }

        return $this->render('create-komis', [
            'model' => $model,
        ]);
    }

    public function actionDeleteKomis($id)
    {
        $model = Komis::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Komis został usunięty.');
        } else {
            Yii::$app->session->setFlash('error', 'Komis nie został znaleziony.');
        }

        return $this->redirect(['komisy']);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
{
    if (!Yii::$app->user->isGuest) {
        return $this->redirect(['komisy']);  // Przekieruj zalogowanych użytkowników
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->redirect(['komisy']);  // Przekieruj po pomyślnym zalogowaniu
    }

    return $this->render('login', [
        'model' => $model,
    ]);
}

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionKomisy()
{
    $komisy = Komis::find()->all();  // Pobiera wszystkie komisy
    return $this->render('komisy', ['komisy' => $komisy]);
}

public function actionCreateSamochod($komis_id)
{
    $model = new Samochod();
    $model->komis_id = $komis_id;  // Ustaw domyślnie komis_id

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Samochód został dodany.');
        return $this->redirect(['komisy']);
    }

    return $this->render('create-samochod', [
        'model' => $model,
    ]);
}

public function actionViewKomis($id)
{
    $komis = Komis::findOne($id);
    if (!$komis) {
        throw new NotFoundHttpException("Komis not found");
    }

    return $this->render('view-komis', [
        'komis' => $komis,
    ]);
}
public function actionUpdateKomis($id)
{
    $model = Komis::findOne($id);
    if (!$model) {
        throw new NotFoundHttpException("Komis not found");
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Dane komisu zostały zaktualizowane.');
        return $this->redirect(['view-komis', 'id' => $model->id]);
    }

    return $this->render('update-komis', [
        'model' => $model,
    ]);
}
public function actionDeleteSamochod($id)
{
    $samochod = Samochod::findOne($id);
    if ($samochod) {
        $samochod->delete();
        Yii::$app->session->setFlash('success', 'Samochód został usunięty.');
    } else {
        Yii::$app->session->setFlash('error', 'Nie znaleziono samochodu.');
    }

    return $this->redirect(['view-komis', 'id' => $samochod->komis_id]);
}



}
