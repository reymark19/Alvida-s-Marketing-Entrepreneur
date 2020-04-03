<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Points_m extends Generic{

	protected $_table = 'Points';
	protected $_primary_key = 'PointId';

	function __construct(){
		parent:: __construct();
	}
}
