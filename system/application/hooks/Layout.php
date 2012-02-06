<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
	function getLayout() {
		$CI =& get_instance();
		     
		$content = $CI->output->get_output();
    	if(empty($content)) {
    		global $class, $method;
    		$content = $CI->load->view($class . '/' . $method, $CI->data, TRUE);
    	}
    	
    	if (isset($CI->layout)) {
      		$output = $CI->load->view('layouts/' . $CI->layout, array('main_layout_content' => $content), TRUE);
    	} else {
      		$output = $content;
    	}
    	
    	global $OUT;
    	$OUT->_display($output);
	}
}  

?>