<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Earnings_m extends Generic{

	protected $_table = 'Earnings';
	protected $_primary_key = 'EarnId';

	function __construct(){
		parent:: __construct();
	}
}
