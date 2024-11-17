<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "komisy".
 *
 * @property int $id
 * @property string $nazwa
 * @property string $lokalizacja
 * @property string $telefon
 *
 * @property Samochody[] $samochodies
 */
class Komis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'komisy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nazwa', 'lokalizacja', 'telefon', 'zdjecie_url'], 'required'],
            [['nazwa', 'lokalizacja'], 'string', 'max' => 255],
            [['telefon'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nazwa' => 'Nazwa',
            'lokalizacja' => 'Lokalizacja',
            'telefon' => 'Telefon',
        ];
    }

    /**
     * Gets query for [[Samochodies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSamochodies()
    {
        return $this->hasMany(Samochod::class, ['komis_id' => 'id']);
    }
    public function getSamochody()
{
    return $this->hasMany(Samochod::className(), ['komis_id' => 'id'])->limit(3);
}

}
