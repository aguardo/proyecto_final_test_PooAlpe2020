<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $description
 * @property string|null $fecha
 *
 * @property PreguntaTest[] $preguntaTests
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['fecha'], 'safe'],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * Gets query for [[PreguntaTests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaTests()
    {
        return $this->hasMany(PreguntaTest::className(), ['test_id' => 'id']);
    }
    
    public function getPreguntas(){
        return $this->hasMany(Pregunta::className(), ['id' => 'pregunta_id'])->via('preguntaTests');
       
    }
}
