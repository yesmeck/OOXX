<?php

class OOXX_View_Helper_FormSpanErrors extends Zend_View_Helper_FormErrors
{
    protected $_htmlElementStart        = '<span%s>';
    protected $_htmlElementEnd          = '</span>';
    protected $_htmlElementSeparator    = '';

    public function formSpanErrors($errors, array $options = null)
    {
        return parent::formErrors($errors, $options);
    }
}
