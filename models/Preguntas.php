<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "preguntas".
 *
 * @property int $id
 * @property string|null $texto
 * @property string|null $respuesta_correcta
 *
 * @property PreguntasCategorias[] $preguntasCategorias
 * @property Respuestas[] $respuestas
 */
class Preguntas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preguntas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['texto'], 'string', 'max' => 255],
            [['respuesta_correcta'], 'string', 'max' => 1],
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
            'respuesta_correcta' => 'Respuesta Correcta',
        ];
    }

    /**
     * Gets query for [[PreguntasCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntasCategorias()
    {
        return $this->hasMany(PreguntasCategorias::className(), ['pregunta_id' => 'id']);
    }

    /**
     * Gets query for [[Respuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuestas::className(), ['pregunta_id' => 'id']);
    }
}
