<?php
session_start();
class CandyStore extends CI_Controller {


	function __construct() {
    		// Call the Controller constructor
		parent::__construct();

		$config['upload_path'] = './images/product/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
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
		$this->load->view('product/index.php',$data);
	}

	function login() {
		$this->load->helper(array('form'));
		$this->load->view('templates/header.html');
		$this->load->view('templates/footer.html');
		$this->load->view('customer/loginForm.php');
	} 

	function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('cart');
		session_destroy();
		redirect('candystore/index', 'refresh');
	}

	function loginPost() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[16]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|xss_clean|callback_check_database');

		if ($this->input->post('username') == 'admin' &&  $this->input->post('password') == '123123') {
			$this->session->set_userdata('admin', 'true');
			redirect('candystore/adminpanel', 'refresh');
		}

		if($this->form_validation->run() == false) {
			$this->session->set_flashdata("login_error", "The username or password was incorrect");
			redirect('candystore/login', 'refresh');
		} else {
			redirect('candystore/index', 'refresh');
		}

	}

	function check_database($password) {
		$username = $this->input->post('username');

		$result = $this->customer_model->login($username, $password);

		if($result) {
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->login,
					'first' => $row->first,
					'last' => $row->last
					);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		} else {
			return false;
		}
	}

	function register() {
		$this->load->helper(array('form'));
		$this->load->view('templates/header.html');
		$this->load->view('templates/footer.html');
		$this->load->view('customer/registerForm.php');
	}

	function registerPost() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[16]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[45]|xss_clean');
		$this->form_validation->set_rules('first', 'First', 'trim|required|max_length[24]|xss_clean');
		$this->form_validation->set_rules('last', 'Last', 'trim|required|max_length[24]|xss_clean');


		if($this->form_validation->run() == FALSE) {
			$this->load->view('customer/registerForm');
		} else {
			$username = $this->input->post('username');
			if ($username == 'admin') {
				$this->session->set_flashdata("register_error", "The username cannot be admin");
				redirect('candystore/register', 'refresh');
			}
			$email = $this->input->post('email');
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->session->set_flashdata('register_error', 'Invalid email format');
				redirect('candystore/register', 'refresh');
			}

			$result = $this->customer_model->is_existing_email($email);
			if ($result == true) {
				$this->session->set_flashdata('register_error', 'Invalid email already exists');
				redirect('candystore/register', 'refresh');
			}
			$result = $this->customer_model->is_existing_username($username);
			if($result == true) {
				$this->session->set_flashdata('register_error', 'Invalid user already exists');
				redirect('candystore/register', 'refresh');
			}
			$this->load->model('customer');
			$new_customer = new Customer();
			$new_customer->first = $this->input->post('first');		    	
			$new_customer->last = $this->input->post('last');
			$new_customer->email = $this->input->post('email');
			$new_customer->username = $this->input->post('username');
			$new_customer->password = $this->input->post('password');

			$this->customer_model->insert($new_customer);
			redirect('candystore/login', 'refresh');
		}
	}

	function addToCart($product_id) {
		if($this->session->userdata('logged_in')) {
			$cart_items = $this->session->userdata('cart');
			if ($cart_items) {
				if (array_key_exists($product_id, $cart_items)) {
					$cart_items[$product_id] = $cart_items[$product_id] + 1;
				} else {
					$cart_items[$product_id] = 1;
				}
				$this->session->set_userdata('cart', $cart_items);
			} else {
				$cart_items = array($product_id => 1);
				$this->session->set_userdata('cart', $cart_items);
			}
		} else {
			redirect('candystore/login', 'refresh');
		}
	}

	function removeFromCart($product_id) {
		if($this->session->userdata('logged_in')) {
			$cart_items = $this->session->userdata('cart');
			if ($cart_items) {
				if (array_key_exists($product_id, $cart_items)) {
					unset($cart_items[$product_id]);
					$this->session->set_userdata('cart', $cart_items);
				}
			}
		}
	}

	function updateQuantity() {
		if($this->session->userdata('logged_in')) {
			$cart_items = $this->session->userdata('cart');
			if ($cart_items) {
				$product_id = $this->input->get_post('product_id');
				$quantity = $this->input->get_post('quantity');
				if (array_key_exists($product_id, $cart_items)) {
					$cart_items[$product_id] = $quantity;
					$this->session->set_userdata('cart', $cart_items);
				}
			}
		}
	}
	function cart() {
		if($this->session->userdata('logged_in')) {
			$this->load->model('product_model');
			$cart_items = $this->session->userdata('cart');
			$data['products']= array();
			if ($cart_items) {
				foreach ($cart_items as $item_id => $quantity) {
					$product = $this->product_model->get($item_id);
					$data['products'][] = $product;
				}
			} else {
				$data['empty_cart'] = true;
			}
			$this->load->view('templates/header.html');
			$this->load->view('templates/footer.html');
			$this->load->view('customer/cart.php', $data);
		} else {
			redirect('candystore/login', 'refresh');
		}
	}


	    //bellow can be used for admin panel code (adding products to inventory)

	function adminpanel() {
		if (!$this->session->userdata("admin")) {
			$this->session->set_flashdata("login_error", "Please login to use admin feature");
			redirect("candystore/login");
		}

		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products'] = $products;

		$this->load->model('customer');
		$customers = $this->customer_model->getAll();
		$data['customers'] = $customers; 

		$this->load->model('order_model');
		$this->load->model('order');
		$orders = $this->order_model->getAll();
		$data['orders'] = $orders; 

		$this->load->view('templates/header.html',$data);
		$this->load->view('templates/footer.html',$data);
		$this->load->view('admin/adminpanel.php',$data);
	}

	function newForm() {
		$this->load->view('templates/header.html');
		$this->load->view('templates/footer.html');
		$this->load->view('product/newForm.php');
	}

	function create() {
		if (!$this->session->userdata("admin")) {
			$this->session->set_flashdata("login_error", "Please login to use admin feature");
			redirect("candystore/login");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required|callback_check_price');

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
			if (!$fileUploadSuccess) {
				$this->session->set_flashdata("product_form_error", $this->upload->display_errors());
			}
			redirect("candystore/newForm", 'refresh');
		}	
	}

	function check_price($price) {
		$pattern = '/^[0-9]+(\.[0-9]{2})?$/';
		if (preg_match($pattern, $price) == '0') {
			$this->session->set_flashdata("product_form_error", "Invalid price format, try something like 5.99");
			return false;
		} else {
			return true;
		}
	}

	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}

	function editForm($id) {
		if (!$this->session->userdata("admin")) {
			$this->session->set_flashdata("login_error", "Please login to use admin feature");
			redirect("candystore/login");
		}
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		
		$this->load->view('templates/header.html',$data);
		$this->load->view('templates/footer.html',$data);
		$this->load->view('product/editForm.php',$data);
	}

	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required|callback_check_price');

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
		if (!$this->session->userdata("admin")) {
			$this->session->set_flashdata("login_error", "Please login to use admin feature");
			redirect("candystore/login");
		}
		if (!isset($id)) return;
		$type = $this->input->post('type');
		if ($type == 'product') {
			error_log("deleting product " . $id);
			$this->load->model('product_model');
			$this->product_model->delete($id);
		} elseif ($type == 'customer') {
			error_log("deleting customer " . $id);
			$this->customer_model->delete($id);
		} elseif ($type == 'order') {
			error_log("deleting order " . $id);
			$this->load->model('order_model');
			$this->order_model->delete($id);
		}
	}
}

