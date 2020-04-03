<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Methods extends Generic{

	function __construct(){
		parent:: __construct();

		$this->load->model('Models', 'mod');
	}

        public function SetMenu($value='')
        {
            $_SESSION['MenuName'] = $value;
        }

        public function CheckUsernameExist($username){
        	return $this->u->isExisted(['Username' => $username]);
        }

        public function SetToken(){
        	$_SESSION['token'] = md5(uniqid() . date('YmdHis'));
        }

        public function googleSetting(){
            /* Google App Client Id */
            define('CLIENT_ID', '232786101880-nfbjs5e0mfgi5a80692uhmbgnqieh5kb.apps.googleusercontent.com');

            /* Google App Client Secret */
            define('CLIENT_SECRET', 'fHTWwhaP8JMia8nitRMWa9KI');

            /* Google App Redirect Url */
            define('CLIENT_REDIRECT_URL', 'http://localhost:8000/Systemax/Users/Dashboard'); 
        }

        public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {  
            $url = 'https://www.googleapis.com/oauth2/v4/token';            
            
            $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code&access_type=offline';
            //var_dump($curlPost);
            $ch = curl_init();      
            curl_setopt($ch, CURLOPT_URL, $url);        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
            curl_setopt($ch, CURLOPT_POST, 1);      
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
            $data = json_decode(curl_exec($ch), true);
            //var_dump($data);
            $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
            if($http_code != 200) 
                throw new Exception('Error : Failed to receieve access token');
                
            return $data;
        }

        public function GetUserProfileInfo($access_token) { 
            $url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email';          
            
            $ch = curl_init();      
            curl_setopt($ch, CURLOPT_URL, $url);        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
            $data = json_decode(curl_exec($ch), true);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);     
            if($http_code != 200) 
                throw new Exception('Error : Failed to get user information');
                
            return $data;
        }

        public function getAccountInfo($accountname = null){
            //set the accountid if not null then no need to assign to session
            if (is_null($accountname)) {
                if (isset($_SESSION['AccountName'])) {
                    $accountname = $_SESSION['AccountName'];
                }
            }

            $userid = $_SESSION['UsersId'];
            $account = $this->acc->get(['AccountName' => $accountname, 'UsersId' => $userid]);
            $this->session->set_userdata($account[0]);
            if ($accountname == null) {
                $account = $this->acc->get(['UsersId' => $userid]);
                $accountname = $account[0]['AccountName'];
                $_SESSION['AccountName'] = $accountname;

                
            }
            
            //if url was change then redirect to the original intead and use account variable
            if ($account == false) {
                // if (!isset($_SESSION['AccountName'])) {
                //     redirect(base_url()."Login");
                // }
                //$accountname = $_SESSION['AccountName'];

                //$account = $this->acc->get(['AccountName' => $accountname, 'UsersId' => $userid]);

                //redirect(base_url()."Users/dashboard");
            }

            $accounts = $this->acc->get(['UsersId' => $userid]);

            //set to false first
            $accountcode = false;
            $data['AccountsCount'] = false;
            $data['Account'] = false;
            $data['AccountPackage'] = false;
            $data['ReferalsCount'] = 0;
            
            if ($account != false) {
                $accountcode = $this->c->get(['CodeId' => $account[0]['CodeId']]);
                //get the number of accounts
                $data['AccountsCount'] = count($accounts);
                //get the current account
                $data['Account'] = $account[0];
                //get the account package
                $data['AccountPackage']  = $this->package->get(['PackageId' => $accountcode[0]['PackageId']])[0];
                //get the total no. of referals
                $data['ReferalsCount']= $this->account->get('COUNT(*) as ReferalsCount',['ReferredById' => $account[0]['AccountName']])[0]['ReferalsCount'];
            }
            //get is account verified
            $data['IsUserAccountVerified'] = $this->acc->isExisted(['UsersId' => $_SESSION['UsersId']]);
            //get the list of accounts
            $data['Accounts'] = $accounts;
            //get the code of the current account
            $data['AccountCode'] = $accountcode;
            
            
            //get the rank
            if ($account[0]['TotalMVP'] < 90) {
                $data['AccountRank'] = 'Beginner';
            }
            elseif ($account[0]['TotalMVP'] < 180) {
                $data['AccountRank'] = 'Apprentice';
            }
            elseif ($account[0]['TotalMVP'] < 270) {
                $data['AccountRank'] = 'Expert';
            }
            elseif ($account[0]['TotalMVP'] < 360) {
                $data['AccountRank'] = 'Professional';
            }
            elseif ($account[0]['TotalMVP'] < 450) {
                $data['AccountRank'] = 'Master';
            }
            elseif ($account[0]['TotalMVP'] < 540) {
                $data['AccountRank'] = 'Grand Master';
            }
            elseif ($account[0]['TotalMVP'] < 630) {
                $data['AccountRank'] = 'Mentor';
            }
            elseif ($account[0]['TotalMVP'] >= 630) {
                $data['AccountRank'] = 'Grand Mentor';
            }

            //get the list of the new members not assign
            $network['newmembers'] = $this->method->getToBeAssignMember($data['Account']['AccountId']);

            if ($network['newmembers'] != false) {
                $data['newmembertobeassigncnt'] = count($network['newmembers']);
            }
            else{
                $data['newmembertobeassigncnt'] = 0;
            }
            $data['membersCnt'] = $data['newmembertobeassigncnt'];
            //get the days left
            $DateO = $account[0]['DateActive'];
            $date_expire = date('Y-m-d', strtotime($DateO. ' + 30 days')); 
            $date = new DateTime($date_expire);
            $now = new DateTime();
            if($date < $now){
                $data['DaysNow'] = $now;
                $data['DaysLeft'] =  0;
            }
            else{
                $data['DaysNow'] = $date;
                $data['DaysLeft'] =  $date->diff($now)->format("%d");
            }
            // $today = date('Y-m-d');
            
            //get the earn report for display
            //get the current earned
            $currentEarnedDebitObj = $this->earnings->get('SUM(Debit) as TotalDebit', ['AccountName' => $accountname]);
            $currentEarnedCreditObj = $this->earnings->get('SUM(Credit) as TotalCredit', ['AccountName' => $accountname]);
            $data['CurrentEarned'] = $currentEarnedCreditObj[0]['TotalCredit'] - $currentEarnedDebitObj[0]['TotalDebit'];
            //get the total earned
            $totalEarnedCreditObj = $this->earnings->get('SUM(Credit) as TotalCredit', ['AccountName' => $accountname, 'Tag' => 'Encashment']);
            $data['TotalEarned'] = $currentEarnedCreditObj[0]['TotalCredit'] - $totalEarnedCreditObj[0]['TotalCredit'];
            //get the total referral earned
            $referralEarnedObj = $this->earnings->get('SUM(Credit) as TotalCredit', ['AccountName' => $accountname, 'Tag' => 'Referral']);
            $data['ReferralEarned'] = $referralEarnedObj[0]['TotalCredit'];
            //get the total match sales earned
            $matchEarnedObj = $this->earnings->get('SUM(Credit) as TotalCredit', ['AccountName' => $accountname, 'Tag' => 'Match']);
            $data['MatchEarned'] = $matchEarnedObj[0]['TotalCredit'];
            //get the total profit share earned
            $profitshareEarnedObj = $this->earnings->get('SUM(Credit) as TotalCredit', ['AccountName' => $accountname, 'Tag' => 'ProfitShare']);
            $data['ProfitShareEarned'] = $profitshareEarnedObj[0]['TotalCredit'];
            //get the total encashment
            $totalEncashmentObj = $this->earnings->get('SUM(Debit) as TotalDebit', ['AccountName' => $accountname, 'Tag' => 'Encashment']);
            $data['TotalEncashment'] = $totalEncashmentObj[0]['TotalDebit'] - $totalEarnedCreditObj[0]['TotalCredit'];
            //get the waiting points
            $account_parentid = $account[0]['AccountId'];
            $whereMP = "AccountId = $account_parentid";
            $InMP = $this->mp->get(['*'],$whereMP);
            $countMP = 0;
            if($InMP != false){
                $countMP = count($InMP);
            }
            $getpoints = $this->points->get('SUM(LeftPoints) as TotalL, SUM(RightPoints) as TotalR', ['AccountId' => $data['Account']['AccountId']]);
            $waitingdesc = 'L';
            if ($getpoints[0]['TotalL'] == 0) {
               $waitingdesc = 'R';
            }
            $data['WaitingPoints'] = abs($getpoints[0]['TotalL'] - $getpoints[0]['TotalR']) . $waitingdesc;
            //get the incentive poits
            $getincentivepoints = $this->ip->get('SUM(LeftPoints) as TotalL, SUM(RightPoints) as TotalR', ['AccountId' => $data['Account']['AccountId']]);
            $data['IncentivePoints'] = min($getincentivepoints[0]['TotalL'],$getincentivepoints[0]['TotalR'])??0;
            //get the latest logs in earnings
            $data['LatestEarnings'] = $this->earnings->get('*',['AccountName' => $accountname],['DateCreated' => 'desc'],20,0);
            $data['dblastquery'] = $this->db->last_query();
            //Get the lastest payout request which is active
            $data['LatestPayoutRequest'] = $this->pay->get('*',['AccountId' => $data['Account']['AccountId']],['PayoutId' => 'desc'],1);

            //var_dump($data);
            return $data;
        }

        //Recursive php function
        function category_tree($accountIdToUse, $position = null){
            
            //print_r($position);

            $level = 0; //for the limit of view

            $result = $this->network->get(['ParentId' => $accountIdToUse]);//usually it returns 1 or 2 the left and right position
            
            //print_r($result);
            if ($result != false) {
                foreach ($result as $res) {
                    //var_dump($res['NetworkId']);
                    $account_id = $res['AccountId'];
                    if ($position == 'left'){
                        $account_parentid = $_SESSION['OrigAccountToUse'];
                        $hasPair = $this->hasNoMatchPair($account_id, $account_parentid);
                        //var_dump($hasPair);
                        if ($hasPair) {
                            array_push($_SESSION['LeftBinaryIds'], $res['AccountId']); //save this array
                        }
                    }
                    else if($position == 'right'){
                        $account_parentid = $_SESSION['OrigAccountToUse'];
                        $hasPair = $this->hasNoMatchPair($account_id, $account_parentid);
                        if ($hasPair) {
                            array_push($_SESSION['RightBinaryIds'], $res['AccountId']); //save this array
                        }
                    }
                    else{
                        array_push($_SESSION['BinaryIds'], $res['NetworkId']); //save this array
                    }
                    

                    $getchilds = $this->network->get(["*"],'ParentId = '.$res['AccountId']);//usually it returns 1 or 2 the left and right position

                    //print_r($this->db->last_query());

                    if ($getchilds != false) {
                        $this->category_tree($res['AccountId'], $position);
                    }
                }
            }
            
        }

        public function hasNoMatchPair($childAccountId, $rootAccountId){
            $account_parentid = $rootAccountId;
            $where = "AccountId = $account_parentid and (LeftMember in ($childAccountId) or RightMember in ($childAccountId))";
            $excludeInMP = $this->mp->get(['*'],$where);
            //print_r($childAccountId);
            //print_r($excludeInMP);
            if ($excludeInMP != false) {
                return false;
            }
            else{
                return true;
            }
        }

        public function earnInMatchingPair($accountid = null){
            $_SESSION['LeftBinaryIds'] = [];
            $_SESSION['RightBinaryIds'] = [];
            $_SESSION['OrigAccountToUse'] = $accountid;
            //now we need to get the 2 account which is the left and the right
            $pos = $this->network->get(['ParentId' => $accountid]);
            if($pos != false && count($pos) == 2){
                $hasPair1 = $this->hasNoMatchPair($pos[0]['AccountId'], $accountid);
                $hasPair2 = $this->hasNoMatchPair($pos[1]['AccountId'], $accountid);
                if ($hasPair1) {
                    array_push($_SESSION['LeftBinaryIds'], $pos[0]['AccountId']);
                }
                if ($hasPair2) {
                    array_push($_SESSION['RightBinaryIds'], $pos[1]['AccountId']);
                }

                $this->category_tree($pos[0]['AccountId'],'left');
                $this->category_tree($pos[1]['AccountId'], 'right');
            }
            $countLeft = count($_SESSION['LeftBinaryIds']);
            $countRight = count($_SESSION['RightBinaryIds']);
            $loopToInsertCount = $countLeft;
            if($countLeft > $countRight){
                $loopToInsertCount = $countRight;
            }
            //if zero count then stop
            if ($countLeft == 0 || $countRight == 0) {
                $loopToInsertCount = 0;
            }

            //print_r($loopToInsertCount);
            if($loopToInsertCount != 0){
                //note earned base on package type
                //get the account for the package
                $account = $this->acc->get(['AccountId' => $accountid]);
                $accountcode = $this->code->get($account[0]['CodeId']);
                $accountpackage = $this->package->get($accountcode[0]['PackageId']);
                $accountname = $account[0]['AccountName'];
                $earnDailyMax = $accountpackage[0]['MatchSalesBonusDailyIncome'];
                //filter out that wasn't in the db
                $leftList = implode(', ', $_SESSION['LeftBinaryIds']);
                $rightList = implode(', ', $_SESSION['RightBinaryIds']);
                //get the last match of the current account name
                $lastMP = $this->mp->get(['*'], "AccountId = $accountid", ['MatchingPairId' => 'desc'], [0,1]);
                $place_number = 0;

                //start of process
                if($lastMP != false){
                    $place_number = $lastMP[0]['PlaceNumber'];
                }
                //make loop depends on the min of the left and right use count
                for ($i=0; $i < $loopToInsertCount; $i++) {
                    $place_number++;
                    $isExcluded = false;
                    //then insert in the member earnings
                    //get the earning daily if max then dont insert another earnings
                    $dateToday = date('Y-m-d');
                    $earnedToday = 0;
                    $getEarningsSumObj = $this->earnings->get('SUM(Credit) as EarnedToday', 'AccountName = "'.$accountname.'" and Tag = "Match" and DateCreated > "'.$dateToday.'"');
                    if ($getEarningsSumObj != false) {
                        $earnedToday = $getEarningsSumObj[0]['EarnedToday'];
                    }

                    //insert earned
                    if ($earnedToday < $earnDailyMax && $isExcluded == false) 
                    {
                        //insert the matching pair because of not exceeding the limit of commision
                        $leftid = $_SESSION['LeftBinaryIds'][$i];
                        $rightid = $_SESSION['RightBinaryIds'][$i]; 
                        $field = [
                            'AccountId' => $accountid,
                            'LeftMember' => $leftid,
                            'RightMember' => $rightid,
                            'PlaceNumber' => $place_number,
                            'IsExcluded' => $isExcluded,
                            'DateCreated' => date('Y-m-d H:i:s')
                        ];
                        $this->mp->insert($field);
                        //add MVP
                        //get the package of the left and right members
                        $leftaccount = $this->acc->get(['AccountId' => $leftid]);
                        $leftaccountcode = $this->code->get($leftaccount[0]['CodeId']);
                        $leftaccountpackage = $this->package->get($leftaccountcode[0]['PackageId']);
                        $rightaccount = $this->acc->get(['AccountId' => $rightid]);
                        $rightaccountcode = $this->code->get($rightaccount[0]['CodeId']);
                        $rightaccountpackage = $this->package->get($rightaccountcode[0]['PackageId']);
                        //insert MVP for rank
                        $this->method->addMvpPoints($account, $leftaccount[0]['AccountId'], $leftaccountpackage[0]['MVP']);
                        $this->method->addMvpPoints($account, $rightaccount[0]['AccountId'], $rightaccountpackage[0]['MVP']);
                        //add points for match points and incentive points
                        $waitingpoints = $this->method->addPoints($account, $leftaccountpackage[0]['MVP'], $rightaccountpackage[0]['MVP']);
                        //get the earned
                        $earn = 0;
                        if ($waitingpoints != false) {
                            $earn = $waitingpoints * ($accountpackage[0]['MatchSalesBonus']/$accountpackage[0]['MVP']);
                        }

                        //member side
                        $fieldinMember = [
                            'AccountName' => $accountname,
                            'Debit' => 0,
                            'Credit' => $earn,
                            'Tag' => 'Match',
                            'Description' => 'Waiting points deducted by '. $waitingpoints .'pts from Match Sales Bonus on '.date('Y-m-d H:i:s'),
                            'DateCreated' => date('Y-m-d H:i:s')
                        ];

                        $this->earnings->insert($fieldinMember);

                        //company
                        $fieldinCompany = [
                            'AccountName' => $accountname,
                            'Debit' => $earn,
                            'Credit' => 0,
                            'Tag' => 'Match',
                            'Description' => 'Waiting points deducted by '. $waitingpoints .'pts from Match Sales Bonus on '.date('Y-m-d H:i:s'),
                            'DateCreated' => date('Y-m-d H:i:s')
                        ];
                        $this->ledger->insert($fieldinCompany);

                        $this->method->logs('Waiting points deducted by '. $waitingpoints .'pts from Match Sales Bonus on '.date('Y-m-d H:i:s'));
                    }
                    else{
                        if ($isExcluded == true) {
                            $newPoints = $account[0]['IncentivePoints'] + 1;
                            $fieldE = [
                                'IncentivePoints' => $newPoints
                            ];
                            $this->acc->update($fieldE,['AccountId' => $accountid]);
                        }
                        else{
                            //this would be the maxearndaily was reached

                        }
                    }
                }
                return true;
            }
            
            return false;
        }

        public function getNetworkInfo($accountid = null){

            //first we need to get the 15 records to display
            //first the root then so on..
            $ids = [$accountid];
            $displayCnt = 15;//as of now all acc will display
            $accountIdToUse = $accountid;

            //call the recursive function to print category listing
            $_SESSION['BinaryIds'] = [];

            $this->category_tree($accountIdToUse);
            


            $select = [
                'Account.AccountId', 'Package.PackageName', 'Package.PackageId' , 'acc.AccountName as ParentName', 'Account.AccountName', 'Users.Picture', 'Users.Fullname', 'Network.*'
            ];

            $join = [
                'Account' => 'Account.AccountId = Network.AccountId',
                'Users' => 'Users.UsersId = Account.UsersId',
                'left Account as acc' => 'acc.AccountId = Network.ParentId',
                'left Codes' => 'Codes.CodeId = Account.CodeId',
                'left Package' => 'Package.PackageId = Codes.PackageId'
            ];
		
	    $where2 = 'Network.AccountId = '.$accountid;
	    $data2 = $this->network->getjointable($select,$join,$where2,null,null,['Network.DateAssigned' => 'asc']);
		
            //$where = 'Network.AccountId = '.$accountid ;
	    $where = ' ';
//             if (count($_SESSION['BinaryIds']) != 0) {
//                 $where .= ' OR ';
//             }

            if ($_SESSION['BinaryIds'] != false) {
                for ($i=0; $i < count($_SESSION['BinaryIds']); $i++) { 
                    $id = (int)$_SESSION['BinaryIds'][$i];
                    $where .= ' Network.NetworkId = ' . $id;
                    // print_r(count($_SESSION['BinaryIds']));
                    // print_r($_SESSION['BinaryIds']);
                    if ($i+1 != count($_SESSION['BinaryIds'])) {
                        # if the length is not equal then display the OR
                        $where .= ' OR ';
                    }
                }
            }
            if (count($_SESSION['BinaryIds']) == 0) {
                return $data2;
            }
            else{
                $data = $this->network->getjointable($select,$join,$where,null,null,['Network.DateAssigned' => 'asc']);
                $data2 = array_merge($data2,$data);
                    //var_dump($this->db->last_query());
                return $data2;
            }
        }

        public function getToBeAssignMember($accountid = null){
            if ($accountid != null) {
                $account = $this->account->get($accountid);
                //get the network with the account of parentid of this parameter
                $select = [
                    'Network.NetworkId',
                    'CONCAT(Users.Fullname, " (", Account.AccountName, ")") as Fullname'
                ];
                $join = [
                    'Account' => 'Account.AccountId = Network.AccountId',
                    'Users' => 'Users.UsersId = Account.UsersId'
                ];
                $where = "Account.ReferredById = '" . $account[0]['AccountName'] . "' and Network.ParentId is null";

                $res = $this->net->getjointable($select, $join, $where, null, null,['Users.Fullname' => 'asc']);

                return $res;
            }
        }


        public function addMvpPoints($account = null, $fromAccountId = 0, $points = 0){

            if ($account != null && $fromAccountId != 0) {
                $field = [
                    'AccountId' => $account[0]['AccountId'],
                    'FromAccountId' => $fromAccountId,
                    'Points' => $points,
                    'DateCreated' => date('Y-m-d H:i:s')
                ];

                //insert the mvp
                $mvp = $this->mvp->insert($field);
                //then update the account to get the updated data
                //get the total points
                $getSumMvp = $this->mvp->get('SUM(Mvp.Points) as TotalPoints',['AccountId' => $account[0]['AccountId']]);
                $totalPoints = $getSumMvp[0]['TotalPoints'];
                //update the acc
                $thisAccount = $this->account->update([
                    'TotalMVP' => $totalPoints,
                    'CurrentMVP' => $totalPoints
                ], $account[0]['AccountId'], 1);

                return $thisAccount;
            }
            else{
                return false;
            }

        }

        public function addPoints($account = null, $leftpoints = 0, $rightpoints = 0){
            if ($account != null) {
                $accountid = $account[0]['AccountId'];
                $field = [
                    'AccountId' => $accountid,
                    'LeftPoints' => $leftpoints,
                    'RightPoints' => $rightpoints,
                ];

                //insert the points
                $p = $this->points->insert($field);
                $ip = $this->ip->insert($field);
                
                //add earned
                //get all the points from right and the left
                $getpoints = $this->points->get('SUM(LeftPoints) as TotalL, SUM(RightPoints) as TotalR', ['AccountId' => $accountid]);
                //get the match points available as waiting points
                $waitingpoints = min($getpoints[0]['TotalL'], $getpoints[0]['TotalR'])??0;
                //either of l or r will be zero if no points added it will return to 0 instead
                if ($waitingpoints > 0) {
                    //insert the counter part points to make it points
                    $wpfield = [
                        'AccountId' => $accountid,
                        'LeftPoints' => -abs($waitingpoints),
                        'RightPoints' => -abs($waitingpoints),
                    ]; 
                    $p = $this->points->insert($wpfield);
                }

                return $waitingpoints;
            }
            else{
                return false;
            }

        }

        //Earning side
        public function addEarnedInReferral($accountname, $newmemberaccountname){
            //get the account for the package
            $account = $this->acc->get(['AccountName' => $newmemberaccountname]);
            $accountcode = $this->code->get($account[0]['CodeId']);
            $accountpackage = $this->package->get($accountcode[0]['PackageId']);

            //get the earned
            $earn = $accountpackage[0]['DirectSalesBonus'];

            //member
            $fieldinMember = [
                'AccountName' => $accountname,
                'Debit' => 0,
                'Credit' => $earn,
                'Tag' => 'Referral',
                'Description' => 'Referral from '.$newmemberaccountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];

            $this->earnings->insert($fieldinMember);

            //company
            $fieldinCompany = [
                'AccountName' => $accountname,
                'Debit' => $earn,
                'Credit' => 0,
                'Tag' => 'Referral',
                'Description' => 'Referral from '.$newmemberaccountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];
            $this->ledger->insert($fieldinCompany);

            $this->method->logs($newmemberaccountname . ' added referral to ' . $accountname);
        }

        public function logs($description = null){

            $field = [
                'Description' => $description,
                'DateCreated' => date('Y-m-d H:i:s')
            ];

            $this->logs->insert($field);
        }

        public function addCashBackReward($accountname){
            //get the account for the package
            $account = $this->acc->get(['AccountName' => $accountname]);
            $accountcode = $this->code->get($account[0]['CodeId']);
            $accountpackage = $this->package->get($accountcode[0]['PackageId']);

            //get the earned
            $earn = $accountpackage[0]['CashBackReward'];

            //member
            $fieldinMember = [
                'AccountName' => $accountname,
                'Debit' => 0,
                'Credit' => $earn,
                'Tag' => 'Cash Back Reward',
                'Description' => 'Cash Back Reward from '.$accountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];

            $this->earnings->insert($fieldinMember);

            //company
            $fieldinCompany = [
                'AccountName' => $accountname,
                'Debit' => $earn,
                'Credit' => 0,
                'Tag' => 'Cash Back Reward',
                'Description' => 'Cash Back Reward from '.$accountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];
            $this->ledger->insert($fieldinCompany);

            $this->method->logs('Cash Back Reward from '.$accountname.' on '.date('Y-m-d H:i:s'));
        }
}
