<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initAutoloader()
    {
        require_once 'Doctrine/Common/ClassLoader.php';

        $autoloader = Zend_Loader_Autoloader::getInstance();

        $bisnaAutoloader = new \Doctrine\Common\ClassLoader('Bisna');
        $autoloader->pushAutoloader(array($bisnaAutoloader, 'loadClass'), 'Bisna');

        $appAutoloader = new \Doctrine\Common\ClassLoader('OOXX');
        $autoloader->pushAutoloader(array($appAutoloader, 'loadClass'), 'OOXX');
    }
    
    public function _initRoutes()
    {
        $this->bootstrap('frontController');

        $router = $this->frontController->getRouter();

        $route = new Zend_Controller_Router_Route(
            'topic/:topicId',
            array(
                'action'     => 'view',
                'controller' => 'topic',
            ),
            array(
                'topicId'    => '[0-9]+',
            )
        );

        $router->addRoute('topicView', $route);

        $route = new Zend_Controller_Router_Route(
            'answer/question/:questionId',
            array(
                'action'     => 'new',
                'controller' => 'answer',
            ),
            array(
                'questionId' => '[0-9]+',
            )
        );

        $router->addRoute('answerNew', $route);

        $route = new Zend_Controller_Router_Route(
            'question/vote',
            array(
                'action'     => 'index',
                'controller' => 'vote',
            )
        );

        $router->addRoute('questionVote', $route);
    }


    protected function _initAuth()
    {
        $this->bootstrap('session');
        $this->bootstrap('view');
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $view = $this->getResource('view');
            Zend_Registry::set('authUser', $auth->getIdentity());
        }
    }

    public function _initValidator()
    {
        $translator = new Zend_Translate(
            array(
                'adapter' => 'array',
                'content' => APPLICATION_PATH . '/resources/languages',
                'locale'  => 'zh_CN',
                'scan' => Zend_Translate::LOCALE_DIRECTORY
            )
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
    
    public function _initViewSettings()
    {
        $this->bootstrap('view');
        
        $this->_view = $this->getResource('view');
        
        $this->_view->setEncoding('UTF-8');
        $this->_view->doctype('HTML5');
        
        $this->_view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        
        $this->_view->headTitle('我是XXX，你们有什么想问的？');
        
        $this->_view->headLink()->appendStylesheet('/css/bootstrap.css');
        $this->_view->headLink()->appendStylesheet('/css/main.css');
        
        $this->_view->headScript()->appendFile('/js/jquery.js');
        $this->_view->headScript()->appendFile('/js/bootstrap-dropdown.js');
        $this->_view->headScript()->appendFile('/js/bootstrap-modal.js');
        $this->_view->headScript()->appendFile('/js/ooxx.js');
    }
    
}

