
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include model/API_Link_Enum
require APPPATH.'/models/api_link_enum.php';

class Backup extends CI_Controller {
   public function __construct() {
    parent::__construct();
   // $this->load->model('function_modeler');
    $this->load->model('restaurantenum');
    $this->load->helper('url');
     Api_link_enum::initialize();
    
    
  }

  public function index() {
			// Load the DB utility class
			$this->load->dbutil();

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup(); 

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('mybackup.zip', $backup); 

			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('mybackup.zip', $backup);
      
      
}
}
