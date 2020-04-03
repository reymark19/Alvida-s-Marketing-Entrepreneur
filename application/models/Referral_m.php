<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Referral_m extends Generic{

	protected $_table = 'Referral';
	protected $_primary_key = 'ReferralId';

	function __construct(){
		parent:: __construct();
	}
}
