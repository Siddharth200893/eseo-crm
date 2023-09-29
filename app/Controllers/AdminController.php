<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestPostLeadsModel;
use App\Models\UsersModel;
use App\Models\RoleModel;
use App\Models\ProjectsModel;
use App\Models\PaymentModeModel;
use App\Models\CurrenciesModel;
use function PHPSTORM_META\type;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "Admin") {
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
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_projects = $ProjectsModel->select('*')->findAll();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_Currencies = $CurrenciesModel->select('*')->findAll();
        $blogger_names = $GuestPostLeadsModel->select('blogger_name')
            ->groupBy('blogger_name')
            ->findAll();
        // print("<pre>" . print_r($blogger_names, true) . "</pre>");
        // die();
        $currentDate = date('Y-m-d');
        $firstDayOfMonth = date('Y-m-01', strtotime($currentDate));
        $lastDayOfMonth = date('Y-m-t', strtotime($currentDate));
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id,guestpost_leads.updated_at ,guestpost_leads.blogger_name,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.is_flag,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name,currencies.name as currency_name,payment_modes.name as payment_mode,guestpost_leads.payee_email,guestpost_leads.payee_number')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->where('DATE(guestpost_leads.created_at) >=', $firstDayOfMonth)
            ->where('DATE(guestpost_leads.created_at) <=', $lastDayOfMonth)
            ->orderBy('guestpost_leads.id', 'desc')->paginate(20);
        // print_r($all_guestposts);
        // die('hi');
        $data = [
            'guest_posts' => $all_guestposts,
            'all_projects' => $all_projects,
            'all_payment_modes' => $all_payment_modes,
            'all_Currencies' => $all_Currencies,
            'blogger_names' => $blogger_names,
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
            ->join('role', 'role.id = users.role_id')->where('md5(users.id)', $id)->first();
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
                'updated_at' => date('Y-m-d H:s:a'),
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
        $agent_email = $GuestPostLeadsModel->select('*')->where('id', $id)->first();
        // print_r($agent_email['agent_email']);
        // die('hi');
        $payment_status = 1;
        $data = [
            'payment_approvel' => $payment_status,
        ];
        $approved =  $GuestPostLeadsModel->update($id, $data);
        // print_r($approved);
        // die('hi');
        if ($approved) {
            // die(1);
            $to = $agent_email['agent_email'];
            // print_r($to);
            // die('hi');
            $message = "Your guest post has been approved guest post link is " . $agent_email['link'] . "Thank You!";
            // print_r($message);
            // die('hi');
            $email = \Config\Services::email();
            $email->setFrom('rohit.xportssoft@gmail.com', 'sidd');
            $email->setTo($to);
            $email->setSubject('this is subject');
            $email->setMessage($message); //your message here
            // $email->setCC('another@emailHere'); //CC
            // $email->setBCC('thirdEmail@emialHere'); // and BCC
            // $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
            // $email->attach($filename);
            $sent = $email->send();
            // echo $sent;
            // die('hi');
            // $email->printDebugger(['headers']);
        }
        return redirect()->back();
    }
    public function edit_guestpost($id)
    {
        // print_r($id);
        // die('hi');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_currencies = $CurrenciesModel->select('*')->findAll();



        // $project = $ProjectsModel->select('*')->where('id', $id)->first();
        $projects = $ProjectsModel->select('*')->findAll();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id as guestpost_id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username, projects.id as project_id, projects.name as project_name,currencies.id as currency_id,currencies.name as currency_name,payment_modes.name as payment_mode,guestpost_leads.payee_number')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.Project_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->where('md5(guestpost_leads.id)', $id)->orderBy('guestpost_leads.id', 'desc')->first();



        $guestpost_currency_id = $all_guestposts['currency_id'];
        $selected_currency = $CurrenciesModel->select('*')->where('id', $guestpost_currency_id)->first();

        $currency_payment_modes = $PaymentModeModel->select('*')->where('currency_id', $guestpost_currency_id)->findAll();

        // print("<pre>" . print_r($selected_currency['name'], true) . "</pre>");
        // die('hii');

        // print_r($all_guestposts);
        // die('hi');
        $data = [
            'guest_posts' => $all_guestposts,
            'projects' => $projects,
            'all_payment_modes' => $all_payment_modes,
            'all_currencies' => $all_currencies,
            'currency_payment_modes' => $currency_payment_modes,
            'selected_currency' => $selected_currency,
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
        $payee_email = $this->request->getVar('payee_email');
        $existing_payment_status = $GuestPostLeadsModel->select('payment_status')->where('id', $id)->first();
        $existing_reference_number = $GuestPostLeadsModel->select('reference_number')->where('reference_number', $reference_number)->first();

        if ($existing_payment_status['payment_status'] == 0 && (!empty($reference_number)) || !empty($payee_email)) { //we need atlist one from ref no. or payee email for proceed further

            if (!$existing_reference_number) {
                $rules = [
                    'amount' => 'required',
                    'paymentStatus' => 'required',
                ];
                if ($this->validate($rules)) {
                    $data = [
                        'project_id' => $this->request->getVar('projectName'),
                        'amount' => $this->request->getVar('amount'),
                        'currency_id' => $this->request->getVar('currency'),
                        'payment_mode_id' => $this->request->getVar('paymentmode'),
                        'payment_status' => $this->request->getVar('paymentStatus'),
                        'reference_number' => $this->request->getVar('reference_number'),
                        'payee_email' => $this->request->getVar('payee_email'),
                        'payee_number' => $this->request->getVar('payee_number'),
                        'updated_at' => date('Y-m-d H:s:a'),
                    ];
                    $GuestPostLeadsModel->update($id, $data);
                    $session->setFlashdata('success_save', 'Updated successfully');
                    $session->set('some_name', $id);
                    return redirect()->to(base_url() . 'admin/guest-posting-leads');
                }
            } else {
                $session->setFlashdata('error_save', 'This reference number is already exists');
                return  redirect()->back();
            }
        } else if ($existing_payment_status['payment_status'] == 1 || empty($reference_number)) {
            $data = [
                'amount' => $this->request->getVar('amount'),

            ];
            $GuestPostLeadsModel->update($id, $data);
            $session->set('some_name', $id);
            $session->setFlashdata('success_save', 'Updated successfully');
            return redirect()->to(base_url() . 'admin/guest-posting-leads');
        } else {
            $session->setFlashdata('error_save', 'Payment status is pending..');
            return  redirect()->back();
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
        $all_projects =  $ProductsModel->select('projects.id, projects.name as project_name,projects.user_id,projects.created_at,projects.updated_at,users.name as user_name')
            ->join('users', 'users.id = projects.user_id', 'left')
            ->orderBy('projects.id', 'desc')
            ->paginate(20);
        $data = [
            'all_projects' => $all_projects,
            'pager' => $ProductsModel->pager,
        ];
        return view('admin/all-projects', $data);
    }
    // 
    public function edit_project($id)
    {
        $session = session();
        $ProjectsModel = new ProjectsModel();
        $project_data = $ProjectsModel->select('projects.id , projects.name')->where('md5(projects.id)', $id)->first();
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
            'updated_at' => date('Y-m-d H:s:a'),
        ];
        // print_r($data);
        // die('hi');
        $ProjectsModel->update($id, $data);
        $session->setFlashdata('success_save', 'Product updated successfully');
        return redirect()->back();
    }
    public function view_project_leads($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $project_leads = $GuestPostLeadsModel->select('guestpost_leads.id as guestpost_id,guestpost_leads.id as guestpost_id, guestpost_leads.user_id, guestpost_leads.role_id, guestpost_leads.project_id, guestpost_leads.link, guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id, guestpost_leads.payment_status,guestpost_leads.payment_approvel,guestpost_leads.payment_approvel,guestpost_leads.reference_number,guestpost_leads.created_at ,guestpost_leads.updated_at,users.name as user_name,currencies.name as currency_name,payment_modes.name as payment_mode')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->where('md5(guestpost_leads.project_id)', $id)->paginate(20);
        $data = [
            'projects_leads' => $project_leads,
            'pager' => $GuestPostLeadsModel->pager
        ];
        return view('admin/view-project-leads', $data);
    }
    public function guestpost_leads_date_range()
    {
        // die('hi');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_projects = $ProjectsModel->select('*')->findAll();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_Currencies = $CurrenciesModel->select('*')->findAll();
        $blogger_names = $GuestPostLeadsModel->select('blogger_name')
            ->groupBy('blogger_name')
            ->findAll();
        if ($this->request->isAJAX()) {
            $startDate = $this->request->getGet('start_date');
            $startDate = $this->request->getGet('start_date');
            $endDate = $this->request->getGet('end_date');
            $pmt_mode = $this->request->getGet('paymentModeFilter');
            $currency = $this->request->getGet('currencyFilter');
            $project = $this->request->getGet('projectFilter');
            $pmt_status = $this->request->getGet('paymentFilter');
            $blogger = $this->request->getGet('bloggerFilter');
            $invoice_options = $this->request->getGet('invoice_options');
            $urgent_flag = $this->request->getGet('urgent_flag');
            // $integer = intval($pmt_status);
            // Convert start and end dates from milliseconds to seconds
            date_default_timezone_set("Asia/Kolkata");
            $startTimestamp = $startDate / 1000; // Convert milliseconds to seconds
            $start_date = date("Y-m-d H:i:s", $startTimestamp);
            $endTimestamp = $endDate / 1000; // Convert milliseconds to seconds
            $end_date = date("Y-m-d H:i:s", $endTimestamp);
            $GuestPostLeadsModel = new GuestPostLeadsModel();
            $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id, guestpost_leads.agent_email, guestpost_leads.blogger_name, guestpost_leads.payment_approvel, guestpost_leads.user_id, guestpost_leads.role_id, guestpost_leads.link, guestpost_leads.amount, guestpost_leads.currency_id, guestpost_leads.payment_mode_id, guestpost_leads.payment_status, guestpost_leads.reference_number, guestpost_leads.created_at, users.id as userid, users.name as username, projects.id as project_id, projects.name as project_name, currencies.name as currency_name,currencies.id as currency_id,guestpost_leads.is_flag,guestpost_leads.payee_email, payment_modes.name as payment_mode,guestpost_leads.payee_number')
                ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
                ->join('users', 'users.id = guestpost_leads.user_id', 'left')
                ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
                ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left');
            if (!empty($pmt_mode)) {
                $all_guestposts->where('payment_modes.id', $pmt_mode);
            }
            if (!empty($currency)) {
                $all_guestposts->where('currencies.id', $currency);
            }
            if (!empty($project)) {
                $all_guestposts->where('projects.id', $project);
            }
            if (!empty($project)) {
                $all_guestposts->where('projects.id', $project);
            }
            if ($pmt_status === "0" || $pmt_status === "1") {
                $all_guestposts->where('guestpost_leads.payment_status', $pmt_status);
            }
            if ($invoice_options === "0") {
                $all_guestposts->where('guestpost_leads.reference_number IS NOT NULL AND guestpost_leads.reference_number <> ""');
            } else if ($invoice_options === "1") {
                $all_guestposts->where('guestpost_leads.payee_email IS NOT NULL AND guestpost_leads.payee_email <> ""');
            }

            if ($urgent_flag === "0" || $urgent_flag === "1") {
                $all_guestposts->where('guestpost_leads.is_flag', $urgent_flag);
            }
            if (!empty($blogger)) {
                $all_guestposts->where('guestpost_leads.blogger_name', $blogger);
            }
            $all_guestposts->where('DATE(guestpost_leads.created_at) >=', $start_date)
                ->where('DATE(guestpost_leads.created_at) <=', $end_date);
            // Add pagination (you may want to make 'paginate' dynamic)
            $pageLimit = 1; // Change this to a dynamic value if needed
            $all_guestposts = $all_guestposts->orderBy('guestpost_leads.id', 'desc')->paginate($pageLimit);
            // Prepare data for response
            $data = [
                'guestposts' => $all_guestposts,
                'all_projects' => $all_projects, // You should define $all_projects and other variables somewhere in your code.
                'all_payment_modes' => $all_payment_modes,
                'all_Currencies' => $all_Currencies,
                'blogger_names' => $blogger_names, // Define $blogger_names if necessary.
                'pager' => $GuestPostLeadsModel->pager
            ];
            echo view('guestposts_table', $data);
        } else {
            // die('hi');
            $startDate = $this->request->getGet('start_date');
            $endDate = $this->request->getGet('end_date');
            $startDate = $this->request->getGet('start_date');
            date_default_timezone_set("Asia/Kolkata");
            $timestamp = $startDate  / 1000; // Convert milliseconds to seconds
            $start_date = date("Y-m-d H:i:s", $timestamp);
            $timestamp = $endDate  / 1000; // Convert milliseconds to seconds
            $end_date = date("Y-m-d H:i:s", $timestamp);
            // echo $date;
            // $data = $GuestPostLeadsModel = new GuestPostLeadsModel();
            $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.agent_email,guestpost_leads.blogger_name,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name, currencies.name as currency_name,payment_modes.name as payment_mode,guestpost_leads.is_flag,guestpost_leads.payee_email,guestpost_leads.payee_number')
                ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
                ->join('users', 'users.id = guestpost_leads.user_id', 'left')
                ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
                ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')->where('DATE(guestpost_leads.created_at) >=', $start_date)
                ->where('DATE(guestpost_leads.created_at) <=', $end_date)->orderBy('guestpost_leads.id', 'desc')->paginate(1);
            // $data['guestposts'] = $all_guestposts;
            $data = [
                'guestposts' => $all_guestposts,
                'all_projects' => $all_projects,
                'all_payment_modes' => $all_payment_modes,
                'all_Currencies' => $all_Currencies,
                'blogger_names' => $blogger_names,
                'pager' => $GuestPostLeadsModel->pager
            ];
            echo view('get-guestposts_table', $data);
        }
        // return $this->response->setJSON($response);
    }
    public function exportdata()
    {
        $startDate = $this->request->getGet('start_date');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $pmt_mode = $this->request->getGet('paymentModeFilter');
        $currency = $this->request->getGet('currencyFilter');
        $project = $this->request->getGet('projectFilter');
        $pmt_status = $this->request->getGet('paymentFilter');
        $blogger = $this->request->getGet('bloggerFilter');
        $invoice_options = $this->request->getGet('invoice_options');
        $urgent_flag = $this->request->getGet('urgent_flag');
        // $integer = intval($pmt_status);
        // Convert start and end dates from milliseconds to seconds
        date_default_timezone_set("Asia/Kolkata");
        $startTimestamp = $startDate / 1000; // Convert milliseconds to seconds
        $start_date = date("Y-m-d H:i:s", $startTimestamp);
        $endTimestamp = $endDate / 1000; // Convert milliseconds to seconds
        $end_date = date("Y-m-d H:i:s", $endTimestamp);
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.created_at, projects.name as project_name, guestpost_leads.blogger_name, guestpost_leads.link, guestpost_leads.amount, guestpost_leads.payment_status, currencies.name as currency_name,  payment_modes.name as payment_mode,guestpost_leads.payee_number, guestpost_leads.reference_number,guestpost_leads.payee_email, users.name as username, guestpost_leads.payment_approvel')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left');
        if (!empty($pmt_mode)) {
            $all_guestposts->where('payment_modes.id', $pmt_mode);
        }
        if (!empty($currency)) {
            $all_guestposts->where('currencies.id', $currency);
        }
        if (!empty($project)) {
            $all_guestposts->where('projects.id', $project);
        }
        if (!empty($project)) {
            $all_guestposts->where('projects.id', $project);
        }
        if ($pmt_status === "0" || $pmt_status === "1") {
            $all_guestposts->where('guestpost_leads.payment_status', $pmt_status);
        }
        if ($invoice_options === "0") {
            $all_guestposts->where('guestpost_leads.reference_number IS NOT NULL AND guestpost_leads.reference_number <> ""');
        } else if ($invoice_options === "1") {
            $all_guestposts->where('guestpost_leads.payee_email IS NOT NULL AND guestpost_leads.payee_email <> ""');
        }

        if ($urgent_flag === "0" || $urgent_flag === "1") {
            $all_guestposts->where('guestpost_leads.is_flag', $urgent_flag);
        }
        if (!empty($blogger)) {
            $all_guestposts->where('guestpost_leads.blogger_name', $blogger);
        }
        // Filter by date range
        $all_guestposts->where('DATE(guestpost_leads.created_at) >=', $start_date)
            ->where('DATE(guestpost_leads.created_at) <=', $end_date);
        // Add pagination (you may want to make 'paginate' dynamic)
        $pageLimit = 2; // Change this to a dynamic value if needed
        $data = $all_guestposts->orderBy('guestpost_leads.id', 'desc')->findAll();
        // print("<pre>" . print_r($data, true) . "</pre>");
        // die('hhh');
        $filename = 'guestpostleads_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("Date", "Project", "Blogger", "Link", "Amount", "Payment_Status", "Currency", "Payment_Mode", "Payee_Number", "Reference_No", "Payee_Email", "Agent_Name", "Payment_Approvel");
        fputcsv($file, $header);
        foreach ($data as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

    public function currency()
    {
        return view('admin/add-currency');
    }
    public function add_currency()
    {
        $session = session();
        $CurrenciesModel = new CurrenciesModel();
        helper(['form', 'url']);
        $prjoect_name = $this->request->getVar('name');
        $existing_project_name = $CurrenciesModel->where('name', $prjoect_name)->first();
        if (!$existing_project_name) {
            $rules = [
                'name' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $prjoect_name,
                    'user_id' => $session->get('id'),
                ];
                $CurrenciesModel->insert($data);
                $session->setFlashdata('success_save', 'Currency added successfully');
                return redirect()->back();
            }
        }
        $session->setFlashdata('error_save', 'Duplicate Currency');
        return redirect()->back();
    }
    public function payment_method()
    {
        $CurrenciesModel = new CurrenciesModel();

        $currencies = $CurrenciesModel->select('*')->findAll();
        // print_r($currencies);
        // print("<pre>" . print_r($currencies, true) . "</pre>");
        // die('hi');
        $data = [
            'currencies' => $currencies
        ];
        return view('admin/add-payment-mode', $data);
    }
    public function add_payment_method()
    {
        $session = session();
        $PaymentModeModel = new PaymentModeModel();

        helper(['form', 'url']);
        $prjoect_name = $this->request->getVar('name');
        $currency_id = $this->request->getVar('currency');
        $existing_project_name = $PaymentModeModel->where('name', $prjoect_name)->first();
        if (!$existing_project_name) {
            $rules = [
                'name' => 'required',
                'currency' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $prjoect_name,
                    'currency_id' => $currency_id,
                    'user_id' => $session->get('id'),
                ];
                $PaymentModeModel->insert($data);
                $session->setFlashdata('success_save', 'Payment mode added successfully');
                return redirect()->back();
            }
        }
        $session->setFlashdata('error_save', 'Duplicate payment mode');
        return redirect()->back();
    }


    public function bloggers()
    {
        $session = session();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $data_by_email = $GuestPostLeadsModel->select('blogger_email, blogger_name, COUNT(blogger_email) as leads_count')
            ->groupBy('blogger_email')
            ->orderBy('guestpost_leads.created_at', 'desc')
            ->paginate(20);
        // print_r($data_by_email);
        // print("<pre>" . print_r($data_by_email, true) . "</pre>");
        // die();
        $data = [
            'leads_by_email' => $data_by_email,
            'pager' => $GuestPostLeadsModel->pager
        ];
        return view('admin/bloggers', $data);
    }
    public function blogger_leads($id)
    {
        $session = session();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $data_by_email = $GuestPostLeadsModel->select('guestpost_leads.id,guestpost_leads.blogger_email,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name,currencies.name as currency_name,payment_modes.name as payment_mode')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->where('guestpost_leads.blogger_email', $id)
            ->orderBy('guestpost_leads.created_at', 'desc')
            ->paginate(20);
        // print_r($data_by_email);
        // print("<pre>" . print_r($data_by_email, true) . "</pre>");
        // die();
        $data = [
            'bloggers_leads' => $data_by_email,
            'pager' => $GuestPostLeadsModel->pager
        ];
        return view('admin/blogger-leads-data', $data);
    }
    public function is_flag($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $is_flag = $GuestPostLeadsModel->select('is_flag')->where('id', $id)->first();
        $to_be_inserted = $is_flag['is_flag'] ==  0 ? 1 : 0;
        $updated =  $GuestPostLeadsModel->update($id, ['is_flag' => $to_be_inserted]);
        // echo $updated;
        if ($updated) {
            if ($to_be_inserted == 0) {
                echo 0;
            } else if ($to_be_inserted == 1) {
                echo 1;
            }
        }
    }
}
