<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Logs_m extends Generic{

	protected $_table = 'Logs';
	protected $_primary_key = 'LogId';

	function __construct(){
		parent:: __construct();
	}
}
