<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_m extends Generic{

	protected $_table = 'User';
	protected $_primary_key = 'UserId';

	function __construct(){
		parent:: __construct();
	}
}
