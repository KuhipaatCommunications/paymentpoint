<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Role extends CI_Controller
{
	public function __construct()
	{
            parent::__construct();
            $this->controller = 'Role';
            $this->load->model('admin/role_model', 'Role');
            $this->load->model('common_methods', 'Common');
            $this->load->theme('admintheme');
            $this->load->helper('auth');
            $this->load->library('form_validation');
            isAccessPermit();
	}
	//////////function to load user list////////////
	public function index()
	{
            if(!isAdminLoggedIn())
            { 
                redirect("admin/login");
            }
            $keyword = $this->input->get('search_keyword');
            $data["site_title"] = 'Role Management';
            $data["menu_title"] = 'Role Management';

            if ($this->uri->segment(4) === FALSE)
            {
                $offset = 0;
            }
            else
            {
                $offset = $this->uri->segment(4);
            }
            $limit=ADMIN_PER_PAGE;

            $config['total_rows'] = $this->Role->countAllRole($keyword);
            $config['per_page'] = $limit;
            $config['num_links'] = 3;
            $config['cur_tag_open'] = '<span class="current">';
            $config['cur_tag_close'] = '</span>';
            $config['uri_segment'] = 4;
            $config['suffix'] = '';
            if($keyword)
                $config['suffix'] .= '?search_keyword=' .$keyword;
            $this->pagination->initialize($config);
            $paginator=$this->pagination->create_links();
            $data['pagination'] = $paginator;
            $data['keyword'] = $keyword;
            // $fielter_checkbox = $this->input->post('filter_by_checkbox');
            // $data['filter_field'] = $fielter_checkbox;

            $data["role"] = $this->Role->getAllRole($keyword,$limit,$offset);
            $this->load->view('role/index', $data);
	}
        /////////add role////////////
	public function add()
	{   
            if(!isAdminLoggedIn())
            {
                redirect("admin/login");
            }
            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('role','role','trim|required|is_unique[user_roles.role]');
                $this->form_validation->set_rules('access[]','access','trim|required');
               
                if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
                {
                    $role=$this->input->post('role', true);
                    $access=$this->input->post('access', true);
                    //echo '<pre>';print_r($access);exit;
                    $data = array(
                        'role' => $role,
                        'created_on' => date('Y-m-d H:i:s')
                    );

                    $last_insert_id = $this->Common->getandinsertRecord('user_roles',$data);

                    if(!empty($access))
                    {
                        for($i=0; $i<count($access); $i++)
                        {
                            $page= explode('/', $access[$i]);
                            $data=array('role_id'=>$last_insert_id, 'controller'=>$page[0], 'method'=>$access[$i]);
                            $this->Common->insertRecord('role_access', $data);
                        }
                    }
                    $this->session->set_flashdata('success_msg', 'Role added successfully.');
                    //echo $user_message;die();
                    redirect("admin/role");
                }
            }
            $data['access_pages']=$this->Role->getAllControllerMethod();
            $data["site_title"] = 'Add Role';
            $data["menu_title"] = 'Add Role';
            $this->load->view('role/add', $data);
	}

	///////////function to update Role data/////////////
	public function edit($role_id)
	{
            if(!isAdminLoggedIn())
            {
                redirect("admin/login");
            }
            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('role','role','trim|required');
                $this->form_validation->set_rules('access[]','access','trim|required');
               
                if($this->form_validation->run()!= FALSE)///////if form input fields are valid////////
                {
                    $role_id=$this->input->post('role_id', true);
                    $role=$this->input->post('role', true);
                    $access=$this->input->post('access', true);
                    //echo '<pre>';print_r($access);exit;
                    $data = array(
                        'role' => $role,
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                    $this->Common->updateRecords('user_roles', array('id'=>$role_id), $data);

                    if(!empty($access))
                    {
                        $this->Common->deleteRecords('role_access', array('role_id'=>$role_id));
                        for($i=0; $i<count($access); $i++)
                        {
                            $page= explode('/', $access[$i]);
                            $data=array('role_id'=>$role_id, 'controller'=>$page[0], 'method'=>$access[$i]);
                            $this->Common->insertRecord('role_access', $data);
                        }
                    }
                    $this->session->set_flashdata('success_msg', 'Role updated successfully.');
                    //echo $user_message;die();
                    redirect("admin/role");
                }
            }
            $data['access_pages']=$this->Role->getAllControllerMethod();
            $data['controller']=array();
            $data['method']=array();
            $data['role']=$this->Common->getSingle('user_roles', '', array('id'=>$role_id));
            $role_access=$this->Role->getAccessByRoleId($role_id);
            if($role_access && !empty($role_access))
            {
                foreach($role_access as $row)
                {
                    $data['controller'][]=$row['controller'];
                    $data['method'][]=$row['method'];
                }
            }
            $data["site_title"] = 'Edit Role';
            $data["menu_title"] = 'Edit Role';
            $this->load->view('role/edit', $data);
        }
    
	//////function to delete single question///////////  */
	public function delete($id)
	{
            if(!isAdminLoggedIn()) 
            {
                redirect("admin/login");
            }
            else
            {       
                $this->Common->deleteRecords('role_access', array('role_id'=>$id));
                $this->Common->deleteRecords('user_roles', array('id'=>$id));
                $this->session->set_flashdata('success_msg', 'Role deleted successfully.');
                redirect("admin/role");
            }
	}
    
} // exit of ci	