<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['form_validation']);
		$this->load->model('Users_model');

	}


	public function index ()
    {

        if(isset($_SESSION['user'])){
            redirect(base_url('index.php/dashboard'));
        }

        if (isset($_POST['login_btn'])) {
            $email= $this->input->post('user_email');
            $pw= $this->input->post('user_password');

            $user_data=$this->Users_model->authenticate($email,$pw);

            if($user_data!==0){

                $user_info = [
                    'user_id'=>$user_data[0]->id,
                    'fullname'=>$user_data[0]->fullname,
                ];

                $this->session->set_userdata('user',$user_info);
                redirect('dashboard');

            }else{

                $this->session->set_flashdata('msg_login','Invalid Password. Please try again.');
            }
    
        }

        $this->load->view('backend/pages/login');
    }


	public function dashboard()
	{
		if(!isset($_SESSION['user'])){
			$this->session->set_flashdata('msg_login', 'Please Login');
			redirect(base_url('index.php/admin'));
		}
		$this->load->view('backend/include/header');
		$this->load->view('backend/include/nav');
		$this->load->view('backend/pages/dashboard');
		$this->load->view('backend/include/footer');
		
	}

	
	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url('index.php/admin'));
	}

	
    public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $resident_data = [
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                
            ];


            $insert = $this->db->insert('resident',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-resident'));
            }


        }
        


    }

	public function viewresident(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $resident_list = $this->db->get('resident')->result();

        $data = ['resident_list'=>$resident_list];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/viewresident',$data);
        $this->load->view('backend/include/footer');
    }

  /*  public function delete($resident_id) {
        $this->load->model('Users_model');
        if ($this->Users_model->delete_user($resident_id)) {
            redirect(base_url('index.php/dashboard/view-resident')); // Redirect to user list page or any other page
        } else {
            echo 'Failed to delete the user.';
        }
    }*/

    public function deleteresident($id){
        $this->db->db_debug = TRUE;
        $this->db->where('resident_id', $id);
        $this->db->delete('resident');
        redirect(base_url('index.php/dashboard/view-resident'));
    }

  
    public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateresident', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data
            $resident_data = [
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
            ];
    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-resident'));
            }
        }

    }

   /* public function adminuser(){
    
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email','Email Address','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('confirmpass','Confirm Password','trim|required|min_length[2]|max_length[50]');
     
        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/pages/adminuser');
           
        }else{

            $resident_data = [
                'firstname'=>$this->input->post('firstname',TRUE),
                'lastname'=>$this->input->post('lastname',TRUE),
                'email'=>$this->input->post('email',TRUE),
                'password'=>$this->input->post('password',TRUE),
                'confirmpass'=>$this->input->post('confirmpass',TRUE),               
            ];


            $insert = $this->db->insert('admintable',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                echo "Registration Successful             ";
            }


        }
        
     
    }*/
    public function adminuser()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'trim|required|min_length[2]|max_length[50]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/pages/adminuser');
        } else {
            $resident_data = [
                'firstname' => $this->input->post('firstname', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'confirmpass' => $this->input->post('confirmpass', TRUE),
            ];
    
            // JavaScript code for the confirmation dialog
            $jsCode = "
                <script>
                    var confirmRegistration = confirm('Do you want to proceed with registration?');
                    if (confirmRegistration) {
                        document.getElementById('registrationForm').submit();
                    } else {
                        // Handle cancellation or do nothing
                    }
                </script>
            ";
    
            $insert = $this->db->insert('admintable', $resident_data);
    
            if ($insert) {
                echo $jsCode; // Output the JavaScript code for the confirmation dialog
            }
        }
    }
    public function viewofficials(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $officials_list = $this->db->get('addofficials')->result();

        $data = ['officials_list'=>$officials_list];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/viewofficials',$data);
        $this->load->view('backend/include/footer');
    }
    public function addofficials(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $this->form_validation->set_rules('position','Position','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('start_term','start term','trim|required');
        $this->form_validation->set_rules('end_term','end term','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addofficials');
            $this->load->view('backend/include/footer');

        }else{

            $officials_data = [
                'position'=>$this->input->post('position',TRUE),
                'name'=>$this->input->post('name',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'address'=>$this->input->post('address',TRUE),
                'start_term'=>$this->input->post('start_term',TRUE),
                'end_term'=>$this->input->post('end_term',TRUE),
                
            ];


            $insert = $this->db->insert('addofficials',$officials_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-officials'));
            }


        }
        


    }

    public function updateofficials($id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
        $this->form_validation->set_rules('position','Position','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('start_term','start term','trim|required');
        $this->form_validation->set_rules('end_term','end term','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $officials_data = $this->db->get_where('addofficials', array('id' => $id))->row();
    
            $data = [
                'officials_data' => $officials_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateofficials', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data
            $officials_data = [
                'position'=>$this->input->post('position',TRUE),
                'name'=>$this->input->post('name',TRUE),
                'sex'=>$this->input->post('name',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'address'=>$this->input->post('address',TRUE),
                'start_term'=>$this->input->post('start_term',TRUE),
                'end_term'=>$this->input->post('end_term',TRUE),
        
            ];
            $this->db->where('id', $id);
            $update = $this->db->update('addofficials', $officials_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-officials'));
            }
        }

    }
    public function deleteofficials($id){
        $this->db->db_debug = TRUE;
        $this->db->where('id', $id);
        $this->db->delete('addofficials');
        redirect(base_url('index.php/dashboard/view-officials'));
    }

    /* AJAX  */
    public function ajax_update_official_form(){

        $official_id = $this->input->post('official_id',true);

        $officials_data  =  $this->db->where('id',$official_id)->get('addofficials')->row();
        
        $data = ['officials_data'=>$officials_data];

        $this->load->view('backend/pages/popup/edit-official',$data);
    }

}