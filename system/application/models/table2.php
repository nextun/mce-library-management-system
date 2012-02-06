<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Table2 extends Model
{
	// Don't forget to connect this group in the constructor
	function Table2()
	{
        parent::Model();
		$this->db2 = $this->load->database('web', TRUE);

	}

	// Required method to get the database group for THIS model
	function get_database_group() {
		return 'web';
	}

}


?>
