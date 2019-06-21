<?php
	/**
	 * dev by @fortrou, @itachinight
	 * class Card basic
	 * params: type, description
	 * methods: act_card, .. 
	 *
	 **/
	class Card {
		private $cardType;
		private $cardDescription;
		private $cardImage;

		public function __construct($type, $description, $image) {
			$this->cardType = $type;
			$this->cardDescription = $description;
			$this->cardImage = $image;
		}

		public function get_type() {
			return $this->cardType;
		}

		public function get_description() {
			return $this->cardDescription;
		}

		public function get_image() {
			return $this->cardImage;
		}

		public function act_card() {

		}

	}
?>