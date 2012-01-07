<?php

/**
 * OOXX_Validate_UniqueEmail
 *
 * @uses Zend_Validate_Abstract
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class OOXX_Validate_UniqueEmail extends Zend_Validate_Abstract
{
    /**
     * @const string
     */
    const EMAIL_EXISTS = '邮箱已存在';

    /**
     * _messageTemplates
     *
     * @var array
     * @access protected
     */
    protected $_messageTemplates = array(
        self::EMAIL_EXISTS => '邮箱已存在',
    );

    /**
     * __construct
     *
     * @param mixed $model
     * @access public
     * @return void
     */
    public function __construct($model)
    {
        $this->_model = $model;
    }

    /**
     * isValid
     *
     * @param mixed $value
     * @param bool $context
     * @access public
     * @return bool
     */
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
