<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mvp_m extends Generic{

	protected $_table = 'Mvp';
	protected $_primary_key = 'MvpId';

	function __construct(){
		parent:: __construct();
	}
}
