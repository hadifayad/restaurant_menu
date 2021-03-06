<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FoodItem */

$this->title = Yii::t('app', 'Create Food Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Food Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
