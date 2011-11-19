<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $topicModel = new Application_Model_Topic;
        
        $this->view->recentTopics = $topicModel->getRecentTopics();
        
        $this->view->hotTopics = $topicModel->getHotTopics();
    }


}

