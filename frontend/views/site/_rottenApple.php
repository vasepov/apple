<?php

use common\models\Apple;
use common\models\State;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>
<h3>Гнилые яблоки</h3>
<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => Apple::find()->with(['colorModel'])->where(['state_id' => State::ROTTEN]),
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
                return ['style' => 'color: ' . $data->colorModel->color];
            }
        ],
        [
            'attribute' => 'drop_date',
            'value' => function ($data) {
                return date('d.m.Y H:i', $data->drop_date);
            },
            'contentOptions' => function ($data) {
                return ['style' => 'color: ' . $data->colorModel->color];
            }
        ]
    ],
]) ?>
