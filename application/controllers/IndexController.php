<?php

/**
 * Index controller
 *
 * @uses Zend_Controller_Action
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class IndexController extends Zend_Controller_Action
{

    /**
     * Index action
     *
     * @access public
     * @return void
     */
    public function indexAction()
    {
        $topicModel = new Application_Model_Topic;
        
        $this->view->recentTopics = $topicModel->getRecentTopics();
        
        $this->view->hotTopics = $topicModel->getHotTopics();
    }


}

