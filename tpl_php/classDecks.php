<?php
	/**
	 * dev by @fortrou, @itachinight
	 * class Deck basic
	 * params: deckID, deckDoors, deckTreasures, deckDoorsDiscard, deckTreasuresDiscard, deckDungeons, deckDungeonsDiscard
	 * methods: get_cards, shuffle_cards, take_card, push_card
	 *
	 **/


	class Decks {
		private $deckID;
		private $deckDoors;
		private $deckDungeons;
		private $deckTreasures;
		private $deckDoorsDiscard;
		private $deckDungeonsDiscard;
		private $deckTreasuresDiscard;

		public function __construct($deckID) {
			$this->deckID = $deckID;
		}

		/*array(1 => array('1', 1),
				2 => array('2', 1),
				3 => array('3', 2),
				4 => array('4', 2)
			  );*/
		public function get_cards() {
			$result_db = array();
			foreach ($result_db as $value) {
				if($value[1] == 1) {
					$this->deckDoors[] = $value;
				}
				if($value[1] == 2) {
					$this->deckTreasures[] = $value;
				}
			}

		}
		/**
		 * @mod - deck type
		 * 1 - doors 
		 * 2 - treasures
		 * 3 - dungeons
		 **/
		public function shuffle_cards($mod) {
			switch ($mod) {
				case 1:
					shuffle($this->deckDoors);
					break;
				case 2:
					shuffle($this->deckTreasures);
					break;
				case 2:
					shuffle($this->deckDungeons);
					break;
				default:
					return false;
					break;
			}
		}
		/**
		 * @mod - deck type
		 * 1 - doors 
		 * 2 - treasures
		 * 3 - dungeons
		 * 4 - treasures discard
		 * 5 - dungeons discard
		 * @subMod - research deck
		 * 1 - take top card
		 * 2 - research
		 **/
		
		public function take_card($player, $mod, $cardNum = 1, $subMod = 1) {

		}
		public function push_card($player, $mod, $cardNum = 1) {

		}
	}
?>