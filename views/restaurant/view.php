<?php

use app\models\Restaurant;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $model Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Restaurants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

Pjax::begin(['id' => 'pjax-id']);
?>
<div class="restaurant-view">

    <!--<h1>-->
    <?php
//        echo Html::encode($this->title)
    ?>
    <!--</h1>-->

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
//        echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]);
        ?>
    </p>
    <div class="panel panel-default">
        <div class="panel panel-body">

            <div class="col-lg-12">
                <div class="col-lg-4">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
//                            'id',
                            'name',
                            'name_ar',
                            'description:ntext',
                            'description_ar:ntext',
                            'open_time',
                            'close_time',
                        ],
                    ])
                    ?>
                </div>
                <div class="col-lg-4">

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'address:ntext',
                            'address_ar:ntext',
                            'phone1',
                            'phone2',
                            'phone3',
                            'about_us:ntext',
                        ],
                    ])
                    ?>
                </div>

                <div class="col-lg-4">

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
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
                            ]],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel panel-heading">
            <label>
                Images
            </label>
            <?= Html::a(Yii::t('app', 'Add Images'), ['restaurant/add-images', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
        </div>
        <div class="panel panel-body">

            <div class="col-lg-12">
                <?php
                for ($i = 0; $i < sizeof($restaurantPictures); $i++) {
//            \yii\helpers\VarDumper::dump($newsMedia, 3, true);
                    ?>
                    <div class="col-lg-2">
                        <img  
                            width="100px"
                            path="<?= Yii::getAlias('@webroot/restaurantsUploads/') . $restaurantPictures[$i]["image"] ?>"
                            src="<?= Yii::getAlias('@web/restaurantsUploads/') . $restaurantPictures[$i]["image"] ?>">   
                        <button class="delete-btn" 
                                imageName="<?= $restaurantPictures[$i]["image"] ?>"
                                restaurantId="<?= $restaurantPictures[$i]["id"] ?>"
                                style="top: 0px;
                                right: 60px;background-color: Transparent;border: none;
                                position: absolute;color: red;font-weight: bold;" >x</button>
                    </div>

                    <?php
                }
                ?>
            </div>

        </div>
    </div>

</div>

<?php
//VarDumper::dump($appointments, 3, true);


JSRegister::begin([
    'id' => '1',
    'position' => static::POS_END
]);
?>

<script>

    $(".delete-btn").click(function () {

        var restaurantId = $(this).attr("restaurantId");
        var imageName = $(this).attr("imageName");

        var result = confirm("هل أنت متأكد؟");
        if (result) {
            $.ajax({
                url: '<?php echo Url::toRoute("/restaurant/delete-file") ?>',
                type: "POST",
                data: {
                    'restaurantId': restaurantId,
                    'imageName': imageName,
                },
                success: function (data) {
                    console.log(data);
                    if (data["success"] == true) {
                        $.pjax.reload({container: '#pjax-id', async: false, timeout: 2e3});

                    } else {
                    }
                },
                error: function (errormessage) {
                    console.log("not working");
                }
            });
        }





    });


</script>
<?php
JSRegister::end();
Pjax::end();
?>
