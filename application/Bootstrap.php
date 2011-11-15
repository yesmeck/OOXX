<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

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
        
    }
    
}

