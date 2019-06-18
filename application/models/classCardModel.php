<?php 
	Class CardModel {
		
		function __construct() {
			
		}

		public function get_cardList($deck) {
			return Card::get_cardList($deck);
		}

		public function create_card($data) { 
			Card::create_card($data);
		}
	}