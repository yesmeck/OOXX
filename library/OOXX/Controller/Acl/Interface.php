<?php

interface OOXX_Controller_Acl_Interface
{
    public function setIdentity($identity);
    
    public function getIdentity();
    
    public function setAcl(OOXX_Acl_Interface $acl);
    
    public function getAcl();
    
    public function checkAcl($action);
}