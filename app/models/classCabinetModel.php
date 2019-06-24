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

    public function get_userData($id) {
        return $this->db->select(
            'mnc_users',
            [
                'user_avatar',
                'user_birthday',
                'user_nickname',
            ],
            [
                'id' => $id
            ]
        )[0];
    }

    public function edit_user($user_id, $data, $files) {
        $params = [];

        foreach ($data as $column => $value) {
            $params[$column] = $value;
        }

        if(!empty($files['user_avatar'])) {
            if(Cfile::isSecure($files['user_avatar'])){
                $name = Cfile::load($files['user_avatar'], AVATARS_UPLOAD);
                if ($name) {
                    $params['user_avatar'] = $name;
                }
            }
        }

        if ($this->db->update('mnc_users', $params, ['id' => $user_id])) {
            $auth = new AuthorizationModel();
            $auth->reload_cookie($user_id);
        }
    }

}