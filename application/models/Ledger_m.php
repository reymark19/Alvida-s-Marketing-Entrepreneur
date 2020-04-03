<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Ledger_m extends Generic{

	protected $_table = 'Ledger';
	protected $_primary_key = 'LedgerId';

	function __construct(){
		parent:: __construct();
	}
}
