<?php

class OOXX_Form_Decorator_Wrapper extends Zend_Form_Decorator_HtmlTag
{
    public function render($content)
    {
        $tag        = $this->getTag();
        $noAttribs  = $this->getOption('noAttribs');

        $attribs = null;
        if (!$noAttribs) {
            $attribs = $this->getOptions();
        }

        return $this->_getOpenTag($tag, $attribs) . $content . $this->_getCloseTag($tag);
    }
}