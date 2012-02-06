<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * Here First index is email-frequency and second index represents email-time.
 *
 */


	$config['email_freq'] = array(
                                     2 => array(
                                                   1 => '01:00:00',
                                                   2 => '01:00:00',
                                                   3 => '01:00:00',
                                                   4 => '02:00:00',
                                                   5 => '01:00:00',
                                               ),
                                     4 => array(
                                                   1 => '02:00:00',
                                                   2 => '02:00:00',
                                                   3 => '02:00:00',
                                                   4 => '04:00:00',
                                                   5 => '02:30:00',

                                                ),
                                     5 => array(
                                                   1 => '03:59:59',
                                                   2 => '04:59:59',
                                                   3 => '04:59:59',
                                                   4 => '23:59:59',
                                                   5 => '09:59:59',

                                               ),


                                    );

?>