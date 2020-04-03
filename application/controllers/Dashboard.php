<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Dashboard extends CI_Controller

{

    function __construct()

    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {
        
        $this->mod->isAdmin();
        $this->method->SetMenu('Dashboard');

        //get the all the report for the dashboard
        //first we need to get the total current company earned
        $CurrentCompanyEarnedDebitObj =  $this->ledger->get('SUM(Debit) as TotalDebit','LedgerId is not null');
        $CurrentCompanyEarnedCreditObj =  $this->ledger->get('SUM(Credit) as TotalCredit','LedgerId is not null');
        $adjustmentObj = $this->ledger->get('SUM(Credit) as TotalCredit', 'Tag in ("Encashment","Tax","AdminFee")');
        $adjustmentTaxObj = $this->ledger->get('SUM(Credit) as TotalCredit', 'Tag in ("Tax")');
        $adjustmentAdminFeeObj = $this->ledger->get('SUM(Credit) as TotalCredit', 'Tag in ("AdminFee")');
        print_r($CurrentCompanyEarnedCreditObj[0]['TotalCredit']);
        print_r($CurrentCompanyEarnedDebitObj[0]['TotalDebit']);
        $data['CurrentCompanyEarned'] = number_format($CurrentCompanyEarnedCreditObj[0]['TotalCredit'] - $CurrentCompanyEarnedDebitObj[0]['TotalDebit'], 2);
        //get the company total earned
        $data['TotalCompanyEarned'] = number_format($CurrentCompanyEarnedCreditObj[0]['TotalCredit'] - $adjustmentObj[0]['TotalCredit'], 2);
        //get the total members earned
        $MembersEarnedDebitObj = $this->e->get('SUM(Debit) as Total','EarnId is not null');
        $MembersEarnedCreditObj = $this->e->get('SUM(Credit) as Total','EarnId is not null');
        $data['MembersEarned'] = number_format($MembersEarnedCreditObj[0]['Total'] - $MembersEarnedDebitObj[0]['Total'],2);
        //get the total expenses
        $TotalExpensesObj = $this->ledger->get('SUM(Debit) as Total','Tag = "Expense"');
        $data['TotalExpenses'] = number_format($TotalExpensesObj[0]['Total'], 2);
        //get the total adminfee
        $TotalAdminFeeObj = $this->ledger->get('SUM(Debit) as Total','Tag = "AdminFee"');
        $data['TotalAdminFee'] = number_format($TotalAdminFeeObj[0]['Total'] - $adjustmentAdminFeeObj[0]['TotalCredit'], 2);
        //get the total Tax
        $TotalTaxObj = $this->ledger->get('SUM(Debit) as Total','Tag = "Tax"');
        $data['TotalTax'] = number_format($TotalTaxObj[0]['Total'] - $adjustmentTaxObj[0]['TotalCredit'], 2);
        //get the total Cash Back
        $TotalCashBackObj = $this->ledger->get('SUM(Debit) as Total','Tag = "Cash Back Reward"');
        $data['TotalCashBack'] = number_format($TotalCashBackObj[0]['Total'], 2);
        //get the total encashment
        $TotalMemberEncashmentObj = $this->e->get('SUM(Debit) as Total','Tag = "Encashment"');
        $adjustmentMemberObj = $this->e->get('SUM(Credit) as TotalCredit', 'Tag in ("Encashment")');
        $data['TotalMemberEncashment'] = number_format($TotalMemberEncashmentObj[0]['Total'] - $adjustmentMemberObj[0]['TotalCredit'],2);
        //get the total referral
        $TotalMemberReferralObj = $this->ledger->get('SUM(Debit) as Total','Tag = "Referral"');
        $data['TotalMemberReferral'] = number_format($TotalMemberReferralObj[0]['Total'],2);
        //get the total match sale earned
        $TotalMemberMatchSaleObj = $this->ledger->get('SUM(Debit) as Total','Tag = "Match"');
        $data['TotalMemberMatchSale'] = number_format($TotalMemberMatchSaleObj[0]['Total'],2);
        //get the total profit share distribute
        $ProfitShareDistributedObj = $this->ledger->get('SUM(Debit) as Total','Tag = "ProfitShare"');
        $data['ProfitShareDistributed'] = number_format($ProfitShareDistributedObj[0]['Total'],2);
        //get the incentive poinst total
        $getincentivepoints = $this->ip->get('SUM(LeftPoints) as TotalL, SUM(RightPoints) as TotalR','IncentivePointId is not null');
        $data['IncentivePoints'] = min($getincentivepoints[0]['TotalL'],$getincentivepoints[0]['TotalR'])??0;
        //get the total number of accounts
        $accounts = $this->acc->get();
        if ($accounts != false) {
            $data['TotalAccount'] = count($accounts);
        }
        else{
            $data['TotalAccount'] = 0;
        }
        //get the total number of users
        $users = $this->users->get();
        if ($accounts != false) {
            $data['TotalUser'] = count($users);
        }
        else{
            $data['TotalUser'] = 0;
        }
        //get the request payout
        $TotalPayoutRequestObj = $this->pay->get('COUNT(*) as TotalRequest',['IsActive' => 1, 'IsApproved' => 0]);
        $data['TotalPayoutRequest'] = $TotalPayoutRequestObj[0]['TotalRequest'];

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Dashboard/index', $data);
        $this->load->view('Layouts/footer');

    }

}