<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Code_m extends Generic{

	protected $_table = 'Codes';
	protected $_primary_key = 'CodeId';

	function __construct(){
		parent:: __construct();
	}
}
