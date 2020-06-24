<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuestas".
 *
 * @property int $id
 * @property string|null $texto
 * @property int|null $pregunta_id
 *
 * @property Preguntas $pregunta
 */
class Respuestas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuestas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pregunta_id'], 'integer'],
            [['texto'], 'string', 'max' => 255],
            [['pregunta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Preguntas::className(), 'targetAttribute' => ['pregunta_id' => 'id']],
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
            'pregunta_id' => 'Pregunta ID',
        ];
    }

    /**
     * Gets query for [[Pregunta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPregunta()
    {
        return $this->hasOne(Preguntas::className(), ['id' => 'pregunta_id']);
    }
}
