<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function index()
	{
		
	    $data['filedata'] = [];
	    
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
		$this->google_spreadsheet->init(
			$_SESSION['access_token'],
			$_SESSION['refresh_token'],
			'client_id',
			'client_secret_key'
		);
        $range = 'Class Data!A2:E';

		if (true === $this->google_spreadsheet->find_spreadsheet('userdata')) {
			$response = $this->google_spreadsheet->get('userdata', $range);
            $values = $response->getValues();
        
            if (!empty($values)) {
                $data['filedata'] = $values;
            } 
		}
		$this->load->view("sheetdata",$data);
	}

	public function oauth()
	{
		
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
		$ret = $this->google_spreadsheet->oauth_request_handler(
			'983699820708-regm92sn2q2e3rppb3ta8js1j4mnujlt.apps.googleusercontent.com',//client_id
			'rmLPuJNK-Hcny5Cvi9r7-_Hj',//client_secret_key
			// scope
			array(
				'https://www.googleapis.com/auth/spreadsheets',
				'https://spreadsheets.google.com/feeds',
			),
			// enable offline
			true,
			preg_replace("{//[^/]+/}", "//" . $this->input->server('HTTP_HOST') . "/", current_url())
		);

		if ($ret['action'] == 'redirect') {
			redirect($ret['data'], 'location', 301);
			return;
		}
        
        $_SESSION['access_token']= $ret['access_token'];	
        $_SESSION['refresh_token']= $ret['refresh_token'];
        redirect('/index.php/welcome/index');
	}

}
