<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Users extends CI_Controller

{

    function __construct()
    {
        parent:: __construct();

        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Admin');

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Users/index');
        $this->load->view('Layouts/footer');

    }
    
    function switchAccount($accountname = 000){
        $_SESSION['AccountName'] = $accountname;
        $acc = $this->acc->get(['AccountName' => $accountname]);
        $this->session->set_userdata($acc[0]);
        redirect(base_url()."Users/dashboard/".$accountname);
    }

    function dashboard($accountname = null){

        //$this->mod->isUser();
        $this->method->SetMenu('dashboard');
        $data = [];
        $id = $this->input->get('id');
        $name = $this->input->get('name');
        $picture = $this->input->get('picture');
        $email = $this->input->get('email');
        $debug = $this->input->get('debug');
        $debuguserid = $this->input->get('debuguserid');
        //print_r($id);
        if (!isset($_SESSION['UsersId'])) {
            //$this->method->googleSetting();

            try {
                // // Get the access token 
                // $data = $this->method->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
                
                // // Get user information
                // $data['user_info'] = $this->method->GetUserProfileInfo($data['access_token']);

                //var_dump($data['user_info']['id']);
                $user = $this->us->get([
                    'Id' => $id
                ]);
                //var_dump($this->db->last_query());
                //var_dump(date('Y-m-d H:i:s'));
                if ($user != false) {
                    # means it exist
                    //Auto update 
                    //if they change their name,verification and the profile pic
                    $field = [
                        'Fullname' => $name,
                        'EmailVerified' => 1,
                        'Picture' => $picture,
                        'LastSeen' => date('Y-m-d H:i:s')
                    ];


                    $user = $this->us->update($field,['Id' => $id],1);
                    //print_r($this->db->last_query());
                    $this->load->library('session');
                    $this->session->set_userdata($user[0]);


                }
                else{
                    if($debug == 1){
                        $user = $this->us->get([
                            'UsersId' => $debuguserid
                        ]);
                        $this->load->library('session');
                        $this->session->set_userdata($user[0]);
                    }
                    else if (!isset($debug)) {
                        if (!isset($id)) {
                            redirect(base_url()."Login"); 
                        }
                        # register new member
                        $field = [
                            'Id' => $id,
                            'Email' => $email,
                            'Fullname' => $name,
                            'EmailVerified' => 1,
                            'Picture' => $picture,
                            'LastSeen' => date('Y-m-d H:i:s')
                        ];

                        $user = $this->us->insert($field,1);

                        $this->load->library('session');
                        $this->session->set_userdata($user[0]);
                        $data['data'] = [
                            'IsUserAccountVerified' => 0
                        ];
                    }
                    
                }
                //print_r($_SESSION['UsersId']);
                $acc = $this->acc->get(['UsersId' => $_SESSION['UsersId']]);
                if ($acc != false) {
                    $this->load->library('session');
                    $this->session->set_userdata($acc[0]);

                    redirect(base_url()."Users/newdashboard/".$acc[0]['AccountName']); 
                }
                else{
                    redirect(base_url()."Users/newdashboard"); 
                }
                //print_r($acc);
            }
            catch(Exception $e) {
                echo $e->getMessage();
                exit();
            }
        }
        else{
            $data = null;
            if (is_null($accountname)) {
                $data = $this->method->getAccountInfo();
            }
            else{
                $data = $this->method->getAccountInfo($accountname);
            }
            //var_dump($_SESSION);
            $this->method->setToken();
            $this->load->view('Layouts/newheader');
            $this->load->view('Layouts/newmenu',$data);
            $this->load->view('Users/newdashboard',$data);
            $this->load->view('Layouts/newfooter');
        }
    }

    //Earn side of the users
    function earnFromMatchSales(){
        $matchsalebonus = $this->method->earnInMatchingPair($_SESSION['AccountId']);
        $msg['success'] = false;
        if ($matchsalebonus) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    function getUserEarningLogs()
    {
        $AccountName = $_SESSION['AccountName'];
        //Data to be Display
        $select = [
            '*',
        ];

        //Condition Processes Start Here
        $where = null;



        //Condition base on delivery from supplier status
        // $estatus = $this->input->post('param[IsUsed]');
        // if($estatus == 'Used'){
        //     $where = 'IsUsed = 1';
        // }
        // elseif($estatus == 'Not Used'){
        //     $where = 'IsUsed = 0';
        // }
        // else {
        //     $where = null;
        // }
        $where = ['AccountName' => $AccountName];
        //Condition base on filter

        //End of the Condition

        //Joined Related Table
        $join = null;

        $columnSearch = [
            'Debit',
            'Credit',
            'Tag',
            'Description',
        ];

        //Execute the statement above here
        $filter = $this->e->count_filtered($select,$join,$where,null,null,$columnSearch,['EarnId' => 'desc']);
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $filter,
            "recordsFiltered" => $filter,
            "data" => $this->e->get_datatables($select,$join,$where,null,null,$columnSearch,['EarnId' => 'desc'])
        );

        echo json_encode($output);

    }
}
