<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestPostLeadsModel;
use App\Models\UsersModel;
use App\Models\RoleModel;
use App\Models\ProjectsModel;
use function PHPSTORM_META\type;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("admin/dashboard");
    }
    public function add_user()
    {
        return view('admin/add-user');
    }
    public function users_registration()
    {
        $session = session();
        $UsersModel = new UsersModel();
        $email = $this->request->getVar('email');
        $existingUser = $UsersModel->where('email', $email)->first();
        if (!$existingUser) {
            helper(['form', 'url']);
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'password' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'role_id' => $this->request->getVar('role'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
                $UsersModel->insert($data);
                $session->setFlashdata('success_save', 'User added successfully');
                return redirect()->to(base_url() . 'admin/add-user');
            } else {
                $session->setFlashdata('error_save', 'Please enter valid details');
                return redirect()->to(base_url() . 'admin/add-user');
            }
        } else {
            $session->setFlashdata('error_save', 'user already exists');
            return redirect()->to(base_url() . 'admin/add-user');
        }
    }
    public function guest_posting_leads()
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();
        $all_projects = $ProjectsModel->select('*')->findAll();
        // print("<pre>" . print_r($all_projects, true) . "</pre>");
        // die('hi');

        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')->orderBy('guestpost_leads.id', 'desc')->paginate(20);
        // print_r($all_guestposts);
        // die('hi');


        $data = [
            'guest_posts' => $all_guestposts,
            'all_projects' => $all_projects,
            'pager' => $GuestPostLeadsModel->pager
        ];
        return view('admin/guestposts-leads', $data);
    }
    public function manage_users()
    {
        $session = session();
        $UsersModel = new UsersModel();
        $all_users = $UsersModel->select('users.id as user_id, users.name as username ,users.phone, users.email, role.id as role_id, role.name as role')
            ->join('role', 'role.id = users.role_id')->orderBy('users.id', 'desc')->paginate(20);
        $data = [
            'Users' => $all_users,
            'pager' => $UsersModel->pager
        ];
        return view('admin/manage-users', $data);
    }
    public function edit_users($id)
    {
        $UsersModel = new UsersModel();
        $user_data = $UsersModel->select('users.id as user_id, users.name as username ,users.phone, users.email, role.id as role_id, role.name as role')
            ->join('role', 'role.id = users.role_id')->where('users.id', $id)->first();
        $data = [
            'Users' => $user_data,
        ];
        // print_r($data);
        // die('hi');
        return view('admin/edit-users', $data);
    }
    public function update_user()
    {
        $session = session();
        $UsersModel = new UsersModel();
        $id = $this->request->getVar('id');
        helper(['form', 'url']);
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
        ];
        if ($this->validate($rules)) {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'phone' => $this->request->getVar('phone'),
                'role_id' => $this->request->getVar('role_id'),
            ];
            // print_r($data);
            // die('hi');
            $UsersModel->update($id, $data);
            $session->setFlashdata('success_save', 'updated succesfully');
            return redirect()->back();
        } else {
            $session->setFlashdata('error_save', 'Please enter valid details');
            return redirect()->back();
        }
    }
    public function approve_payment($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $payment_status = 1;
        $data = [
            'payment_approvel' => $payment_status,
        ];
        $GuestPostLeadsModel->update($id, $data);
        return redirect()->back();
    }
    public function edit_guestpost($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username')->where('guestpost_leads.id', $id)->join('users', 'users.id = guestpost_leads.user_id')->orderBy('guestpost_leads.id', 'desc')->first();
        // print_r($all_guestposts);
        // die('hi');
        $data = [
            'guest_posts' => $all_guestposts
        ];
        return view('admin/edit-guestpost', $data);
    }
    public function update_guestpost()
    {
        $session = session();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        helper(['form', 'url']);
        $id = $this->request->getVar('id');
        $reference_number = $this->request->getVar('reference_number');
        if (!$reference_number) {
            $rules = [
                'amount' => 'required',
                'paymentStatus' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'amount' => $this->request->getVar('amount'),
                    'currency' => $this->request->getVar('currency'),
                    'reference_number' => $this->request->getVar('reference_number'),
                    'payment_mode' => $this->request->getVar('paymentmode'),
                    'payment_status' => $this->request->getVar('paymentStatus'),
                ];
                // echo gettype($reference_number);
                // print("<pre>" . print_r($reference_number, true) . "</pre>");
                // die('hi');
                // $existing_reference_number = $GuestPostLeadsModel->where('reference_number', $reference_number)->first();
                $GuestPostLeadsModel->update($id, $data);
                $session->setFlashdata('success_save', 'Updated successfully');
                return redirect()->back();
            }
        } else {
            helper(['form', 'url']);
            $rules = [
                'amount' => 'required',
                'paymentStatus' => 'required',
            ];
            if ($this->validate($rules)) {
                $reference_number = $this->request->getVar('reference_number');
                // print_r($reference_number);
                // die('111');
                $existing_reference_number = $GuestPostLeadsModel->where('reference_number', $reference_number)->first();
                $data = [
                    'amount' => $this->request->getVar('amount'),
                    'currency' => $this->request->getVar('currency'),
                    'reference_number' => $this->request->getVar('reference_number'),
                    'payment_mode' => $this->request->getVar('paymentmode'),
                    'payment_status' => $this->request->getVar('paymentStatus'),
                ];
                // echo gettype($reference_number);
                // print("<pre>" . print_r($data, true) . "</pre>");
                // die('hi');
                if (!$existing_reference_number) {
                    $GuestPostLeadsModel->update($id, $data);
                    $session->setFlashdata('success_save', 'Updated successfully');
                    return redirect()->back();
                } else {
                    $session->setFlashdata('error_save', 'This reference number is already exists');
                    return  redirect()->back();
                }
            } else {
                $session->setFlashdata('error_save', 'Please enter valid details');
                return  redirect()->back();
            }
        }
    }

    public function project()
    {
        return view('admin/add-project');
    }
    public function add_project()
    {
        $session = session();
        $ProductsModel = new ProjectsModel();
        // print_r($session->get('name'));
        // die('hi');
        helper(['form', 'url']);
        $prjoect_name = $this->request->getVar('name');

        $existing_project_name = $ProductsModel->where('name', $prjoect_name)->first();
        if (!$existing_project_name) {

            $rules = [
                'name' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $prjoect_name,
                    'user_id' => $session->get('id'),
                ];

                $ProductsModel->insert($data);
                $session->setFlashdata('success_save', 'Product added successfully');
                return redirect()->back();
            }
        }
        $session->setFlashdata('error_save', 'Duplicate product');
        return redirect()->back();
    }

    public function all_projects()
    {
        $ProductsModel = new ProjectsModel();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $leads_count = $GuestPostLeadsModel->select('guestpost_leads.id', 'COUNT(guestpost_leads.id)')->findAll();


        // print_r($project_count['projects_count']);
        // print("<pre>" . print_r($leads_count, true) . "</pre>");
        // die('hi');
        $all_projects =  $ProductsModel->select('projects.id, projects.name as project_name,projects.user_id,projects.created_at,projects.updated_at,users.name as user_name')
            ->join('users', 'users.id = projects.user_id', 'left')
            ->orderBy('projects.id', 'desc')
            ->paginate(20);

        // foreach ($all_projects as $project) :

        //     $leads_count = $GuestPostLeadsModel->select('guestpost_leads.id, COUNT(guestpost_leads.id) as guestpost_leads_count')->where('guestpost_leads.project_id', $project['id'])->findAll();




        // endforeach;
        // print("<pre>" . print_r($leads_count, true) . "</pre>");
        // die('hi');
        $data = [
            'all_projects' => $all_projects,
            'pager' => $ProductsModel->pager,
            'projects_count' => $leads_count
        ];

        return view('admin/all-projects', $data);
    }
    // 
    public function edit_project($id)
    {
        $session = session();
        $ProjectsModel = new ProjectsModel();
        $project_data = $ProjectsModel->select('projects.id , projects.name')->where('projects.id', $id)->first();
        $data = [
            'project_detail' => $project_data,
        ];
        // print_r($data);
        // die('hi');
        return view('admin/edit-project', $data);
    }

    public function update_project()
    {
        $session = session();
        $ProjectsModel = new ProjectsModel();
        helper(['form', 'url']);
        $id = $this->request->getVar('id');

        $data = [
            'name' => $this->request->getVar('name'),
        ];
        // print_r($data);
        // die('hi');
        $ProjectsModel->update($id, $data);

        $session->setFlashdata('success_save', 'Product updated successfully');
        return redirect()->back();
    }

    public function view_project_leads($id)
    {

        $ProjectsModel = new ProjectsModel();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $UsersModel = new UsersModel();

        $project_leads = $ProjectsModel->select('guestpost_leads.id as guestpost_id,guestpost_leads.id as guestpost_id, guestpost_leads.user_id, guestpost_leads.role_id, guestpost_leads.project_id, guestpost_leads.link, guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_mode, guestpost_leads.payment_status,guestpost_leads.payment_approvel,guestpost_leads.payment_approvel,guestpost_leads.reference_number,guestpost_leads.created_at ,guestpost_leads.updated_at,users.name as user_name')
            ->join('guestpost_leads', 'guestpost_leads.id = projects.id')
            ->join('users', 'users.id = projects.id')
            ->where('projects.id', $id)->paginate(20);

        $data = [
            'projects_leads' => $project_leads,
            'pager' => $ProjectsModel->pager
        ];
        return view('admin/view-project-leads', $data);
    }
    public function guestpost_leads_date_range()
    {
        // die('hi');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        // $ProjectsModel = new ProjectsModel();
        // $all_projects = $ProjectsModel->select('*')->findAll();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // $data = $GuestPostLeadsModel = new GuestPostLeadsModel();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->where('DATE(guestpost_leads.created_at) >=', $startDate)
            ->where('DATE(guestpost_leads.created_at) <=', $endDate)->orderBy('guestpost_leads.id', 'desc')->findAll();

        $response = [
            'status' => 'success',
            'message' => 'Sale dates received successfully.',
            'data' => $all_guestposts
        ];

        return $this->response->setJSON($response);
    }
}
