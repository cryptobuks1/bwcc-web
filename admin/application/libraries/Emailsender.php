<?php 

Class Emailsender
{
	public $config = array();
	public function __construct()
	{
		$this->config = array(
	        'protocol' => 'mail',
	        'smtp_host' => 'mail.tokosodara.com',
	        'smtp_port' => 587,
	        'smtp_user' => 'no-reply@tokosodara.com',
	        'smtp_pass' => 'sodara606060',
	        'mailtype'  => 'html', 
	        'charset'   => 'iso-8859-1'
	    );
	}

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	function send($to, $subject, $message){
	    $this->load->library('email', $this->config);
	    $this->email->set_newline("\r\n");
	    $this->email->set_mailtype("html");
	    
	    // Sender email address
	    $this->email->from('no-reply@tokosodara.com', 'Toko Sodara Mailer');
	    // Receiver email address.for single email
	    //$this->email->to($to);
	    //send multiple email
	    // $to = $to.',tanyarisan@gmail.com,mutirelegi@gmail.com,choxaneh@gmail.com,windi@tokosodara.com,rosya@tokosodara.com';
	    $this->email->to($to);
	    // Subject of email
	    $this->email->subject($subject);
	    // Message in email
	    $this->email->message($message);

	    $result = $this->email->send();
	}

	public function send_vendor_registration($email, $dataSender)
	{
		$body = $this->load->view('template/email/vendor_registration.php', $dataSender, TRUE);
		$this->send($email, 'Toko Sodara - New Vendor Registration', $body);
	}
}