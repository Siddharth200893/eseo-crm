<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestPostLeadsModel;
use App\Models\ProjectsModel;
use App\Models\PaymentModeModel;
use App\Models\CurrenciesModel;

class AgentController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "Agent") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("agent/dashboard");
    }
    public function guest_posting()
    {
        $ProjectsModel = new ProjectsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_currencies = $CurrenciesModel->select('*')->findAll();
        $projects = $ProjectsModel->select('*')->findAll();
        // $guestpost_currency_id = $this->request->getVar('currency');

        // print("<pre>" . print_r($usd_payment_modes, true) . "</pre>");
        // die('hi');

        $data = [
            'all_payment_modes' => $all_payment_modes,
            'all_currencies' => $all_currencies,
            'projects' => $projects,

        ];
        return view('agent/guest-posting', $data);
    }

    public function payment_modes($id)
    {
        $PaymentModeModel = new PaymentModeModel();

        $payment_modes = $PaymentModeModel->select('*')->where('currency_name', $id)->findAll();

        if ($payment_modes) {
            $p_modes = ""; // Initialize an empty string to store the HTML options

            foreach ($payment_modes as $payment_mode) {
                $p_modes .= "<option value=\"{$payment_mode['name']}\">{$payment_mode['name']}</option>";
            }

            echo '<select><option value="">Select</option>' . $p_modes . '</select>';
        } else {
            echo '<select><option value="">Select</option><option value="PAYPAL">Paypal</option></select>';
        }
    }



    public function save_guestpost()
    {
        $session = session();
        $ssn_id = $session->get('id');
        $ssn_role_id = $session->get('role_id');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();


        $guestpostlink = $this->request->getVar('link');
        $existing_guestpostlink = $GuestPostLeadsModel->where('link', $guestpostlink)->first();
        $reference_number = $this->request->getVar('reference_number');
        $payee_email = $this->request->getVar('payee_email');
        $acct_no = $this->request->getVar('acct_no');
        $payment_status = $this->request->getVar('paymentStatus');
        $existing_reference_number = $GuestPostLeadsModel->select()->where('reference_number', $reference_number)->first();
        $payment_mode = $this->request->getVar('paymentmode');
        $currency = $this->request->getVar('currency');
        $payment_mode_id = $PaymentModeModel->select('id')->where('name', $payment_mode)->first();
        $cuurency_id = $CurrenciesModel->select('id')->where('name', $currency)->first();

        // print_r($cuurency_id['id']);
        // die('hi');

        if ($existing_guestpostlink) {
            $session->setFlashdata('error_save', 'This guest post link already exists');
            return redirect()->to(base_url() . 'agent/guest-posting');
        } elseif (!empty($reference_number || $payee_email || $acct_no)) {
            if ($existing_reference_number && !empty($reference_number)) {
                $session->setFlashdata('error_save', 'Cannot enter duplicate reference number!');
                return redirect()->to(base_url() . 'agent/guest-posting');
            } else {

                helper(['form', 'url']);
                $rules = [
                    'link' => 'required',
                    'blogger_name' => 'required',
                    'blogger_email' => 'required',
                    'projectName' => 'required',
                    'paymentStatus' => 'required',
                    'currency' => 'required',
                    'amount' => 'required',
                    'paymentmode' => 'required',
                ];

                if ($this->validate($rules)) {
                    $data = [
                        'user_id' => $ssn_id,
                        'role_id' => $ssn_role_id,
                        'link' => $this->request->getVar('link'),
                        'blogger_name' => $this->request->getVar('blogger_name'),
                        'blogger_phone' => $this->request->getVar('blogger_phone'),
                        'project_id' => $this->request->getVar('projectName'),
                        'payment_status' => $payment_status,
                        'currency_id' => $cuurency_id['id'],
                        'payment_mode_name' => $this->request->getVar('paymentmode'),
                        'payment_mode_id' => $payment_mode_id['id'],
                        'amount' => $this->request->getVar('amount'),
                        'agent_email' => $session->get('email'),
                        'blogger_email' => $this->request->getVar('blogger_email'),
                        'reference_number' => $this->request->getVar('reference_number'),
                        'payee_number' => $this->request->getVar('payee_number'),
                        'payee_email' => $this->request->getVar('payee_email'),
                        'account_no' => $this->request->getVar('acct_no'),
                        'account_name' => $this->request->getVar('acct_name'),
                        'ifsc_code' => $this->request->getVar('ifsc'),

                    ];
                    // print("<pre>" . print_r($data, true) . "</pre>");
                    // die('hi');
                    $GuestPostLeadsModel->insert($data);



                    $session->setFlashdata('success_save', 'Saved');


                    return redirect()->to(base_url() . 'agent/guest-posting-leads');
                } else {
                    // $validationErrors = $this->validator->getErrors();
                    // print_r($validationErrors);
                    // die('errrors');
                    $session->setFlashdata('error_save', 'Please enter valid details');
                    return redirect()->to(base_url() . 'agent/guest-posting');
                }
            }
        } elseif ($payment_status == 0) {
            helper(['form', 'url']);
            $rules = [
                'link' => 'required',
                'blogger_name' => 'required',
                'blogger_email' => 'required',
                'projectName' => 'required',
                'paymentStatus' => 'required',
            ];

            if ($this->validate($rules)) {
                $data = [
                    'user_id' => $ssn_id,
                    'role_id' => $ssn_role_id,
                    'link' => $this->request->getVar('link'),
                    'agent_email' => $session->get('email'),
                    'blogger_name' => $this->request->getVar('blogger_name'),
                    'blogger_phone' => $this->request->getVar('blogger_phone'),
                    'project_id' => $this->request->getVar('projectName'),
                    'payment_status' => $payment_status,
                    'blogger_email' => $this->request->getVar('blogger_email'),

                ];

                $GuestPostLeadsModel->insert($data);

                $session->setFlashdata('success_save', 'Saved');
                return redirect()->to(base_url() . 'agent/guest-posting-leads');
            } else {
                $session->setFlashdata('error_save', 'Please enter valid details');
                return redirect()->to(base_url() . 'agent/guest-posting');
            }
        } else {
            $session->setFlashdata('error_save', 'something went wrong! ');
            return redirect()->to(base_url() . 'agent/guest-posting');
        }
    }



    public function guest_posting_leads()
    {
        $session = session();
        $currenct_agent_id = session()->get('id');
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
        $currentDate = date('Y-m-d');
        $firstDayOfMonth = date('Y-m-01', strtotime($currentDate));
        $lastDayOfMonth = date('Y-m-t', strtotime($currentDate));
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id,guestpost_leads.updated_at ,guestpost_leads.blogger_name,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.is_flag,guestpost_leads.payment_status,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name,currencies.name as currency_name,payment_modes.name as payment_mode,guestpost_leads.payee_email,guestpost_leads.currency_id as pmt_currency,guestpost_leads.payment_mode_id,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payee_number,guestpost_leads.account_name,guestpost_leads.account_no,guestpost_leads.ifsc_code,guestpost_leads.reference_number')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
            ->where('DATE(guestpost_leads.created_at) >=', $firstDayOfMonth)
            ->where('DATE(guestpost_leads.created_at) <=', $lastDayOfMonth)
            ->where('guestpost_leads.user_id', $currenct_agent_id)
            ->orderBy('guestpost_leads.id', 'desc')->paginate(20);
        $data = [
            'guest_posts' => $all_guestposts,
            'all_projects' => $all_projects,
            'all_payment_modes' => $all_payment_modes,
            'all_Currencies' => $all_Currencies,
            'blogger_names' => $blogger_names,
            'pager' => $GuestPostLeadsModel->pager
        ];
        return view('agent/guestposts-leads', $data);
    }
    public function edit_guestpost($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_currencies = $CurrenciesModel->select('*')->findAll();
        // $project = $ProjectsModel->select('*')->where('id', $id)->first();
        $projects = $ProjectsModel->select('*')->findAll();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id as guestpost_id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username, projects.id as project_id, projects.name as project_name,currencies.name as currency_name,payment_modes.name as payment_mode')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.Project_id', 'left')
            ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
            ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')
            ->where('md5(guestpost_leads.id)', $id)->first();
        // print_r($all_guestposts);
        // die('hi');
        $data = [
            'guest_posts' => $all_guestposts,
            'all_payment_modes' => $all_payment_modes,
            'all_currencies' => $all_currencies,
            'projects' => $projects,
        ];
        return view('agent/edit-guestpost', $data);
    }
    public function update_guestpost()
    {
        $session = session();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        helper(['form', 'url']);
        $id = $this->request->getVar('id');
        $rules = [
            'amount' => 'required',
        ];
        if ($this->validate($rules)) {
            $data = [
                'project_id' => $this->request->getVar('projectName'),
                'amount' => $this->request->getVar('amount'),
                'currency_id' => $this->request->getVar('currency'),
                'updated_at' => date('Y-m-d H:s:a'),
            ];
            $GuestPostLeadsModel->update($id, $data);
            $session->setFlashdata('success_save', 'Updated successfully');
            $session->set('some_name', $id);
            return redirect()->to(base_url() . 'agent/guest-posting-leads');
        }
    }
    public function guestpost_leads_date_range()
    {
        // die('hi');
        $currenct_agent_id = session()->get('id');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();
        $PaymentModeModel = new PaymentModeModel();
        $CurrenciesModel = new CurrenciesModel();
        $all_projects = $ProjectsModel->select('*')->findAll();
        $all_payment_modes = $PaymentModeModel->select('*')->findAll();
        $all_Currencies = $CurrenciesModel->select('*')->findAll();
        $blogger_names = $GuestPostLeadsModel->select('blogger_name')
            ->groupBy('blogger_name')
            ->where('guestpost_leads.user_id', $currenct_agent_id)
            ->findAll();
        if ($this->request->isAJAX()) {
            $currenct_agent_id = session()->get('id');
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
            $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id, guestpost_leads.agent_email, guestpost_leads.blogger_name, guestpost_leads.payment_approvel, guestpost_leads.user_id, guestpost_leads.role_id, guestpost_leads.link, guestpost_leads.amount, guestpost_leads.currency_id, guestpost_leads.payment_mode_id, guestpost_leads.payment_status, guestpost_leads.reference_number, guestpost_leads.created_at, users.id as userid, users.name as username, projects.id as project_id, projects.name as project_name, currencies.name as currency_name,currencies.id as currency_id,guestpost_leads.is_flag,guestpost_leads.payee_email, payment_modes.name as payment_mode,guestpost_leads.payee_number,guestpost_leads.account_name,guestpost_leads.account_no,guestpost_leads.ifsc_code')
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
            // die($currenct_agent_id);
            $all_guestposts->where('guestpost_leads.user_id', $currenct_agent_id)
                ->where('DATE(guestpost_leads.created_at) >=', $start_date)
                ->where('DATE(guestpost_leads.created_at) <=', $end_date);
            // Add pagination (you may want to make 'paginate' dynamic)
            $pageLimit = 20; // Change this to a dynamic value if needed
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
            echo view('agent/guestposts_table', $data);
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
            $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.agent_email,guestpost_leads.blogger_name,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency_id,guestpost_leads.payment_mode_id,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name, currencies.name as currency_name,payment_modes.name as payment_mode,guestpost_leads.is_flag,guestpost_leads.payee_email,guestpost_leads.payee_number,guestpost_leads.account_name,guestpost_leads.account_no,guestpost_leads.ifsc_code')
                ->join('currencies', 'currencies.id = guestpost_leads.currency_id', 'left')
                ->join('users', 'users.id = guestpost_leads.user_id', 'left')
                ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')
                ->join('payment_modes', 'payment_modes.id = guestpost_leads.payment_mode_id', 'left')->where('DATE(guestpost_leads.created_at) >=', $start_date)
                ->where('DATE(guestpost_leads.created_at) <=', $end_date)
                ->where('guestpost_leads.user_id', $currenct_agent_id)
                ->orderBy('guestpost_leads.id', 'desc')->paginate(20);
            // $data['guestposts'] = $all_guestposts;
            $data = [
                'guest_posts' => $all_guestposts,
                'all_projects' => $all_projects,
                'all_payment_modes' => $all_payment_modes,
                'all_Currencies' => $all_Currencies,
                'blogger_names' => $blogger_names,
                'pager' => $GuestPostLeadsModel->pager
            ];
            echo view('agent/get-guestposts_table', $data);
        }
        // return $this->response->setJSON($response);
    }
    public function exportdata()
    {
        $currenct_agent_id = session()->get('id');
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
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.created_at, projects.name as project_name, guestpost_leads.blogger_name, guestpost_leads.link,guestpost_leads.payment_status,guestpost_leads.amount,currencies.name as currency_name,  payment_modes.name as payment_mode, guestpost_leads.reference_number,guestpost_leads.payee_number,guestpost_leads.payee_email,guestpost_leads.account_no,guestpost_leads.account_name,guestpost_leads.ifsc_code,users.name as username,guestpost_leads.payment_approvel')
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
        $all_guestposts->where('guestpost_leads.user_id', $currenct_agent_id)
            ->where('DATE(guestpost_leads.created_at) >=', $start_date)
            ->where('DATE(guestpost_leads.created_at) <=', $end_date);
        $data = $all_guestposts->orderBy('guestpost_leads.id', 'desc')->findAll();
        // print("<pre>" . print_r($data, true) . "</pre>");
        // die('hhh');
        $filename = 'guestpostleads_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("Date", "Project", "Blogger", "Link", "Payment_Status", "Amount", "Currency", "Payment_Mode", "Reference_No", "Payee_Number", "Payee_Email", "Account_Number", "Account_Holder", "IFSC_Code	", "Agent_Name", "Payment_Approvel");
        fputcsv($file, $header);
        foreach ($data as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
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
