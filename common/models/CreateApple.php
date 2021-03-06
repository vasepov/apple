<?php
namespace common\models;

use yii\base\Model;
use yii\db\Query;

/**
 * Модель создания яблок с рандомным числом 10
 * Class CreateApple
 * @package common\models
 */
class CreateApple extends Model
{
    public function create()
    {
        $colorIds = array_column((new Query())->select(['id'])->from('color')->all(), 'id');

        for ($i = 1; $i <= random_int(1, 10); $i++) {
            $model = new Apple();
            $model->color_id = $colorIds[array_rand($colorIds)];
            $model->create_date = time();
            $model->state_id = State::IN_TREE;
            $model->how_much_is_eaten = 0;
            if (!$model->save()) {
                $this->addError('ALL', 'Добавлено ' . $i - 1 . ' яблок');
                $this->addErrors($model->errors);
                return false;
            }

        }

        return true;
    }
}