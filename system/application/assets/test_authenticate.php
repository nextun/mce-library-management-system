<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//header("content-type: application/xml");
// create a new cURL resource

            $username = 'omsiddiqui@yahoo.com12     ';
            $username = trim($username);
            $pwd = 'stanford';

            //$username = $username;
            //$pwd = $pwd;

            //error_reporting(E_ALL);
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Nucleus-RequestorId: maxim-sims"));
            curl_setopt($ch, CURLOPT_URL, "https://trippert.nucleus.ea.com/1/users?email={$username}&password={$pwd}");
            $data = curl_exec($ch);
            
            if (strpos($data,"NO_SUCH_USER")!==false)
                $valid_login = 0;
            else if(strpos($data,"INVALID_PASSWORD"))
               $valid_login = 0;
            else if (strpos($data,"userUri")===false)
                $valid_login = 0;
            else
            {
                $valid_login = 1;
                //$player_id = $parts[2];    // EA account ID

            }

            echo $valid_login;


?>
