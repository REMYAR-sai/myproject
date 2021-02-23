<?php
	class Mainmodel extends CI_model
		{	
			public function regist()
			{
				$this->db->insert("user");
			}
			public function encpswd($pass)
			{
				return password_hash($pass,PASSWORD_BCRYPT);
			}
			 public function new()
			 {
			 	$this->db->select('*');
			 	$qry=$this->db->get("user");
			 	return $qry;
			}
			public function singledata($id)
				{
					$this->db->select('*');
					$this->db->where("id",$id);
					$qry=$this->db->get("user");
					return $qry;
				}
			public function singleselect()
			{
				$qry=$this->db->get("user");
				return $qry;
			}
			public function updatedetails($a,$id)
			{
				$this->db->select('*');
				$qry=$this->db->where("id",$id);
				$qry=$this->db->update("user",$a);
				return $qry;
			}
			// public function deletedetails($id)
			// {
			// 	$this->db->where("id",$id);
			// 	$this->db->delete("details");
			// }
			
			public function  approvedetails()
			{
				$this->db->select('*');
				$qry=$this->db->get("user");
				return $qry;
			}
			public function approve($id)
			{
				$this->db->set('status','1');
				$qry=$this->db->where("id",$id);
				$qry=$this->db->update("user");
				return $qry;
			}
			public function reject($id)
			{
				$this->db->set('status','2');
				$qry=$this->db->where("id",$id);
				$qry=$this->db->update("user");
				return $qry;
			}

			public function selectpass($email,$pass)
			 {
				$this->db->select('password');
				$this->db->from("user");
				$this->db->where("email","$email");
				$query=$this->db->get()->row('password');
				return $this->verifypass($pass,$query);
			}
			public function verifypass($pass,$query)
			{
				return password_verify($pass,$query);
			}
}
?>