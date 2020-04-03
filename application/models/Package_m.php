<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Package_m extends Generic{

	protected $_table = 'Package';
	protected $_primary_key = 'PackageId';

	function __construct(){
		parent:: __construct();
	}
}
