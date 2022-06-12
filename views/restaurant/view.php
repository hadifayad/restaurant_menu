<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Restaurants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'name_ar',
            'description:ntext',
            'description_ar:ntext',
            'open_time',
            'close_time',
            'address:ntext',
            'address_ar:ntext',
            'phone1',
            'phone2',
            'phone3',
            'about_us:ntext',
            'about_us_ar:ntext',
            'facebook:ntext',
            'instagram:ntext',
            'location:ntext',
            [
                'attribute' => 'icon',
                'format' => "raw",
                'value' => function($model) {
                    $iconPath = Yii::getAlias('@web/restaurantsUploads/') . $model->icon;
                    return "<img  height='100' src='$iconPath'/>";
                }
            ]
        ],
    ])
    ?>

</div>
