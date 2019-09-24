<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property int $id
 * @property int $name
 */
class State extends ActiveRecord
{
    const IN_TREE = 1;
    const UNDERFOOT = 2;
    const ROTTEN = 3;

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%apple_state}}';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['name'], 'string']
        ];
    }
}
