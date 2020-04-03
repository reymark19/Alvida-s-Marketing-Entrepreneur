<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Network_m extends Generic{

	protected $_table = 'Network';
	protected $_primary_key = 'NetworkId';

	function __construct(){
		parent:: __construct();
	}
}
