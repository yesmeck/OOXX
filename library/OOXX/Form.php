<?php

/**
 * OOXX_Form
 *
 * @uses Zend_Form
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */
class OOXX_Form extends Zend_Form
{
    /**
     * __construct
     *
     * @access public
     * @return void
     */
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

    /**
     * createElement
     *
     * @param string $type
     * @param string $name
     * @param array $options
     * @access public
     * @return Zend_Form_Element
     */
    public function createElement($type, $name, $options = null)
    {
        $element = parent::createElement($type, $name, $options);

        //set default decorators
        switch ($element->getType()) {
            case 'Zend_Form_Element_Submit':
                $element = $this->_setSubmitDecorator($element);
                break;
            default:
                $element = $this->_setInputDecorator($element);
                break;
        }

        return $element;
    }

    /**
     * setInputDecorator
     *
     * @param Zend_Form_Element $element
     * @access private
     * @return Zend_Form_Element
     */
    private function _setInputDecorator($element)
    {
        $element->clearDecorators()
                ->addDecorator('ViewHelper')
                ->addDecorator('SpanErrors', array('class' => 'help-block'))
                ->addDecorator('Description', array('tag' => 'p', 'class' => 'description'))
                ->addDecorator('HtmlTag', array(
                    'tag'   => 'div',
                    'id'    => array('callback' => array(get_class($element), 'resolveElementId')),
                    'class' => 'input',
                ))
                ->addDecorator('Label')
                //Wrapper must be added at the end.
                ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'clearfix'));

        return $element;
    }

    /**
     * setSubmitDecorator
     *
     * @param Zend_Form_Element $element
     * @access private
     * @return Zend_Form_Element
     */
    private function _setSubmitDecorator($element)
    {
        $element->clearDecorators()
                ->addDecorator('ViewHelper')
                ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'actions'));
        return $element;
    }

    /**
     * Render form
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
    {
        if (null !== $view) {
            $this->setView($view);
        }

        //set errors
        $errorMessages = $this->getMessages();

        foreach($errorMessages as $element => $messages) {
            $this->getElement($element)
                 ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'clearfix error'))
                 ->addDecorator('Label');
        }

        $content = '';
        foreach ($this->getDecorators() as $decorator) {
            $decorator->setElement($this);
            $content = $decorator->render($content);
        }
        $this->_setIsRendered();
        return $content;
    }


    /**
     * removeElements
     *
     * @param array $names
     * @access public
     * @return void
     */
    public function removeElements(array $names)
    {
        foreach ($names as $name) {
            $this->removeElement($name);
        }
    }

    /**
     * clearElementDecorators
     *
     * @access public
     * @return void
     */
    public function clearElementDecorators()
    {
        foreach ($this->getElements() as $name => $element) {
            $element->clearDecorators();
        }
    }

}

