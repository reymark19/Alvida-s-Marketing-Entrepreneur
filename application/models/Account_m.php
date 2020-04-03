<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Account_m extends Generic{

	protected $_table = 'Account';
	protected $_primary_key = 'AccountId';

	function __construct(){
		parent:: __construct();
	}
}
