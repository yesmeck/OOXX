<?php

/**
 * OOXX_View_Helper_FormSpanErrors
 *
 * @uses Zend_View_Helper_FormErrors
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class OOXX_View_Helper_FormSpanErrors extends Zend_View_Helper_FormErrors
{
    /**
     * _htmlElementStart
     *
     * @var string
     * @access protected
     */
    protected $_htmlElementStart        = '<span%s>';

    /**
     * _htmlElementEnd
     *
     * @var string
     * @access protected
     */
    protected $_htmlElementEnd          = '</span>';

    /**
     * _htmlElementSeparator
     *
     * @var string
     * @access protected
     */
    protected $_htmlElementSeparator    = '';

    /**
     * formSpanErrors
     *
     * @param mixed $errors
     * @param array $options
     * @access public
     * @return void
     */
    public function formSpanErrors($errors, array $options = null)
    {
        return parent::formErrors($errors, $options);
    }
}
