<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//AUTHOR: NINO ALCUINO
//DATE: 06/07/17
//DESCRIPTION: CRUD that apply to all table

Class Generic extends CI_Model{

	protected $_table = null;
	protected $_primary_key = null;

	function __construct(){
		parent:: __construct();
	}


	//Session side
	
	function isAdmin(){
		if (!isset($_SESSION['UserId'])) {
            redirect(base_url().'Login');
        }
     	if ($_SESSION['IsAdmin'] != 1) {
            redirect(base_url().$_SESSION['MenuName']);
        }   

	}

	function isUser(){
		if (!isset($_SESSION['UsersId'])) {
            redirect(base_url().'Login');
        }
	}
	
	//NINO
	//get a records in specific table in id
	//it can be 
	//'array' 	- means many conditiom, 
	//'' 		- means all, 
	//'id' 		- means specific
	function get($select = null, $whereQuery = null,$order_by = 'asc', $limit = null, $start = 0){

		if(is_null($select)){}else{

			if(!is_numeric($select) && !is_null($whereQuery)){

				$this->db->select($select);

				if(is_string($whereQuery)){
					$this->db->where($whereQuery);
				}
				//updated on 07/31/17 by Vincent
				if (is_array($whereQuery)) {
					foreach($whereQuery as $key => $value) {
						//VINCENT 07/27/17
						//If you want to use OR clause in WHERE. Just put OR next to the index of $where array
						$whereType = substr($key, 0, 2);
						$newKey = substr($key, 2);
						if ($whereType == 'OR') {
							$this->db->or_where($newKey,$value);
						}
						else {
							$this->db->where($key,$value);
						}
					}
				}

			}
			elseif(is_numeric($select)){
				$this->db->where($this->_primary_key, $select);
			}
			elseif(is_array($select))
			{
				foreach ($select as $_key => $_value) {
					$this->db->where($_key, $_value);
				}
			}

		}

		
		//limit
		if(is_array($limit)){
			$this->db->limit($limit);
		}
		elseif(is_numeric($limit) && is_numeric($start)){
			$this->db->limit($limit,$start);
		}
		
		
		//NINO
		//Date: 11/04/17
		//To add asc or desc of what field
		//use cnt to prevent error
		//How to used: Array = ['FieldName'=>'asc/desc'], String = 'asc/desc'
		if(is_array($order_by)){
			$cnt = 1;
			foreach ($order_by as $key => $value) {
				if($cnt == 1){
					$this->db->order_by($key,$value);
					$cnt++;
				}
			}
		}
		else{
			$this->db->order_by($this->_primary_key,$order_by);
		}
		
		$query = $this->db->get($this->_table);

		if($query->num_rows() > 0){
			//NINO: Reason to change to Result_Array 
			//because of the conflict in the getting the id
			//return $query->result();
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	//NINO
	//Send Email
	function sendEmail($to = null,$subject = null,$message = null,$from = null){
		if($to != null && $subject != null && $message != null){
			$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'puntaaguila2017@gmail.com',
                'smtp_pass' => 'hotel2017',
                'mailtype'  => 'html', 
                'charset'   => 'utf-8'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $email_body ="<div>".$message."</div>";
		    $this->email->from("puntaaguila.laiya@gmail.com",'Punta Aguila Resort and Hotel');

		    $list = $to;
		    $this->email->to($list);
		    $this->email->subject($subject);
		    $this->email->message($email_body);
		    
			$mail = $this->email->send();

			if($mail){
				return true;
			}
			else{
				return $this->email->print_debugger();
			}
		}
		else{
			return false;
		}
	}

	//NINO
	//Get joined tables
	//06/23/17
	//Example
	//$join = array(
	//	'Employee' => 'Employee.PersonId = User.PersonId',
	//	'Admin' => 'Admin.PersonId = User.PersonId'
	//);
	//$result = $this->p->getjointable(['User.LastName'],$join,null,null);
	function getjointable($select = null,$join = null,$where = null,$id = null,$distinct = null, $orderby = null,$mode = 0){
		$this->db->select($select);
		$this->db->from($this->_table);
		foreach ($join as $table => $onTable) {
			$joinType = substr($table, 0,4);
			if(strpos($joinType, 'left') !== false){
				$table = substr($table, 4);
				$this->db->join($table,$onTable,$joinType);
			}
			else{
				$this->db->join($table,$onTable);
			}
		}
		if(is_null($where)){/*No display*/}else{
			//vincent updated on 07/25/17
			if (is_array($where)) {
				if ($mode == 1) {
					foreach ($where as $_key => $_value) {
						$this->db->where_in($_key, $_value);
					}
				}
				elseif ($mode == 0) {
					foreach($where as $key => $value) {
						//VINCENT 07/27/17
						//If you want to use OR clause in WHERE. Just put OR next to the index of $where array
						$whereType = substr($key, 0, 2);
						$newKey = substr($key, 2);
						if ($whereType == 'OR') {
							$this->db->or_where($newKey,$value);
						}
						else {
							$this->db->where($key,$value);
						}
					}
				}
				//end of where
			}
			else {
				$this->db->where($where,$id);
			}
		}
		if (is_null($distinct)) {/*No display*/}else{
			$this->db->distinct($distinct);
		}

		//VINCENT I add orderby clause for sorting
		if (is_array($orderby)) {
			//the orderby array is consist of 1 key and value only
			foreach($orderby as $column => $ordertype) {
				$this->db->order_by($column, $ordertype);
			}
		}
		
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else{
			return false;
		}
	}

	//NINO
	//Insert a records in specific table
	//'array' - means data to be inserted
	function insert($data, $isReturnData = false){
		
		$this->db->insert($this->_table,$data);

		if($this->db->affected_rows() > 0){
			if($isReturnData){
				$this->db->select('max('.$this->_primary_key.') as id');
				//we use Username because it is Unique
				$query = $this->db->get($this->_table);
				$id = $query->result_array();
				return $this->get($id[0]['id']);
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}

	//NINO
	//Insert a records in specific table and return a Id
	//'array' - means data to be inserted
	function insertGetId2($data){
		
		$this->db->insert($this->_table,$data);

		if($this->db->affected_rows() > 0){

			$this->db->select($this->_primary_key);
			//we use Username because it is Unique
			$this->db->where('Username', $data['Username']);
			$query = $this->db->get($this->_table);
			$id = $query->result_array();
			return $id[0]['PersonId'];
		}
		else{
			return false;
		}
	}

	//v2
	//Insert a records in specific table and return a Id
	//'array' - means data to be inserted
	function insertGetId($data){
		
		$this->db->insert($this->_table,$data);

		if($this->db->affected_rows() > 0){

			$this->db->select('max('.$this->_primary_key.') as id');
			//we use Username because it is Unique
			$query = $this->db->get($this->_table);
			$id = $query->result_array();
			return $id[0]['id'];
		}
		else{
			return false;
		}
	}


	//NINO
	//Update a records in specific table
	//'id,array' 	- means update only 1 records
	//'array,array 	- means update multiple records
	function update($new_data, $where = 0, $isReturnData = false){
		if(is_numeric($where)){
			$this->db->where($this->_primary_key, $where);
		}
		else if(is_array($where)){
			foreach ($where as $_key => $_value) {
				$this->db->where($_key, $_value);
			}
		}
		else{
			//nino
			//$this->db->where($this->_primary_key, $where);
			$this->db->where($where);
		}

		$this->db->update($this->_table, $new_data);

		if($this->db->affected_rows() > 0){
			if($isReturnData){
				$this->db->select($this->_primary_key.' as id');
				//Where state here it cause error in getting the record because of the max
				if(is_numeric($where)){
					$this->db->where($this->_primary_key, $where);
				}
				else if(is_array($where)){
					foreach ($where as $_key => $_value) {
						$this->db->where($_key, $_value);
					}
				}
				else{
					$this->db->where($where);
				}
				//we use Username because it is Unique
				$query = $this->db->get($this->_table);
				$id = $query->result_array();
				return $this->get($id[0]['id']);
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}

	//NINO
	//delete a records in specific table 
	//it can be 
	//'array' 			 - means many conditiom,
	//'id' 				 - means specific id to delete
	//'FieldName, Array' - means delete mutiple records in specific field
	function delete($id = 0, $data = null){

		if(is_numeric($id)){
			$this->db->where($this->_primary_key, $id);
		}
		elseif(is_array($id)){
			foreach ($id as $_key => $_value) {
				$this->db->where_in($_key, $_value);
			}
		}
		elseif(!is_numeric($id) && is_array($data)){
			//this could delete multiple records
			$this->db->where_in($id, $data);
		}
		else{
			$this->db->where($this->_primary_key, $id);
		}

		$this->db->delete($this->_table);

		if($this->db->affected_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function isExisted($where){
		foreach ($where as $field => $value) {
			$this->db->where($field, $value);
		}

		$this->db->get($this->_table);

		if($this->db->affected_rows() == 0){
			//it means no data found in table
			return false;
		}
		else{
			return true;
		}
	}

	

    //AUTHOR: NINO ALCUINO
    //DATE CREATED: 080217
    //DESCRIPTION:
    //	USE FOR SERVERSIDE DATATABLE
    //STRUCTURE:
    //	 VARIABLES:
    //		SELECT   - USE TO SELECT COLUMNS IN DB
    //		FROM     - THE PARENT TABLE
    //		JOIN     - JOINING TABLE
    //		WHERE    - CAN BE USED AS IF:
    //				   ID ONLY - GET RECORD BASED ON PRIMARY KEY OF PARENT TABLE
    //				   ARRAY   - GET RECORDS BASED ON ARRAY[COLUMN=VALUE]
    //				   STRING  - GET RECORDS BASED ON WHAT QUERY STATEMENT
    //		ID 	     - USED ONLY IF THE WHERE IS RETURNS ID
    //		DISTINCT - DISTINCT THE TABLE[RARE]
    function get_datatables_query($select = null,$from = null,$join = null,$where = null,$id = null,$distinct = null,$columnSearch = null,$order_by = null, $having = null)
    {
    	//SELECT THE COLUMN
 		$this->db->select($select);
 		//SELECT THE PARENT TABLE
		$this->db->from($from);
		//JOINING PROCESS
		if($join != null)
		{
			foreach ($join as $table => $onTable) {
				$joinType = substr($table, 0,4);
				//left must be lowercase
				if(strpos($joinType, 'left') !== false){
					$table = substr($table, 4);
					$this->db->join($table,$onTable,$joinType);
				}
				else{
					$this->db->join($table,$onTable);
				}
			}
		}
		//WHERE STATEMENT START HERE
		//IF NO CONDITION PROCEED TO LIKE STATEMENT FROM DATATABLE
		if(is_null($where)){
			$this->dataTableSearch($columnSearch);
		}
		else{
			//IF IT IS ARRAY
			if (is_array($where)) {
				foreach($where as $key => $value) {
					//VINCENT 07/27/17
					//If you want to use OR clause in WHERE. Just put OR next to the index of $where array
					$whereType = substr($key, 0, 2);
					$newKey = substr($key, 2);
					if ($whereType == 'OR') {
						$this->db->or_where($newKey,$value);
					}
					else {
						$this->db->where($key,$value);
					}
				}
				//LIKE STATEMENT FROM DATATABLE
				$this->dataTableSearch($columnSearch);
			}
			elseif(is_string($where)) {
				$this->db->where($where);
				//LIKE STATEMENT FROM DATATABLE
				$this->dataTableSearch($columnSearch);
			}
			else {
				$this->db->where($where,$id);
				//LIKE STATEMENT FROM DATATABLE
				$this->dataTableSearch($columnSearch);
			}
		}

		if (!is_null($having)) {
			$this->db->having($having);
		}

		if (is_null($distinct)) {/*No display*/}else{
			$this->db->distinct($distinct);
			//LIKE STATEMENT FROM DATATABLE
			$this->dataTableSearch($columnSearch);
		}
		//END OF COND1ITION PROCESS
		if(is_array($order_by))
		{
			foreach($order_by as $keyOrder => $type)
			{
				$this->db->order_by($keyOrder, $type);
			}
    	}
    	else
    	{
    		$this->db->order_by($this->_primary_key,$order_by);	
    	}
    }
 	
 	//AUTHOR: NINO ALCUINO
 	//DATE CREATED: 080217
 	//DESCRIPTION:
 	//	THIS STATEMENT USE TO EXECUTE THE QUERY THIS WILL BE USED IN CONTROLLER
    function get_datatables($select = null,$join = null,$where = null,$id = null,$distinct = null, $columnSearch = null, $order_by = null, $having = null)
    {
        $this->get_datatables_query($select,$this->_table,$join,$where,$id,$distinct,$columnSearch,$order_by,$having);
        if($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        //FINAL OUTPUT HERE
        return $query->result();
    }
 	//AUTHOR: NINO ALCUINO
 	//DATE CREATED: 080217
 	//DESCRIPTION:
 	//	THIS STATEMENT USE TO GET THE TOTAL NUMBER OF AFFECTED ROWS THIS WILL BE USED IN CONTROLLER
    function count_filtered($select = null,$join = null,$where = null,$id = null,$distinct = null, $columnSearch = null, $order_by = null, $having = null)
    {
        $this->get_datatables_query($select,$this->_table,$join,$where,$id,$distinct,$columnSearch,$order_by,$having);
        $query = $this->db->get();
        return $query->num_rows();
    }

 	//AUTHOR: NINO ALCUINO
 	//DATE CREATED: 080217
 	//DESCRIPTION:
 	//	THIS STATEMENT USE TO GET THE TOTAL NUM OF ROWS THIS WILL BE USED IN CONTROLLER
    public function count_all()
    {
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    //AUTHOR: NINO ALCUINO
 	//DATE CREATED: 080217
 	//DESCRIPTION:
 	//	THIS STATEMENT USED TO EXECUTE THE LOOP IN SEARCHING VALU
 	//REASON: AVOID REDUNDANCY OF CODE
    public function dataTableSearch($columnSearch = null){
    	$i = 0;
    	$like='';
        foreach ($columnSearch as $column_name) //loop column 
        {
        	
            if($this->input->post('search[value]')) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $like = $column_name.' LIKE "%'.$this->input->post('search[value]').'%" ';
                }
                else
                {
                    $like = $like .' OR '.$column_name.' LIKE "%'.$this->input->post('search[value]').'%"';
                }
            }
            $i++;
        }
        if($this->input->post('search[value]') != null){
        	//print_r($like);
        	$this->db->having($like);
        }
        
    }


    //NINO ALCUINO
    //060118
    public function upload($id = null, $name, $sizeLimit = 5.5, $returndata = false, $processtype = 1,$campaignid=null)
    {
    	$target_dir = "./upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $fileToSave = "upload/".basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $sizeLimit = $sizeLimit * 100000;
        $allowFile = [
        	'JPG',"jpg","png","jpeg","gif","pdf","PNG"
        ];
    	$uploadOk = 1;
        if($_FILES["file"]["size"] == 0){
        	$msg['error'] = "Sorry, cannot be uploaded.";
            $uploadOk = 0;
            return $msg;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $msg['error'] = "Sorry, file already exists.";
            $uploadOk = 0;
            return $msg;
        }
        // Check file size
        if ($_FILES["file"]["size"] > $sizeLimit) {
            $msg['error'] = "Sorry, your file is too large.";
            $uploadOk = 0;
            return $msg;
        }
        // Allow certain file formats
        if(!in_array($FileType, $allowFile)){
        	$msg['error'] = "Sorry, your file is not allowed.";
            $uploadOk = 0;
            return $msg;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg['error'] = " Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            $RandomAccountNumber = uniqid();
            $Random = $target_dir . $RandomAccountNumber . date('YmdHis') .'.'. $FileType;
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $Random)) {
                //get the old image
                if ($id != null) {
                	# code...
                	$obj = $this->get($id);
	                $deleteOldFile = @unlink($obj[0]["Path"]);
	                if ($processtype == 1) {
	                	$field = [
		                	"Path" => $Random, 
		                	"FileName" => $name,
		                	"Type"=> $FileType,
		                	"Size"=>$_FILES["file"]["size"],
		                	"CampaignId"=>$campaignid
		                ];
	                }
	                elseif ($processtype == 2) {
	                	$field = [
		                	"Path" => $Random
		                ];
	                }
	                
	                $msg['DeleteOldImage'] = $deleteOldFile;
	                $msg['data'] = $this->update($field,$id,$returndata);
	                $msg['query'] = $this->db->last_query();
	                $msg['success'] = true;
	                return $msg;
                }
                else{
                	if ($processtype == 1) {
	                	$field = [
		                	"Path" => $Random, 
		                	"FileName" => $name,
		                	"Type"=> $FileType,
		                	"Size"=>$_FILES["file"]["size"],
		                	"DateCreated"=>date('Y-m-d H:i:s'),
		                	"IsActive"=> 1,
		                	"CampaignId"=>$campaignid
		                ];
	                }
	                elseif ($processtype == 2) {
	                	$field = [
		                	"Path" => $Random
		                ];
	                }
	                
	                $msg['data'] = $this->insert($field,$returndata);
	                $msg['query'] = $this->db->last_query();
	                $msg['success'] = true;
	                return $msg;
                }
                
            } else {
                $msg['error'] = "Sorry, there was an error uploading your file.";
                return $msg;
            }
        }
    }

    public function uploadBulk($count,$id = null, $name, $sizeLimit = 5.5, $returndata = false, $processtype = 1)
    {
    	$target_dir = "./upload/";
        $target_file = $target_dir . basename($_FILES["files"]["name"][$count]);
        $fileToSave = "upload/".basename($_FILES["files"]["name"][$count]);
        $uploadOk = 1;
        $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $sizeLimit = $sizeLimit * 100000;
        $allowFile = [
        	'JPG',"jpg","png","jpeg","gif","pdf","PNG"
        ];
    	$uploadOk = 1;
        if($_FILES["files"]["size"][$count] == 0){
        	$msg['error'] = "Sorry, cannot be uploaded.";
            $uploadOk = 0;
            return $msg;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $msg['error'] = "Sorry, file already exists.";
            $uploadOk = 0;
            return $msg;
        }
        // Check file size
        if ($_FILES["files"]["size"][$count] > $sizeLimit) {
            $msg['error'] = "Sorry, your file is too large.";
            $uploadOk = 0;
            return $msg;
        }
        // Allow certain file formats
        if(!in_array($FileType, $allowFile)){
        	$msg['error'] = "Sorry, your file is not allowed.";
            $uploadOk = 0;
            return $msg;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg['error'] = " Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {

            $RandomAccountNumber = uniqid();
            $Random = $target_dir . $RandomAccountNumber . date('YmdHis') .'.'. $FileType;
            if (move_uploaded_file($_FILES["files"]["tmp_name"][$count], $Random)) {
                //get the old image
                if ($id != null) {
                	# code...
                	$obj = $this->get($id);
	                $deleteOldFile = @unlink($obj[0]["Path"]);
	                if ($processtype == 1) {
	                	$field = [
		                	"Path" => $Random, 
		                	"FileName" => $name,
		                	"Type"=> $FileType,
		                	"Size"=>$_FILES["files"]["size"][$count]
		                	
		                ];
	                }
	                elseif ($processtype == 2) {
	                	$field = [
		                	"Path" => $Random
		                ];
	                }
	                
	                $msg['DeleteOldImage'] = $deleteOldFile;
	                $msg['data'] = $this->update($field,$id,$returndata);
	                $msg['query'] = $this->db->last_query();
	                $msg['success'] = true;
	                return $msg;
                }
                else{
                	if ($processtype == 1) {
	                	$field = [
		                	"Path" => $Random, 
		                	"FileName" => $name,
		                	"Type"=> $FileType,
		                	"Size"=>$_FILES["files"]["size"][$count],
		                	"DateCreated"=>date('Y-m-d H:i:s'),
		                	"IsActive"=> 1
		                	
		                ];
	                }
	                elseif ($processtype == 2) {
	                	$field = [
		                	"Path" => $Random
		                ];
	                }
	                
	                $msg['data'] = $this->insert($field,$returndata);
	                $msg['query'] = $this->db->last_query();
	                $msg['success'] = true;
	                return $msg;
                }
                
            } else {
                $msg['error'] = "Sorry, there was an error uploading your file.";
                return $msg;
            }
        }
    }

}

