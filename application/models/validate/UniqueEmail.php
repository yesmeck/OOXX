<?php

class Application_Validate_UniqueEmail extends Zend_Validate_Abstract
{
    const EMAIL_EXISTS = '邮箱已存在';

    protected $_messageTemplates = array(
        self::EMAIL_EXISTS => '邮箱已存在',
    );

    public function __construct($model)
    {
        $this->_model = $model;
    }

    public function isValid($value, $context = null)
    {
        $this->_setValue($value);
        $user = $this->_model->findOneBy(array('email' => $value));

        if (null === $user) {
            return true;
        }

        $this->_error(self::EMAIL_EXISTS);
        return false;
    }
}