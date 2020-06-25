<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property int $id
 * @property string|null $texto
 * @property string|null $respuesta_correcta
 * @property int|null $image_id
 * @property int|null $test_id
 *
 * @property Imagen $image
 * @property Test $test
 * @property PreguntaCategoria[] $preguntaCategorias
 * @property Respuesta[] $respuestas
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'test_id'], 'integer'],
            [['texto'], 'string', 'max' => 255],
            [['respuesta_correcta'], 'string', 'max' => 1],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
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
            'image_id' => 'Image ID',
            'test_id' => 'Test ID',
        ];
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Imagen::className(), ['id' => 'image_id']);
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * Gets query for [[PreguntaCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaCategorias()
    {
        return $this->hasMany(PreguntaCategoria::className(), ['pregunta_id' => 'id']);
    }

    /**
     * Gets query for [[Respuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['pregunta_id' => 'id']);
    }
    
    public function getCategorias(){
        return $this->hasMany(Categoria::className(), ['id' => 'categoria_id'])->via('preguntaCategorias');
       
    }
}
