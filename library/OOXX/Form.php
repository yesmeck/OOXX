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
                ->removeDecorator('Errors')
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

    public function setSubmitDecorator($element)
    {
        $element->addDecorator('ViewHelper')
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
        $errors = $this->getErrors();
        foreach($errors as $element => $error) {
            if (!empty($error)) {
                $this->getElement($element)
                     ->addDecorator('Wrapper', array('tag' => 'div', 'class' => 'clearfix error'))
                     ->addDecorator('Label');
            }
        }

        $content = '';
        foreach ($this->getDecorators() as $decorator) {
            $decorator->setElement($this);
            $content = $decorator->render($content);
        }
        $this->_setIsRendered();
        return $content;
    }

}
