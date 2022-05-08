<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FoodCategory */

$this->title = Yii::t('app', 'Create Food Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Food Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
