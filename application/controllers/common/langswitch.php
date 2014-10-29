<?php
// Switch Language 
// Added by Jeni 2014-09-19
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class LangSwitch extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function switchLanguage($language = "") 
	{
	    $url = $_GET['url'];
		$language = ($language != "") ? $language : 'english';
		$this->session->set_userdata('site_lang', $language);
		redirect($url);
	}
}