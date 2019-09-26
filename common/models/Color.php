<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property int $id
 * @property string $color
 * @property bool $deleted
 */
class Color extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%color}}';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['color'], 'string'],
            [['deleted'], 'boolean']
        ];
    }
}
