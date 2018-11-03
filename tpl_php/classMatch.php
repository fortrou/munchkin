<?php
	/**
	 * dev by @fortrou, @itachinight
	 * class Match basic
	 * params: player(array(id, level)), playerCard, deckId, turnTime, firstPlayer, currentTurn
	 * methods: roll_dice, change_turn, get_wearedItems, get_startCards .. 
	 *
	 **/
	class Match {
		private $player;
		private $playerCard;
		private $deckId;
		private $turnTime;
		private $firstPlayer;
		private $currentTurn

		function __construct() {

		}
		/**
		 * @global deckDoors
		 * - variable for current deck doors in this game
		 * @global deckTreasures
		 * - variable for current deck treasures in this game
		 **/
		public function get_startCards($players) {
			if(empty($players)) return false;
			global $deckDoors;
			global $deckTreasures;
			foreach($players as $value) {
				$this->playerCard[$value] = array();
				/*for($i = 0; $i < 4; $i++) {
					$this->playerCard[$value][] = array($deckDoors)
				}*/
			}
		}
		public function roll_dice($player) {
			$min = 1;
			$max = 6;
			$result = rand($min, $max);
			return $result
		}
		public function change_turn() {

		}
		/**
		 * @player - id player 
		 * @mod - cards view type:
		 * 1 - preview text description
		 * 2 - preview icon description
		 * 3 - full description
		 **/
		/*array(1 => array(1 => array('1', 1),
						 2 => array('2', 1),
						 3 => array('3', 2),
						 4 => array('4', 2)),
			  2 => array(1 => array('5', 1),
						 2 => array('6', 1),
						 3 => array('7', 2),
						 4 => array('8', 2))

			  );*/
		public function get_wearedItems($player, $mod) {
			$result = '';
			$buffer = $this->playerCard[$player];
			foreach($buffer as $value) {
				if($value[1] == 2) {
					switch ($mod) {
						case 1:
							$result .= sprintf('<span>%s</span>', $value[0]);
							break;
						case 2:
							$result .= sprintf('<span>%s</span>', $value[0]);
							break;
						case 3:
							$result .= sprintf('<span>%s</span>', $value[0]);
							break;
						default:
							continue;
							break;
					}
				}
			}
		}
	}
?>