<?php
namespace common\models;

use yii\db\ActiveRecord;

class MaintenanceRequest extends ActiveRecord
{
    public function rules()
    {
        return [
            // the name, email, subject and body attributes are required
            [['name', 'type', 'notes'], 'required'],
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