<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id
 * @property string|null $texto
 *
 * @property PreguntaCategoria[] $preguntaCategorias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'texto' => 'Texto',
        ];
    }

    /**
     * Gets query for [[PreguntaCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaCategorias()
    {
        return $this->hasMany(PreguntaCategoria::className(), ['categoria_id' => 'id']);
    }
}
