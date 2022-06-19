<?php

use app\models\FoodCategory;
use app\models\FoodItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model FoodItem */
/* @var $form ActiveForm */
?>

<div class="food-item-form">

    <?php $form = ActiveForm::begin(); ?>


    <?=
    $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map(FoodCategory::getFoodItemsByUser(), "id", "name"), ['prompt' => '']
    );
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_ar')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php
//    echo $form->field($model, 'restaurant_id')->textInput() 
    ?>

    <?= $form->field($model, 'price_lb')->textInput() ?>

    <?= $form->field($model, 'price_usd')->textInput() ?>

    <?= $form->field($model, 'price_unit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
