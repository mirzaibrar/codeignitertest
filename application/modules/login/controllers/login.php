<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
    }


    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
                if($this->session->userdata('status'))
                {
                        $data['username']    =   $this->session->userdata('username');
                        echo "Welcome <strong>" . $data['username']."!</strong>";
                }
                else
                {
                 	$this->load->view('login_form');
                }
	}
        
        /*
         * @method verify the username and password posted by login form
         * @author  Muhammad Ibrar
         * @version 1.0.0
         * @license GNU/GPL General Public License
         */
        public function verify()
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                print_r($_POST);
            }
        }
}
        
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */