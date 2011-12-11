<?php

class OOXX_Form extends Zend_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->addElementPrefixPath(
            'OOXX_Validate',
            'OOXX/Validate/',
            'validate'
        );

        $this->addElementPrefixPath(
            'OOXX_Form_Decorator',
            'OOXX/Form/Decorator/',
            'decorator'
        );
    }

    /**
     * Load the default decorators
     *
     * @return Zend_Form
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('HtmlTag', array('tag' => 'fieldset'))
                 ->addDecorator('Form');
        }
        return $this;
    }

    public function addElement($element, $name = null, $options = null) {

        if ($element instanceof Zend_Form_Element) {
            $decorators = $element->getDecorators();
            if (empty ($decorators)) {
                switch ($element->getType()) {
                    case 'Zend_Form_Element_Submit':
                        $element = $this->setSubmitDecorator($element);
                        break;
                    default:
                        $element = $this->setInputDecorator($element);
                        break;
                }
            }
        }

        return parent::addElement($element, $name, $options);
    }

    public function setInputDecorator($element)
    {
        $element->addDecorator('ViewHelper')
                ->addDecorator('Errors')
                ->addDecorator('Description', array('tag' => 'p', 'class' => 'description'))
                ->addDecorator('HtmlTag', array(
                    'tag'   => 'div',
                    'id'    => array('callback' => array(get_class($element), 'resolveElementId')),
                    'class' => 'input',
                ))
                ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'clearfix'))
                ->addDecorator('Label');
        return $element;
    }

    public function setSubmitDecorator($element)
    {
        $element->addDecorator('ViewHelper')
                ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'actions'));
        return $element;
    }
}