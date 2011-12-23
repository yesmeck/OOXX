<?php

/**
 * OOXX_Auth_Adapter_Doctrine
 *
 * @uses Zend_Auth_Adapter_Interface
 * @copyright 2011 Meck
 * @author Meck <yesmeck@gmail.com>
 */
class OOXX_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
{

    /**
     * _userModel
     *
     * @var Application_Model_User
     * @access protected
     */
    protected $_userModel;

    /**
     * _indentity
     *
     * @var string
     * @access protected
     */
    protected $_indentity;

    /**
     * _credential
     *
     * @var string
     * @access protected
     */
    protected $_credential;

    /**
     * _identityColumn
     *
     * @var string
     * @access protected
     */
    protected $_identityColumn;

    /**
     * _credentialColumn
     *
     * @var string
     * @access protected
     */
    protected $_credentialColumn;

    /**
     * _hasher
     *
     * @var array
     * @access protected
     */
    protected $_hasher;

    /**
     * _resultRow
     *
     * @var OOXX/Entity/User
     * @access protected
     */
    protected $_resultRow;

    /**
     * _authResultInfo
     *
     * @var array
     * @access protected
     */
    protected $_authResultInfo;

    /**
     * __construct
     *
     * @param Application_Model_User $userModel
     * @param string $identityColumn
     * @param string $credentialColumn
     * @param array $hasher
     * @access public
     * @return void
     */
    public function __construct(Application_Model_User $userModel, $identityColumn,
        $credentialColumn, array $hasher = array())
    {
        $this->setUserModel($userModel)
             ->setIdentityColumn($identityColumn)
             ->setCredentialColumn($credentialColumn)
             ->setHasher($hasher);
    }

    /**
     * setUserModel
     *
     * @param Application_Model_User $userModel
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setUserModel(Application_Model_User $userModel)
    {
        $this->_userModel = $userModel;
        return $this;
    }

    /**
     * setIdentityColumn
     *
     * @param string $identityColumn
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setIdentityColumn($identityColumn)
    {
        $this->_identityColumn = $identityColumn;
        return $this;
    }

    /**
     * setCredentialColumn
     *
     * @param string $credentialColumn
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setCredentialColumn($credentialColumn)
    {
        $this->_credentialColumn = $credentialColumn;
        return $this;
    }

    /**
     * setHasher
     *
     * @param array $hasher
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setHasher($hasher)
    {
        $this->_hasher = $hasher;
        return $this;
    }

    /**
     * setIdentity
     *
     * @param string $identity
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setIdentity($identity)
    {
        $this->_identity = $identity;
        return $this;
    }

    /**
     * setCredential
     *
     * @param string $credential
     * @access public
     * @return OOXX_Auth_Adapter_Doctrine
     */
    public function setCredential($credential)
    {
        $this->_credential = $credential;
        return $this;
    }

    /**
     * authenticate
     *
     * @access public
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $this->_authResultInfo = array(
            'code'     => Zend_Auth_Result::FAILURE,
            'identity' => $this->_identity,
            'messages' => array(),
        );

        $this->_resultRow = $this->_userModel->findOneBy(array(
            $this->_identityColumn => $this->_identity
        ));

        if (null == $this->_resultRow) {
            $this->_authResultInfo['code'] = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
            $this->_authResultInfo['messages'][] = '用户不存在';
        } else {
            $checkPasswordResult = call_user_func_array($this->_hasher, array(
                $this->_credential,
                call_user_func(array($this->_resultRow, 'get' . ucfirst($this->_credentialColumn))),
            ));
            //do not passed
            if (!$checkPasswordResult) {
                $this->_authResultInfo['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                $this->_authResultInfo['messages'][] = '密码错误';
            } else {
                //success
                $this->_authResultInfo['code'] = Zend_Auth_Result::SUCCESS;
                $this->_authResultInfo['messages'][] = '登录成功';
            }
        }

        return new Zend_Auth_Result(
            $this->_authResultInfo['code'],
            $this->_authResultInfo['identity'],
            $this->_authResultInfo['messages']
        );
    }

    /**
     * getResultRow
     *
     * @access public
     * @return OOXX/Entity/User
     */
    public function getResultRow()
    {
        return $this->_resultRow;
    }
}
