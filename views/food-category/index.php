<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FoodCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Food Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Food Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            [
                'attribute' => 'image',
                'format' => "raw",
                'value' => function($model) {
                    $iconPath = Yii::getAlias('@web/categoriesUploads/') . $model->image;
                    return "<img  height='40' src='$iconPath'/>";
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
