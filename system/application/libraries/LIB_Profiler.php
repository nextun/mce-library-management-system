<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	This profiler class extends the CI profiler class to account for 
 *	multiple database connections.
 *
 *	Prior to use, please review the tutorial here. You will need to make
 *	some minor config changes to support this librarie.
 * 
 *	http://www.gotphp.com/php/2008/10/25/codeigniter-multiple-database-support/
 *
 *	@author	Michael Fountain
 */
class LIB_Profiler extends CI_Profiler {
 
	/**
	 * Compile Multiple Database Queries
	 * @return	string
	 */	
	function _compile_multi_db_queries($database, $model)
	{
		if (count($this->CI->$model->$database->queries) == 0) {
			return "";
		}
		$output  = "\n\n";
		$output .= '<fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
		$output .= "\n";
 
		if ( ! class_exists('CI_DB_driver'))
		{
			$output .= '<legend style="color:#0000FF;">&nbsp;&nbsp;'.strtoupper($database).'&nbsp;('.$model.')&nbsp;</legend>';
			$output .= "\n";		
			$output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
			$output .="<tr><td width='100%' style='color:#0000FF;font-weight:normal;background-color:#eee;'>".$this->CI->lang->line('profiler_no_db')."</td></tr>\n";
		}
		else
		{
			$output .= '<legend style="color:#0000FF;">&nbsp;&nbsp;'.strtoupper($database).'&nbsp;('.$model.')&nbsp;('.count($this->CI->$model->$database->queries).')&nbsp;&nbsp;</legend>';
			$output .= "\n";		
			$output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
 
			if (count($this->CI->$model->$database->queries) == 0)
			{
				$output .= "<tr><td width='100%' style='color:#0000FF;font-weight:normal;background-color:#eee;'>".$this->CI->lang->line('profiler_no_queries')."</td></tr>\n";
			}
			else
			{
				$highlight = array('SELECT', 'FROM', 'WHERE', 'AND', 'LEFT JOIN', 'ORDER BY', 'LIMIT', 'INSERT', 'INTO', 'VALUES', 'UPDATE', 'OR', 'OFFSET');
 
				foreach ($this->CI->$model->$database->queries as $key => $val)
				{
					$val = htmlspecialchars($val, ENT_QUOTES);
					$time = number_format($this->CI->$model->$database->query_times[$key], 4);
 
					foreach ($highlight as $bold)
					{
						$val = str_replace($bold, '<strong style="color: blue">'.$bold.'</strong>', $val);	
					}
 
					$output .= "<tr><td width='1%' valign='top' style='color:#990000;font-weight:normal;background-color:#ddd;'>".$time."&nbsp;&nbsp;</td><td style='color:#000;font-weight:normal;background-color:#ddd;'>".$val."</td></tr>\n";
				}
			}
 
		}
 
		$output .= "</table>\n";
		$output .= "</fieldset>";
		return $output;
	}
 
	/**
	 * Run the Profiler
	 * @return	string
	 */	
	function run()
	{		
		$output = '<br clear="all" />';
		$output .= "<div style='background-color:#fff;padding:10px;'>";
 
		$output .= $this->_compile_memory_usage();
		$output .= $this->_compile_benchmarks();	
		$output .= $this->_compile_uri_string();
		$output .= $this->_compile_get();
		$output .= $this->_compile_post();
		$output .= $this->_compile_queries();
 
		// Include the autoload config to access the array of models in this app.
		include(APPPATH.'config/autoload'.EXT);
 
		// Loop through each model to set the database object
		foreach($autoload['model'] as $model) {
 
			// Define the database object name			
			$database = $this->CI->$model->get_database_group();
 
			// Compile the output
			$output .= $this->_compile_multi_db_queries($database, $model);
 
		}
 
		$output .= '</div>';
 
		return $output;
	}
 
}
