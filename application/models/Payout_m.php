<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Payout_m extends Generic{

	protected $_table = 'Payout';
	protected $_primary_key = 'PayoutId';

	function __construct(){
		parent:: __construct();
	}
}
