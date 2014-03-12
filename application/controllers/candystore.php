<?php
session_start();
class CandyStore extends CI_Controller {


	function __construct() {
    		// Call the Controller constructor
		parent::__construct();


		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
    	$this->load->library('upload', $config);
    	$this->load->model('customer_model');
	    	
	}

	    function index() {
	    	$this->load->model('product_model');
	    	$products = $this->product_model->getAll();
	    	$data['products']=$products;

	    	if($this->session->userdata('logged_in')) {
	    		$session_data = $this->session->userdata('logged_in');
	    		$data['username'] = $session_data['username'];
	    	}

	    	$this->load->view('templates/header.html',$data);
	    	$this->load->view('templates/footer.html',$data);
	    	print_r($this->session->userdata('cart'));
	    	$this->load->view('product/index.php',$data);
	    }

	    function login() {
	    	$this->load->helper(array('form'));
	    	$this->load->view('templates/header.html');
	    	$this->load->view('templates/footer.html');
	    	$this->load->view('customer/loginForm.php');
	    } 

	    function newForm() {
	    	$this->load->view('templates/header.html');
	    	$this->load->view('templates/footer.html');
	    	$this->load->view('product/newForm.php');
	    }

	    function logout() {
	    	$this->session->unset_userdata('logged_in');
	    	$this->session->unset_userdata('cart');
	    	session_destroy();
	    	redirect('candystore/index', 'refresh');
	    }

	    function login_post() {
	    	$this->load->library('form_validation');

	    	$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[16]|xss_clean');
	    	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|xss_clean|callback_check_database');

	    	if($this->form_validation->run() == false)
	    	{
	    		redirect('candystore/login', 'refresh');
	    	}
	    	else
	    	{
	    		redirect('candystore/index', 'refresh');
	    	}

	    }

	    function check_database($password) {
	    	$username = $this->input->post('username');

	    	$result = $this->customer_model->login($username, $password);

	    	if($result)
	    	{
	    		$sess_array = array();
	    		foreach($result as $row)
	    		{
	    			$sess_array = array(
	    				'id' => $row->id,
	    				'username' => $row->login
	    				);
	    			$this->session->set_userdata('logged_in', $sess_array);
	    		}
	    		return true;
	    	}
	    	else
	    	{
	    		$this->form_validation->set_message('check_database', 'Invalid username or password');
	    		return false;
	    	}
	    }

	    function register() {
	    	$this->load->helper(array('form'));
	    	$this->load->view('templates/header.html');
	    	$this->load->view('templates/footer.html');
	    	$this->load->view('customer/registerForm.php');
	    }

	    function register_post() {
	    	$this->load->library('form_validation');

	    	$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[16]|xss_clean');
	    	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|xss_clean');
	    	$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[45]|xss_clean');
	    	$this->form_validation->set_rules('first', 'First', 'trim|required|max_length[24]|xss_clean');
	    	$this->form_validation->set_rules('last', 'Last', 'trim|required|max_length[24]|xss_clean');
	    	

	    	if($this->form_validation->run() == FALSE)
	    	{
	    		$this->load->view('customer/registerForm');
	    	}
	    	else
	    	{
		    	$username = $this->input->post('username');
		    	$email = $this->input->post('email');

		    	$result = $this->customer_model->is_existing_email($email);
		    	if ($result == true) {
		    		$this->form_validation->set_message('register_post', 'Invalid username already exists');
		    		$this->load->view('customer/registerForm');
		    	}
		    	$result = $this->customer_model->is_existing_username($username);
		    	if($result == true) {
		    		$this->form_validation->set_message('register_post', 'Invalid email already exists');
		    		$this->load->view('customer/registerForm');
		    	}
		    	$this->load->model('customer');
		    	$new_customer = new Customer();
		    	$new_customer->first = $this->input->get_post('first');		    	
		    	$new_customer->last = $this->input->get_post('last');
		    	$new_customer->email = $this->input->get_post('email');
		    	$new_customer->username = $this->input->get_post('username');
		    	$new_customer->password = $this->input->get_post('password');

		    	$this->customer_model->insert($new_customer);

	    		redirect('candystore/login', 'refresh');
	    	}
	    }

