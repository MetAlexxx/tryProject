<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model {

	public function get_comments($bID)
    {
        $query = $this->db->query("SELECT * FROM T_comments AS C INNER JOIN T_users AS U ON C.uID = U.uID AND bID = '$bID'");
        $res = $query->result_array();
        if(isset($res))
            return $res;
    }

    public function del_comments($cID)
    {
        $this->db->query("DELETE FROM T_comments WHERE cID = '$cID'");
    }

    public function create_comments($bID, $uID, $cText)
    {
        $this->db->query("INSERT INTO T_comments (bID, uID, cText) VALUES ('$bID', '$uID', '$cText')");
    }
}
