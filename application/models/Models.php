<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Models extends Generic{

        //Initialize the classes

	function __construct(){
		parent:: __construct();
                
                //$this->load->model('File_m', 'f');
                $this->load->model('Report_m', 'r');
                $this->load->model('Report_m', 'report');

                $this->load->model('User_m', 'u');
                $this->load->model('User_m', 'user');

                $this->load->model('Users_m', 'us');
                $this->load->model('Users_m', 'users');

                $this->load->model('Methods', 'method');

                $this->load->model('Code_m', 'c');
                $this->load->model('Code_m', 'code');

                $this->load->model('Package_m', 'p');
                $this->load->model('Package_m', 'package');

                $this->load->model('Account_m', 'acc');
                $this->load->model('Account_m', 'account');

                $this->load->model('Mvp_m', 'm');
                $this->load->model('Mvp_m', 'mvp');

                $this->load->model('Referral_m', 'ref');
                $this->load->model('Referral_m', 'referral');

                $this->load->model('Network_m', 'net');
                $this->load->model('Network_m', 'network');

                $this->load->model('Earnings_m', 'e');
                $this->load->model('Earnings_m', 'earnings');

                $this->load->model('Ledger_m', 'l');
                $this->load->model('Ledger_m', 'ledger');

                $this->load->model('MatchingPair_m', 'mp');
                $this->load->model('MatchingPair_m', 'matchingpair');

                $this->load->model('Logs_m', 'logs');

                $this->load->model('ProfitShare_m', 'ps');
                $this->load->model('ProfitShare_m', 'profitshare');

                $this->load->model('Points_m', 'po');
                $this->load->model('Points_m', 'points');

                $this->load->model('IncentivePoints_m', 'ip');
                $this->load->model('IncentivePoints_m', 'incentivepoints');

                $this->load->model('Payout_m', 'pay');
                $this->load->model('Payout_m', 'payout');
	}
}
