<?php

use common\models\Apple;
use common\models\State;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<h3>Яблоки на земле</h3>
<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => Apple::find()->with(['state', 'color'])->where(['state_id' => State::UNDERFOOT]),
    ]),
    'summary' => '',
    'columns' => [
        'id',
        [
            'attribute' => 'create_date',
            'value' => function ($data) {
                return date('d.m.Y H:i', $data->create_date);
            },
            'contentOptions' => function ($data) {
                return ['style' => 'color: ' . $data->color->color];
            }
        ],
        [
            'attribute' => 'drop_date',
            'value' => function ($data) {
                return date('d.m.Y H:i', $data->drop_date);
            },
            'contentOptions' => function ($data) {
                return ['style' => 'color: ' . $data->color->color];
            }
        ],
        [
            'label' => 'Откусить',
            'value' => function ($data) {
                return '<input type="range" class="slider" type="range" min="1" max="100" value="' . $data->how_much_is_eaten . '">'
                    .
                    Html::button('Откусить', ['class' => 'btn']);
            },
            'format' => 'raw',
        ]
    ],
]) ?>
