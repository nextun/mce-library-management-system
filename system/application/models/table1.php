<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Table1 extends Model
{
	// Don't forget to connect this group in the constructor
	function Table1()
	{
        parent::Model();
		$this->db1 = $this->load->database('default', TRUE);
	
	}

	// Required method to get the database group for THIS model
	function get_database_group() {
		return 'default';
	}
	
}



?>
