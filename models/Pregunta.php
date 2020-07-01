<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property int $id
 * @property string $texto
 * @property string $respuesta_correcta
 * @property int|null $image_id
 *
 * @property Imagen $image
 * @property PreguntaCategoria[] $preguntaCategorias
 * @property PreguntaTest[] $preguntaTests
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
            [['texto', 'respuesta_correcta'], 'required'],
            [['image_id'], 'integer'],
            [['texto'], 'string', 'max' => 255],
            [['respuesta_correcta'], 'string', 'max' => 1],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['image_id' => 'id']],
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
     * Gets query for [[PreguntaCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaCategorias()
    {
        return $this->hasMany(PreguntaCategoria::className(), ['pregunta_id' => 'id']);
    }

    /**
     * Gets query for [[PreguntaTests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntaTests()
    {
        return $this->hasMany(PreguntaTest::className(), ['pregunta_id' => 'id']);
    }

    /**
     * Gets query for [[Respuestas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['pregunta_id' => 'id'])->orderBy('id');
    }
    
    public function getCategorias(){
        return $this->hasMany(Categoria::className(), ['id' => 'categoria_id'])->via('preguntaCategorias');
       
    }
    
    public function getTests(){
        return $this->hasMany(Test::className(), ['id' => 'test_id'])->via('preguntaTests');
       
    }
}
