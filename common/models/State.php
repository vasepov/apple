<?php

namespace common\models;

use yii\base\Model;

/**
 * Сперва это планировалось как ActiveRecord,
 * но антиутопия сказала что и так будет хорошо
 * Class State
 * @package common\models\
 */
class State extends Model
{
    const IN_TREE = 1;
    const UNDERFOOT = 2;
    const ROTTEN = 3;
}
