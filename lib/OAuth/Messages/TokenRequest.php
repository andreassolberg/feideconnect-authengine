<?php

namespace FeideConnect\OAuth\Messages;


/**
* 
*/
class TokenRequest extends Message {
	
	function __construct($message) {
		
		parent::__construct($message);

		$this->grant_type		= Message::prequire($message, 'grant_type', array('authorization_code', 'refresh_token', 'client_credentials'));
		$this->code 			= Message::optional($message, 'code');
		$this->redirect_uri		= Message::optional($message, 'redirect_uri');
		$this->client_id		= Message::optional($message, 'client_id');

		// Used in Client Credentials Grant flow.
		$this->scope		= Message::optional($message, 'scope');

	}


	public function getScopeList() {
		if (empty($this->scope)) return [];
		return $this->scope;
	}

}