<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class MatchingPair_m extends Generic{

	protected $_table = 'MatchingPair';
	protected $_primary_key = 'MatchingPairId';

	function __construct(){
		parent:: __construct();
	}
}
