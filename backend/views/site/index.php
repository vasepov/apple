<?php

/* @var $this yii\web\View */

use common\models\Color;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'админочка';
?>
<div class="row">
    <div class="col-lg-6">
        <h2>Цвета яблок</h2>
        <?= Html::button('Добавить', ['class' => 'add-color btn btn-success'])?>
        <br><br>
        <?php $form = ActiveForm::begin(['id' => 'color-form', 'action' => '/site/save-colors']); ?>
        <table class="table table-bordered table-color">
            <tr>
                <th>id</th>
                <th>Цвет</th>
                <th></th>
            </tr>
            <?php $key = 1; ?>
            <?php foreach (Color::findAll(['deleted' => 0]) as $color) : ?>
                <tr>
                    <td><?= $color->id; ?></td>
                    <td>
                        <?= $form->field($color, '[' . $key . ']id')->hiddenInput()->label(false); ?>
                        <?= $form->field($color, '[' . $key . ']color')->textInput()->label(false); ?>
                        </td>
                    <td><?= Html::button('-', ['class' => 'btn btn-danger delete-color', 'data-id' => $color->id]);?></td>
                </tr>
                <?php $key++; ?>
            <?php endforeach; ?>
        </table>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
