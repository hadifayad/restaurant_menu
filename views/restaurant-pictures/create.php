<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RestaurantPictures */

$this->title = Yii::t('app', 'Create Restaurant Pictures');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Restaurant Pictures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-pictures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
