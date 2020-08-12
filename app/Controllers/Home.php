<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
class Home extends BaseController
{
	protected $session;
	
	public function __construct()
	{
		//helper(['form', 'url', 'functions', 'cookie', 'Site\site']);
		//\Config\Database::connect();
		$this->session	= \Config\Services::session();		
	}
	

	/*public function index()
	{		
		return redirect()->to('dashboard'); 				
	}*/

	public function dashboard()
	{
		if(!$this->session->get('isLoggedIn'))   
			return $this->response->redirect(site_url('home/login'));
					
		else{	
			$data = [];
			$db      = \Config\Database::connect();
			$builder = $db->table('customer');
			$query = $builder->get();
			$query = $query->getResult();
			$data['users'] = $query;
			//$session = \Config\Services::session();
			$data['u'] = $this->session->get('email');
			echo view('admin/main_content', $data);				
			return view('admin/index', $data);
		}
	}

	public function charts()
	{
		if(!$this->session->get('isLoggedIn'))   
			return $this->response->redirect(site_url('home/login'));
					
		else{	
			$data = [];
			$db      = \Config\Database::connect();
			$builder = $db->table('customer');
			$query = $builder->get();
			$query = $query->getResult();
			$data['users'] = $query;
			echo view('admin/main_content', $data);
			return view('admin/charts',$data);		
		}	
	}

	public function customer()
	{
		if(!$this->session->get('isLoggedIn'))   
			return $this->response->redirect(site_url('home/login'));
					
		else{	
			$data = [];
			$db      = \Config\Database::connect();
			$builder = $db->table('customer');
			$query = $builder->get();
			$query = $query->getResult();
			$data['users'] = $query;
			//$session = \Config\Services::session();
			$data['u'] = $this->session->get('email');
			echo view('admin/main_content', $data);
			return view('admin/tables',$data);
		}	
	}

	public function login()
	{
		
		return view('admin/login');
	}

	public function auth() 
	{	
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');	
		
		if ($this->exists($email, $password)!=NULL){
			//$session = \Config\Services::session();
			
			$user_data = [
				'email' 	=> $email,
				'isLoggedIn' => TRUE,
				'level'		=> 'admin'
			];
			$this->session->set($user_data);
			session()->set($user_data);
			return $this->response->redirect(site_url('home/dashboard'));
		}
		else {
			$data['msg'] = 'Email or password doesn\'t match';
			return view('admin/login', $data);
		}
				
	}

	public function exists($email, $password)
	{
		$db = \Config\Database::connect();	
		$builder = $db->table('user');
        $query   = $builder->getWhere(['email'=>$email, 'password'=>md5($password)]);
        $query   = $query->getResult();
        if($query)        			
			return true;                            	
		else 		
			return false;		
	}
	
	public function logout() 
	{		
		$this->session->remove('email');
		$this->session->remove('logged_in');
		$this->session->remove('level');
		$this->session->destroy();				
		return $this->response->redirect(site_url('home/login'));
	}

	//--------------------------------------------------------------------

}
