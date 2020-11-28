<?php
namespace common\models;

use yii\db\ActiveRecord;

class MaintenanceRequest extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name', 'type', 'summary'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['summary'], 'string', 'min' => 25, 'max' => 255],
        ];
    }
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{maint_request}}';
    }
}