<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public $_id;
	public $_hash;
	
	public function authenticate()
	{
		$users = Users::model()->find(array(
			'condition' => 	"LOWER(email) = :email AND hash = :hash",
			'params' => array(
				':email' => strtolower($this->username),
				':hash'=>sha1(strtolower($this->username))
			)
		));
		
		if($users == NULL)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users->password !== md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id = $users->id_user;
			$this->_hash = $users->hash;
			$this->errorCode=self::ERROR_NONE;
		}	
		return !$this->errorCode;
	}
	public function authenticateSso($provider_name, $provider_uid)
	{
		$users = Users::model()->find(array(
			'condition' => 	"LOWER(hybridauth_provider_name) = :hybridauth_provider_name AND hybridauth_provider_uid = :hybridauth_provider_uid",
			'params' => array(
				':hybridauth_provider_name' => $provider_name,
				':hybridauth_provider_uid'=> $provider_uid
			)));
		
		if($users == NULL)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else{
			$this->_id = $users->id_user;
			$this->_hash = $users->hash;
			$this->errorCode=self::ERROR_NONE;
		}	
		return !$this->errorCode;
	}
	
	public function getId(){
		return array(
			'id'=>$this->_id,
			'hash' => $this->_hash
		);
	}
}