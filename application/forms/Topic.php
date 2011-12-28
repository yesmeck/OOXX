<?php

class Application_Form_Topic extends OOXX_Form
{

    public function init()
    {
        $this->setAction('/topic/new')
             ->setMethod('post')
             ->setAttrib('id', 'new-topic-form');

        $elements = array();

        $elements['title'] = $this->createElement('text', 'title');
        $elements['title']->setLabel('标题')
                          ->setDescription('，你们有什么想问的？')
                          ->addDecorator('Description', array('tag' => ''))
                          ->setOptions(array('class' => 'xlarge'))
                          ->setRequired(true);

        $elements['content'] = $this->createElement('textarea', 'content');
        $elements['content']->setLabel('内容')
                            ->setOptions(array(
                                'class' => 'xxlarge',
                                'row'   => 3,
                            ))
                            ->setRequired(true);
        
        $elements['submit'] = $this->createElement('submit', 'submit');
        $elements['submit']->setLabel('提交')
                           ->setOptions(array('class' => 'btn primary'))
                           ->setIgnore(true)
                           ->setOrder(100);

        $this->addELements($elements);
    }

}

