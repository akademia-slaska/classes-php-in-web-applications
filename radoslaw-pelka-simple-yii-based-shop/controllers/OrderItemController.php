<?php
namespace app\controllers;

use app\models\OrderItem;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Orders;
use yii\web\NotFoundHttpException;

class OrderItemController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetProductPrice($id)
    {
        $product = Product::findOne($id);

        if ($product !== null) {
            return json_encode(['price' => $product->price]);
        }

        return json_encode(['price' => 0]);
    }

    public function actionCreate()
    {
        $model = new OrderItem();

        $products = Product::find()->all();
        $productList = ArrayHelper::map($products, 'id', 'name');

        $orders = Orders::find()->all();
        $orderList = ArrayHelper::map($orders, 'id', function($model) {
            return 'Order #' . $model->id . ' (' . $model->created_at . ')';
        });

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'productList' => $productList,
            'orderList' => $orderList,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = OrderItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
