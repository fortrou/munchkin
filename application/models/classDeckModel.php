<?php


class DeckModel extends BaseModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_deckList() {
        if ($this->user_role == 2) {
            $result = $this->db->select('mnc_decks', ['*']);
        } else if ($this->user_role == 1) {
            $result = $this->db->select('mnc_decks', ['*'], ['deck_author' => $_SESSION['user']['id']]);
        }
        return $result ?? [];
	}

	public function create_deck($data) {
        return $this->db->insert('mnc_decks', $data);
	}
}