<?php


class CabinetModel extends BaseModel
{

    public function get_usersList($req_role = 0)
    {
        if ($req_role == 0) {
            $where_string = sprintf(" AND user_role >= 1 AND user_role < %s", $this->user_role);
        } else if ($req_role > $this->user_role) {
            $where_string = sprintf(" AND user_role = %s", $this->user_role);
        } else {
            $where_string = sprintf(" AND user_role = %s", $req_role);
        }

        return $this->db->select('mnc_users', ['*'], $where_string, ['id' => 'DESC']);
    }
}