<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Report_m extends Generic{

	protected $_table = 'Report';
	protected $_primary_key = 'ReportId';

	function __construct(){
		parent:: __construct();
	}
}
