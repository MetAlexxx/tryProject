<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marks_model extends CI_Model {

	public function get_mark($bID)
    {
        $query = $this->db->query("SELECT * FROM T_marks WHERE bID = '$bID'");
        $res = $query->result_array();
        if(isset($res[0]))
            return $res[0];
    }

    public function get_user_mark($bID, $uID)
    {
        $query = $this->db->query("SELECT * FROM T_rated WHERE bID = '$bID' AND uID = '$uID'");
        $res = $query->result_array();
        if(isset($res[0]))
            return $res[0];
    }

    public function set_mark($bID, $uID, $uMark)
    {
        $query = $this->db->query("SELECT * FROM T_rated WHERE bID = '$bID' AND uID = '$uID'");
        $res1 = $query->result_array();
        
        if(isset($res1[0])){ 
            //edit           
            $this->db->query("UPDATE T_rated SET mark = '$uMark' WHERE bID = '$bID' AND uID = '$uID'");
            $lastM = $res1[0]['mark'];
            $query = $this->db->query("SELECT * FROM T_marks WHERE bID = '$bID'");
            $res2 = $query->result_array();
            if($lastM < $uMark){
                $dM = $uMark - $lastM;
                $newM = ($res2[0]['mark'] * $res2[0]['cCount'] + $dM) / $res2[0]['cCount'];
            }elseif($lastM > $uMark){
                $dM = $lastM - $uMark;
                $newM = ($res2[0]['mark'] * $res2[0]['cCount'] - $dM) / $res2[0]['cCount'];
            }
            if($lastM != $uMark) $this->db->query("UPDATE T_marks SET mark = '$newM' WHERE bID = '$bID'");
        }else{ 
            //insert
            $this->db->query("INSERT INTO T_rated (bID, uID, mark) VALUES ('$bID', '$uID', '$uMark')");
            $query = $this->db->query("SELECT * FROM T_marks WHERE bID = '$bID'");
            $res = $query->result_array();
            if(isset($res[0])){
                $cCount = $res[0]['cCount'];
                $newM = ($res[0]['mark'] * $cCount + $uMark) / ($cCount + 1);
                $cCount++;
                $this->db->query("UPDATE T_marks SET mark = '$newM', cCount = '$cCount' WHERE bID = '$bID'");
            }else{
                $this->db->query("INSERT INTO T_marks (bID, cCount, mark) VALUES ('$bID', 1, '$uMark')");   
            }

        }
            
    }
}
