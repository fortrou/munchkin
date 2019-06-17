<?php 
	Class CardModel {
		
		function __construct() {
			
		}

		public function get_deckList() {
			// $result = Decks::get_deckList();
			return $result = Decks::get_deckList();

		}

		public function create_card($data) { 
			Card::create_card($data);
		}
	}