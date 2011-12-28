<?php

class Application_Form_Topic extends OOXX_Form
{
    public function init()
    {
        $this->setAction('/topic/new')
             ->setMethod('post')
             ->setAttrib('id', 'new-topic-form');

        $this->addELements(array(
            $this->createElement('text', 'title')
                 ->setLabel('标题')
                 ->setDescription('，你们有什么想问的？')
                 ->addDecorator('Description', array('tag' => ''))
                 ->setOptions(array('class' => 'xlarge'))
                 ->setRequired(true),

            $this->createElement('textarea', 'content')
                 ->setLabel('内容')
                 ->setOptions(array(
                     'class' => 'xxlarge',
                     'row'   => 3,
                 ))
                 ->setRequired(true),
        
            $this->createElement('submit', 'submit')
                 ->setLabel('提交')
                 ->setOptions(array('class' => 'btn primary'))
                 ->setIgnore(true)
                 ->setOrder(100),
        ));
    }
}

