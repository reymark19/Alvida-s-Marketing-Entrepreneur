<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class File_m extends Generic{

	protected $_table = 'File';
	protected $_primary_key = 'FileId';

	function __construct(){
		parent:: __construct();
	}
}
