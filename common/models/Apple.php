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
 */
class Apple extends ActiveRecord
{
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

    public function validateEat() {
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
    public function getColor()
    {
        return $this->hasOne(Color::class, ['id' => 'color_id']);
    }
}
