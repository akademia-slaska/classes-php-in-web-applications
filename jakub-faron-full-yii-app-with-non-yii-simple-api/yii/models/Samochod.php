<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "samochody".
 *
 * @property int $id
 * @property string $marka
 * @property string $model
 * @property int $rok
 * @property int|null $komis_id
 *
 * @property Komisy $komis
 */
class Samochod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'samochody';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marka', 'model', 'rok'], 'required'],
            [['rok', 'komis_id'], 'integer'],
            [['marka', 'model', 'zdjecie_url'], 'string', 'max' => 50],
            [['komis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Komis::class, 'targetAttribute' => ['komis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marka' => 'Marka',
            'model' => 'Model',
            'rok' => 'Rok',
            'komis_id' => 'Komis ID',
        ];
    }

    /**
     * Gets query for [[Komis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKomis()
    {
        return $this->hasOne(Komis::class, ['id' => 'komis_id']);
    }
}
