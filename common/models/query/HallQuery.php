<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Hall]].
 *
 * @see \common\models\Hall
 */
class HallQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Hall[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Hall|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
