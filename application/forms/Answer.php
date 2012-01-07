<?php

/**
 * Answer form
 *
 * @uses Zend_Form
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class Application_Form_Answer extends Zend_Form
{    
    /**
     * Init
     *
     * @access public
     * @return void
     */
    public function init()
    {

        $this->setAction('')
             ->setMethod('post')
             ->setAttrib('id', 'new-answer-form')
             ->setDisableLoadDefaultDecorators(true);

        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'answer/_form.phtml')),
            'Form'
        ));
    }
}

