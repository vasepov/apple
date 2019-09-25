<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property int $id
 * @property int $color_id
 * @property int $create_date
 * @property int $drop_date
 * @property int $state_id
 * @property int $how_much_is_eaten
 * @property int $deleted
 *
 * relations
 * @property Color $colorModel
 */
class Apple extends ActiveRecord
{
    const TIME_ROTTEN_APPLE = 18000; // 5 часов на угниление яблока

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['color_id', 'state_id', 'how_much_is_eaten', 'create_date', 'drop_date'], 'integer'],
            [['deleted'], 'boolean'],
            [['how_much_is_eaten'], 'validateEat']
        ];
    }

    public function validateEat()
    {
        if ($this->getOldAttribute('how_much_is_eaten') > $this->how_much_is_eaten) {
            $this->addError('how_much_is_eaten', 'Нельзя откусить яблоко в большую сторону');
        }
    }

    /** @inheritDoc */
    public function attributeLabels()
    {
        return [
            'create_date' => 'Дата появления',
            'drop_date' => 'Дата падения'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorModel()
    {
        return $this->hasOne(Color::class, ['id' => 'color_id']);
    }

    /**
     *  Провекра и удаление гнилых яблок
     */
    public function checkRottenApple()
    {
        $apples = self::find()->where(
            'state_id = :stateId and drop_date + ' . self::TIME_ROTTEN_APPLE . ' < :thisTime',
            [':stateId' => State::UNDERFOOT, ':thisTime' => time()]
        )->all();
        foreach ($apples as $apple) {
            $apple->state_id = State::ROTTEN;
            $apple->save();
        }
    }

    public function getColor()
    {
        return $this->colorModel->color;
    }
}
