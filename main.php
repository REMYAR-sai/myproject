<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('user');
	}
	public function login1()
	{
		$this->load->view('login1');
	}

	 public function regist()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("firstname","firstname",'required');
		$this->form_validation->set_rules("lastname","lastname",'required');
		$this->form_validation->set_rules("username","username",'required');
		$this->form_validation->set_rules("password","password",'required');
		$this->form_validation->set_rules("mobile","mobile",'required');
		$this->form_validation->set_rules("email","email",'required');
		if($this->form_validation->run())
		{
			$this->load->model('Mainmodel');
			$pass=$this->input->post("password");
			$encpass=$this->Mainmodel->encpswd($pass);
			$a=array("firstname"=>$this->input->post("firstname"),
			"lastname"=>$this->input->post("lastname"),
			"username"=>$this->input->post("username"),
			"mobile"=>$this->input->post("mobile"),
			"email"=>$this->input->post("email"),
			"password"=>$encpass );
			 $this->db->insert('user',$a);  
		redirect(base_url().'main/index');
		}
	}

	public function new()
	{
		
		$this->load->model('Mainmodel');
		$data['n']=$this->Mainmodel->new();
		$this->load->view('user',$data);
	}
	public function updatedetails()
	 {
	 	$a=array("firstname"=>$this->input->post("firstname"),
			"lastname"=>$this->input->post("lastname"),
			"username"=>$this->input->post("username"),
			"mobile"=>$this->input->post("mobile"),
			"email"=>$this->input->post("email"));
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$data['user']=$this->Mainmodel->singledata($id);
		$this->Mainmodel->singleselect();
		$this->load->view('user',$data);
		if ($this->input->post("update"))
		{
			$this->Mainmodel->updatedetails($a,$this->input->post("id"));
			redirect('main/new','refresh');
		}

	}
	public function approvedetails()
	{
		$this->load->model('Mainmodel');
		$data['n']=$this->Mainmodel->approvedetails();
		$this->load->view('apprej',$data);
	}
	public function approve()
	{
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$this->Mainmodel->approve($id);
		redirect('main/approvedetails','refresh');
	}
	public function reject()
	{
		$this->load->model('Mainmodel');
		$id=$this->uri->segment(3);
		$this->Mainmodel->reject($id);
		redirect('main/approvedetails','refresh');
	}
		public function login()
	{	
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run())
		{
			$this->load->model('Mainmodel');
			$email=$this->input->post("email");
			$pass=$this->input->post("password");
			$rslt=$this->Mainmodel->selectpass($email,$pass);
			
				if ($rslt)
				 {
				 	$id=$this->mainmodel->getuserid($email);
				 	$user=$this->mainmodel->getuser($id);
				 	$this->load->library(array('session'));
				 	$this->session->set_userdata(array('id'=>(int)$user->id,'status'=>$user->status));
				 	if($_SESSION['status']=='1')
				 	{
				 		redirect(base_url().'main/index');
				 	}
				 	else
				 	{
				 		echo "waiting for approval";
				 	}
			     }
			     else
			     {
			     	echo "invalid user";
			     }
			 }
			 else
			 {
			 	redirect('main/login1','refresh');
			 }
}
}
