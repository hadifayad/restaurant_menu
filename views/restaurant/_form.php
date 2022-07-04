<?php

use app\models\Restaurant;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Restaurant */
/* @var $form ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'open_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'close_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about_us')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'facebook')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'instagram')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'direction')->dropDownList(["rtl" => 'عربي', "ltr" => 'english',])->label("layout direction") ?>
      <?= $form->field($model, 'currency')->dropDownList(["L.L" => 'ليرة لبنانية', "$" => 'USD',])->label("Currency") ?>

    <?php
    echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => false
        ],
        'pluginOptions' => [
//            'previewFileType' => 'image',
            'overwriteInitial' => false,
            'maxFileSize' => 1000000,
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
