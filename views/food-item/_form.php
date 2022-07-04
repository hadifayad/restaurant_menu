<?php

use app\models\FoodCategory;
use app\models\FoodItem;
use kartik\widgets\FileInput;
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

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
//    echo $form->field($model, 'restaurant_id')->textInput() 
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php
     $form->field($model, 'file')->widget(FileInput::classname(), [
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
    <div class = "form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])
        ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