	    function addToCart($product_id) {
	    	if($this->session->userdata('logged_in')) {
		    	$this->load->model('product_model');
		    	$product = $this->product_model->get($product_id);
		    	$data['product']=$product;

		    	$cart_items = $this->session->userdata('cart');
		    	if ($cart_items) {
		    		if (array_key_exists($product_id, $cart_items)) {
		    			$cart_items[$product_id] = $cart_items[$product_id] + 1;
		    		} else {
		    			$cart_items[$product_id] = 1;
		    		}
		    		$this->session->set_userdata('cart', $cart_items);
		    	} else {
		    		$cart_items = array($product_id => 0);
		    		$this->session->set_userdata('cart', $cart_items);
		    	}
	    	} else {
	    		redirect('candystore/login', 'refresh');
	    	}
	    }

	    function cart() {
	    	if($this->session->userdata('logged_in')) {
	    		$this->load->model('product_model');
	    		$cart_items = $this->session->userdata('cart');
	    		$data['products']= array();
				foreach ($cart_items as $item_id => $quantity) {
					$product = $this->product_model->get($item_id);
					$data['products'][] = $product;
				}
	    		$this->load->view('templates/header.html');
	    		$this->load->view('templates/footer.html');
	    		$this->load->view('customer/cart.php', $data);
	    	} else {
	    		redirect('candystore/login', refresh);
	    	}
	    }

	    function create() {
	    	$this->load->library('form_validation');
	    	$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
	    	$this->form_validation->set_rules('description','Description','required');
	    	$this->form_validation->set_rules('price','Price','required');

	    	$fileUploadSuccess = $this->upload->do_upload();

	    	if ($this->form_validation->run() == true && $fileUploadSuccess) {
	    		$this->load->model('product_model');

	    		$product = new Product();
	    		$product->name = $this->input->get_post('name');
	    		$product->description = $this->input->get_post('description');
	    		$product->price = $this->input->get_post('price');

	    		$data = $this->upload->data();
	    		$product->photo_url = $data['file_name'];

	    		$this->product_model->insert($product);

	    		redirect('candystore/index', 'refresh');
	    	}
	    	else {
	    		if ( !$fileUploadSuccess) {
	    			$data['fileerror'] = $this->upload->display_errors();
	    			$this->load->view('product/newForm.php',$data);
	    			return;
	    		}

	    		$this->load->view('product/newForm.php');
	    	}	
	    }

	    function read($id) {
	    	$this->load->model('product_model');
	    	$product = $this->product_model->get($id);
	    	$data['product']=$product;
	    	$this->load->view('product/read.php',$data);
	    }

	    function editForm($id) {
	    	$this->load->model('product_model');
	    	$product = $this->product_model->get($id);
	    	$data['product']=$product;
	    	$this->load->view('product/editForm.php',$data);
	    }

	    function update($id) {
	    	$this->load->library('form_validation');
	    	$this->form_validation->set_rules('name','Name','required');
	    	$this->form_validation->set_rules('description','Description','required');
	    	$this->form_validation->set_rules('price','Price','required');

	    	if ($this->form_validation->run() == true) {
	    		$product = new Product();
	    		$product->id = $id;
	    		$product->name = $this->input->get_post('name');
	    		$product->description = $this->input->get_post('description');
	    		$product->price = $this->input->get_post('price');

	    		$this->load->model('product_model');
	    		$this->product_model->update($product);

	    		redirect('candystore/index', 'refresh');
	    	}
	    	else {
	    		$product = new Product();
	    		$product->id = $id;
	    		$product->name = set_value('name');
	    		$product->description = set_value('description');
	    		$product->price = set_value('price');
	    		$data['product']=$product;
	    		$this->load->view('product/editForm.php',$data);
	    	}
	    }

	    function delete($id) {
	    	$this->load->model('product_model');

	    	if (isset($id)) 
	    		$this->product_model->delete($id);

	    	redirect('candystore/index', 'refresh');
	    }





	}

