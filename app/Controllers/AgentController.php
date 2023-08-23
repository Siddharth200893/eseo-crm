<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestPostLeadsModel;
use App\Models\ProjectsModel;


class AgentController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "agent") {
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

        $projects = $ProjectsModel->select('*')->findAll();
        $data = ['projects' => $projects];
        return view('agent/guest-posting', $data);
    }
    public function save_guestpost()
    {
        $session = session();
        $ssn_id = $session->get('id');
        $ssn_role_id = $session->get('role_id');
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $guestpostlink = $this->request->getVar('link');
        $existing_guestpostlink = $GuestPostLeadsModel->where('link', $guestpostlink)->first();
        $reference_number = $this->request->getVar('reference_number');

        $existing_reference_number = $GuestPostLeadsModel->where('reference_number', $reference_number)->first();
        // echo gettype($existing_guestpostlink);
        // print("<pre>" . print_r($existing_reference_number, true) . "</pre>");

        // die('hi');


        if (!empty($existing_reference_number['reference_number'])) {

            if (!$existing_guestpostlink) {

                if (!$existing_reference_number) {
                    helper(['form', 'url']);
                    $rules = [
                        'link' => 'required',
                        'amount' => 'required',
                        'paymentStatus' => 'required',
                    ];
                    if ($this->validate($rules)) {
                        $data = [
                            'user_id' => $ssn_id,
                            'role_id' => $ssn_role_id,
                            'link' => $this->request->getVar('link'),
                            'project_id' => $this->request->getVar('projectName'),
                            'amount' => $this->request->getVar('amount'),
                            'currency' => $this->request->getVar('currency'),
                            'reference_number' => $this->request->getVar('reference_number'),
                            'payment_mode' => $this->request->getVar('paymentmode'),
                            'payment_status' => $this->request->getVar('paymentStatus'),
                        ];


                        $GuestPostLeadsModel->insert($data);
                        $session->setFlashdata('success_save', 'Saved');
                        return redirect()->to(base_url() . 'agent/guest-posting-leads');
                    } else {
                        $session->setFlashdata('error_save', 'Please enter valid details');
                        return  redirect()->to(base_url() . 'agent/guest-posting');
                    }
                } else {
                    $session->setFlashdata('error_save', 'Please enter unique reference number');
                    return  redirect()->to(base_url() . 'agent/guest-posting');
                }
            } else {
                $session->setFlashdata('error_save', 'this guest post link already exists');
                return  redirect()->to(base_url() . 'agent/guest-posting');
            }
        } else {
            if (!$existing_guestpostlink) {

                helper(['form', 'url']);
                $rules = [
                    'link' => 'required',
                    'amount' => 'required',
                    'paymentStatus' => 'required',
                ];
                if ($this->validate($rules)) {
                    $data = [
                        'user_id' => $ssn_id,
                        'role_id' => $ssn_role_id,
                        'link' => $this->request->getVar('link'),
                        'project_id' => $this->request->getVar('projectName'),
                        'amount' => $this->request->getVar('amount'),
                        'currency' => $this->request->getVar('currency'),
                        'reference_number' => $this->request->getVar('reference_number'),
                        'payment_mode' => $this->request->getVar('paymentmode'),
                        'payment_status' => $this->request->getVar('paymentStatus'),
                    ];
                    $GuestPostLeadsModel->insert($data);
                    $session->setFlashdata('success_save', 'Saved');
                    return redirect()->to(base_url() . 'agent/guest-posting-leads');
                } else {
                    $session->setFlashdata('error_save', 'Please enter valid details');
                    return  redirect()->to(base_url() . 'agent/guest-posting');
                }
            } else {
                $session->setFlashdata('error_save', 'this guest post link already exists');
                return  redirect()->to(base_url() . 'agent/guest-posting');
            }
        }
    }



    public function guest_posting_leads()
    {
        $session = session();
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ssn_id = $session->get('id');
        // print_r($ssn_id);
        // die('hi');
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username,projects.id as project_id,projects.name as project_name')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.project_id', 'left')->orderBy('guestpost_leads.id', 'desc')->paginate(20);

        $data = [

            'guest_posts' => $all_guestposts,
            'pager' => $GuestPostLeadsModel->pager
        ];

        return view('agent/guestposts-leads', $data);
    }

    public function edit_guestpost($id)
    {
        $GuestPostLeadsModel = new GuestPostLeadsModel();
        $ProjectsModel = new ProjectsModel();

        // $project = $ProjectsModel->select('*')->where('id', $id)->first();
        $projects = $ProjectsModel->select('*')->findAll();
        $all_guestposts = $GuestPostLeadsModel->select('guestpost_leads.id as guestpost_id ,guestpost_leads.payment_approvel,guestpost_leads.user_id,guestpost_leads.role_id,guestpost_leads.link,guestpost_leads.amount,guestpost_leads.currency,guestpost_leads.payment_mode,guestpost_leads.payment_status,guestpost_leads.reference_number,guestpost_leads.created_at,users.id as userid,users.name as username, projects.id as project_id, projects.name as project_name')
            ->join('users', 'users.id = guestpost_leads.user_id', 'left')
            ->join('projects', 'projects.id = guestpost_leads.Project_id', 'left')
            ->where('guestpost_leads.id', $id)->orderBy('guestpost_leads.id', 'desc')->first();
        // print_r($all_guestposts);
        // die('hi');
        $data = [
            'guest_posts' => $all_guestposts,
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
        // print_r($id);
        // die('hi');
        $reference_number = $this->request->getVar('reference_number');
        if (!$reference_number) {
            $rules = [
                'amount' => 'required',
                'paymentStatus' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'project_id' => $this->request->getVar('projectName'),

                    'amount' => $this->request->getVar('amount'),
                    'currency' => $this->request->getVar('currency'),
                    'payment_mode' => $this->request->getVar('paymentmode'),
                    'payment_status' => $this->request->getVar('paymentStatus'),
                    'updated_at' => date('Y-m-d H:s:a'),

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
                    'project_id' => $this->request->getVar('projectName'),

                    'amount' => $this->request->getVar('amount'),
                    'currency' => $this->request->getVar('currency'),
                    'reference_number' => $this->request->getVar('reference_number'),
                    'payment_mode' => $this->request->getVar('paymentmode'),
                    'payment_status' => $this->request->getVar('paymentStatus'),
                    'updated_at' => date('Y-m-d H:s:a'),

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
}
