<?php


class CabinetController extends BaseController {

	function __construct() {
	    parent::__construct();
	}

	public function init_work() {
		$this->get_profileTemplate();
	}

	public function get_profileTemplate() {
        if(isset($_POST['change'])) {
            unset($_POST['change']);
           $this->edit_user($_POST, $_FILES);
        }
        $id = $_GET['id'] ?: $_SESSION['user']['id'];
        $cabinet = new CabinetModel();
        $this->view->render_page('cabinet/profile.php', $cabinet->get_userData($id));
	}

	public function get_usersListTemplate() {
        $req_role = $_POST['req_role'] ?? 0;
	    $cabinet = new CabinetModel();
        $this->view->render_page('cabinet/admin/users.php', $cabinet->get_usersList($req_role));
	}

	public function get_decksTemplate() {
        $decks = new DeckModel();
        $this->view->render_page('cabinet/decks.php', $decks->get_deckList());
	}

    public function get_cardsTemplate() {
        $deck = $_POST['deck_id'] ?: null;
        $cards = new CardModel();
        $this->view->render_page('cabinet/cards.php', $cards->get_cardList($deck));
    }

    public function get_cardsArray($deck = null) {
        $cards = new CardModel();
        return $cards->get_cardList($deck);
    }

	public function get_decksCreateTemplate() {
        if (isset($_POST["create_deck"])) {
            unset($_POST['create_deck']);
            $this->create_deck($_POST);
        }
        $this->view->render_page('cabinet/decks_create.php');
	}

	public function create_deck($data) {
        $decks = new DeckModel();
        $decks->create_deck($data);
    }

	public function get_cardsCreateTemplate() {
        if (isset($_POST['create_card'])) {
            unset($_POST['create_card']);
            $this->create_card($_POST);
        }
        $this->view->render_page('cabinet/cards_create.php');
	}

	public function create_card($data) {
        $cards = new CardModel();
        $cards->create_card($data);
    }

    public function edit_user($data, $files) {
	    $id = $_SESSION['user']['id'];
        $cabinet = new CabinetModel();
        $cabinet->edit_user($id, $data, $files);
    }
}