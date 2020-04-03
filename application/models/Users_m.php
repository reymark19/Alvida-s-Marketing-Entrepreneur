<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Users_m extends Generic{

	protected $_table = 'Users';
	protected $_primary_key = 'UsersId';

	function __construct(){
		parent:: __construct();
	}
}
