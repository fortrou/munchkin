<?php

require_once("interfaceInitiator.php");
require_once("application/models/classBaseModel.php");
require_once("application/models/classCabinetModel.php");
require_once("classAuthorization.php");
require_once("application/models/classDeckModel.php");
require_once("application/models/classCardModel.php");


class Cabinet implements Initiator {
	private $mainModel;

	function __construct() {
		$this->mainModel = new CabinetModel();
	}

	public function init_work() {
		$this->get_profileTemplate();
	}

	public function get_profileTemplate() {
		require_once(DOC_ROOT . "/content/templates/cabinet/profile.php");
	}

	public function get_usersListTemplate() {
		require_once(DOC_ROOT . "/content/templates/cabinet/admin/users.php");
	}

	public function get_usersList($req_role = 0) {
		return $this->mainModel->get_usersList($req_role);
	}

	public function get_decksTemplate() {
		require_once(DOC_ROOT . "/content/templates/cabinet/decks.php");
	}

    public function get_decksArray() {
        $decks = new DeckModel();
        return $decks->get_deckList();
    }

    public function get_cardsTemplate() {
        require_once(DOC_ROOT . "/content/templates/cabinet/cards.php");
    }

    public function get_cardsArray($deck = null) {
        $cards = new CardModel();
        return $cards->get_cardList($deck);
    }

	public function get_decksCreateTemplate() {
		require_once(DOC_ROOT . "/content/templates/cabinet/decks_create.php");
	}

	public function create_deck($data) {
        $decks = new DeckModel();
        $decks->create_deck($data);
    }

	public function get_cardsCreateTemplate() {

		require_once(DOC_ROOT . "/content/templates/cabinet/cards_create.php");
	}

	public function create_card($data) {
        $cards = new CardModel();
        $cards->create_card($data);
    }
}