<?php

class UserFilterForm extends CFormModel
{

    private $_id;

    private $_name;

    public $role;

    public function __get($name)
    {
        $module = Yii::app()->controller->module;
        switch ($name) {
            case $module->userIdColumn:
                return $this->_id;
            case $module->userNameColumn:
                return $this->_name;
            default:
                return parent::__get($name);
        }
    }

    public function __set($name, $value)
    {
        $module = Yii::app()->controller->module;
        switch ($name) {
            case $module->userIdColumn:
                $this->_id = $value;
                break;
            case $module->userNameColumn:
                $this->_name = $value;
                break;
            default:
                parent::__set($name, $value);
        }
    }

    public function __isset($name)
    {
        $module = Yii::app()->controller->module;
        switch ($name) {
            case $module->userIdColumn:
                return !is_null($this->_id);
            case $module->userNameColumn:
                return !is_null($this->_name);
            default:
                return parent::__isset($name);
        }
    }

    public function __unset($name)
    {
        $module = Yii::app()->controller->module;
        switch ($name) {
            case $module->userIdColumn:
                $this->_id = null;
                break;
            case $module->userNameColumn:
                $this->_name = null;
                break;
            default:
                parent::__unset($name);
        }
    }

    public function attributeNames()
    {
        $module = Yii::app()->controller->module;
        return [
            $module->userIdColumn,
            $module->userNameColumn,
            'role'
        ];
    }

    public function rules()
    {
        return [
            [implode(', ', $this->attributeNames()), 'safe']
        ];
    }

    public function search()
    {
        $module = Yii::app()->controller->module;
        $model = new $module->userClass('search');
        $model->unsetAttributes();
        $model->setAttributes([
            $module->userIdColumn => $this->_id,
            $module->userNameColumn => $this->_name
        ]);
        $dataProvider = $model->search();
        if ($this->role) {
// ???
        }
        return $dataProvider;
    }
}
