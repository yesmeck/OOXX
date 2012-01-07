<?php

/**
 * OOXX_Form_Decorator_Wrapper
 *
 * @uses Zend_Form_Decorator_HtmlTag
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */

class OOXX_Form_Decorator_Wrapper extends Zend_Form_Decorator_HtmlTag
{
    /**
     * Render the wrapper
     *
     * @param mixed $content
     * @access public
     * @return void
     */
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
