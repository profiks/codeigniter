<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Controller for output native CI calendar
 */
class Callendar extends CI_Controller {
    
   /**
    *@return calendar
    */ 
      function index(){
        
        $this->load->library('calendar');

echo $this->calendar->generate();
      }
    
}
    
    