<?php

class TopicController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function newAction()
    {
        $form = new Application_Form_Topic();
        
        $this->view->form = $form;
    }


}



