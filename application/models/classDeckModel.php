<?php 
	Class DeckModel {
		private $mysqli;
		private $userCookie;
		function __construct() {
			global $mysqli;
			global $userCookie;
			$this->mysqli = $mysqli;
			$this->userCookie = $userCookie;
		}

		public function get_deckList() {
			return Decks::get_deckList();

		}

		public function create_deck($data) { 
			Decks::create_deck($data);
		}
	}