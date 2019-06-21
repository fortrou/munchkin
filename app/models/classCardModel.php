<?php


class CardModel extends BaseModel {

    public function __construct()
    {
        parent::__construct();
    }

	public function get_cardList($deck_id) {
		if (null === $deck_id) {
            $result = $this->db->select('mnc_cards', '*');
        } else {
            $result = $this->db->select('mnc_cards', '*');
        }
		return $result;
	}

	public function create_card($data) {
        return $this->db->insert('mnc_cards', $data);
	}
}