<?php


namespace FeideConnect\OAuth;
use FeideConnect\Data\StorageProvider;
use FeideConnect\Data\Models;

class AccessTokenPool {

	protected $client, $user, $stoarge;
	protected $tokens;

	function __construct($client, $user = null) {
		$this->client = $client;
		$this->user = $user;
		$this->storage = StorageProvider::getStorage();

		$this->getTokens();
	}


	function getTokens() {
		$this->tokens = [];

		$userid = '';
		if ($this->user !== null) $userid = $this->user->userid;

		$ct = $this->storage->getAccessTokens($userid, $this->client->id);

		foreach($ct AS $t) {
			if ($t->stillValid()) {
				$this->tokens[] = $t;
			}
		}
	}


	function getCandidates($scopesInQuestion) {
		$candidates = [];

		foreach($this->tokens AS $token) {
			if ($token->hasExactScopes($scopesInQuestion)) {
				$candidates[] = $token;
			}
		}
		return $candidates;
	}


	function getSelectedCandidate($scopesInQuestion) {
		$candidates = $this->getCandidates($scopesInQuestion);
		if  (empty($candidates)) return null;

		// TODO Implement policy on which token to select.
		// TODO Also require that the token is valid significantly long into the future
		return $candidates[0];
	}


	function getToken($scopesInQuestion, $refreshToken, $expires_in) {
		$candidate = $this->getSelectedCandidate($scopesInQuestion);

		if ($candidate !== null) return $candidate;

		$accesstoken = Models\AccessToken::generate($this->client, $this->user, $scopesInQuestion, $refreshToken, $expires_in);
		$this->storage->saveToken($accesstoken);

		return $accesstoken;
	}




}