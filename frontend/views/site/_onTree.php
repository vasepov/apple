<?php
/**
 * @var yii\web\View $this
 * @var common\models\Apple $model
 */

use common\models\Apple;
use common\models\State;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>

    <h3>Яблоки на дереве</h3>
<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => Apple::find()->with(['state', 'color'])->where(['state_id' => State::IN_TREE]),
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
        ]
    ],
]) ?>