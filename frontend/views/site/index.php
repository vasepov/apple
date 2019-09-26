<?php
/**
 * @var yii\web\View $this
 * @var common\models\Apple $model
 */

$this->title = 'мой сад';

use yii\helpers\Html;

?>
<?= Html::a('Добавить до 10 яблок', ['add-apples'], ['class' => 'btn']) ?>
<?= Html::a('Потрести дерево', ['apple-on-earth'], ['class' => 'btn']) ?>
<div class="row">
    <div class="col-lg-3">
        <?= $this->render('_onTree') ?>
    </div>
    <div class="col-lg-5">
        <?= $this->render('_underfoot') ?>
    </div>
    <div class="col-lg-4">
        <?= $this->render('_rottenApple') ?>
    </div>
</div>
