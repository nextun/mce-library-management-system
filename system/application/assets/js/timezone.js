/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var time_zone = Array (
            '<option value="-12,1" >(GMT -12:00 hours) Eniwetok</option>',
            '<option value="-12,2" >(GMT -12:00 hours) Kwajalein</option>',
            '<option value="-11,3" >(GMT -11:00 hours) Midway Island, Samoa</option>',
            '<option value="-10,4" >(GMT -10:00 hours) Hawaii</option>',
            '<option value="-9,5" >(GMT -9:00 hours) Alaska</option>',
            '<option value="-8,6" >(GMT -8:00 hours) Pacific Time (US & Canada)</option>',
            '<option value="-7,7" >(GMT -7:00 hours) Mountain Time (US & Canada)</option>',
            '<option value="-6,8" >(GMT -6:00 hours) Central Time (US & Canada)</option>',
            '<option value="-6,9" >(GMT -6:00 hours) Mexico City</option>',
            '<option value="-5,10" >(GMT -5:00 hours) Eastern Time (US & Canada)</option>',
            '<option value="-5,11" >(GMT -5:00 hours) Bogota</option>',
            '<option value="-5,12" >(GMT -5:00 hours) Lima</option>',
            '<option value="-5,13" >(GMT -5:00 hours) Quito</option>',
            '<option value="-4,14" >(GMT -4:00 hours) Atlantic Time (Canada)</option>',
            '<option value="-4,15" >(GMT -4:00 hours) Caracas</option>',
            '<option value="-4,16" >(GMT -4:00 hours) La Paz</option>',
            '<option value="-3.5,17" >(GMT -3:30 hours) Newfoundland</option>',
            '<option value="-3,18" >(GMT -3:00 hours) Brazil</option>',
            '<option value="-3,19" >(GMT -3:00 hours) Georgetown</option>',
            '<option value="-3,20" >(GMT -3:00 hours) Buenos Aires</option>',
            '<option value="-2,21" >(GMT -2:00 hours) Mid-Atlantic</option>',
            '<option value="-1,22" >(GMT -1:00 hours) Azores, Cape Verde Islands</option>',
            '<option value="-1,23" >(GMT -1:00 hours) Cape Verde Islands</option>',
            '<option value="0,24" >(GMT) Western Europe Time</option>',
            '<option value="0,25" >(GMT) London</option>',
            '<option value="0,26" >(GMT) Lisbon</option>',
            '<option value="0,27" >(GMT) Casablanca</option>',
            '<option value="0,28" >(GMT) Monrovia</option>',
            '<option value="1,29" >(GMT +1:00 hours) CET(Central Europe Time)</option>',
            '<option value="1,30" >(GMT +1:00 hours) Brussels</option>',
            '<option value="1,31" >(GMT +1:00 hours) Copenhagen</option>',
            '<option value="1,32" >(GMT +1:00 hours) Madrid</option>',
            '<option value="1,33" >(GMT +1:00 hours) Paris</option>',
            '<option value="1,34" >(GMT +1:00 hours) Tirane</option>',
            '<option value="1,35" >(GMT +1:00 hours) Algiers</option>',
            '<option value="1,36" >(GMT +1:00 hours) Andorra</option>',
            '<option value="1,37" >(GMT +1:00 hours) Luanda</option>',
            '<option value="2,38" >(GMT +2:00 hours) EET(Eastern Europe Time)</option>',
            '<option value="2,39" >(GMT +2:00 hours) Kaliningrad</option>',
            '<option value="2,40" >(GMT +2:00 hours) South Africa</option>',
            '<option value="3,41" >(GMT +3:00 hours) Baghdad</option>',
            '<option value="3,42" >(GMT +3:00 hours) Kuwait</option>',
            '<option value="3,43" >(GMT +3:00 hours) Riyadh</option>',
            '<option value="3,44" >(GMT +3:00 hours) Moscow</option>',
            '<option value="3,45" >(GMT +3:00 hours) St. Petersburg</option>',
            '<option value="3,46" >(GMT +3:00 hours) Volgograd</option>',
            '<option value="3,47" >(GMT +3:00 hours) Nairobi</option>',
            '<option value="3.5,48" >(GMT +3:30 hours) Tehran</option>',
            '<option value="4,49" >(GMT +4:00 hours) Abu Dhabi</option>',
            '<option value="4,50" >(GMT +4:00 hours) Muscat</option>',
            '<option value="4,51" >(GMT +4:00 hours) Baku</option>',
            '<option value="4,52" >(GMT +4:00 hours) Tbilisi</option>',
            '<option value="4.5,53" >(GMT +4:30 hours) Kabul</option>',
            '<option value="5,54" >(GMT +5:00 hours) Ekaterinburg</option>',
            '<option value="5,55" >(GMT +5:00 hours) Islamabad</option>',
            '<option value="5,56" >(GMT +5:00 hours) Karachi</option>',
            '<option value="5,57" >(GMT +5:00 hours) Tashkent</option>',
            '<option value="5.5,58" >(GMT +5:30 hours) Bombay</option>',
            '<option value="5.5,59" >(GMT +5:30 hours) Calcutta</option>',
            '<option value="5.5,60" >(GMT +5:30 hours) Madras</option>',
            '<option value="5.5,61" >(GMT +5:30 hours) New Delhi</option>',
            '<option value="6,62" >(GMT +6:00 hours) Almaty</option>',
            '<option value="6,63" >(GMT +6:00 hours) Dhaka</option>',
            '<option value="6,64" >(GMT +6:00 hours) Colombo</option>',
            '<option value="7,65" >(GMT +7:00 hours) Bangkok</option>',
            '<option value="7,67" >(GMT +7:00 hours) Hanoi</option>',
            '<option value="7,68" >(GMT +7:00 hours) Jakarta</option>',
            '<option value="8,69" >(GMT +8:00 hours) Beijing</option>',
            '<option value="8,70" >(GMT +8:00 hours) Perth</option>',
            '<option value="8,71" >(GMT +8:00 hours) Singapore</option>',
            '<option value="8,72" >(GMT +8:00 hours) Hong Kong</option>',
            '<option value="8,73" >(GMT +8:00 hours) Chongqing</option>',
            '<option value="8,74" >(GMT +8:00 hours) Urumqi</option>',
            '<option value="8,75" >(GMT +8:00 hours) Taipei</option>',
            '<option value="9,76" >(GMT +9:00 hours) Tokyo</option>',
            '<option value="9,77" >(GMT +9:00 hours) Seoul</option>',
            '<option value="9,78" >(GMT +9:00 hours) Osaka</option>',
            '<option value="9,79" >(GMT +9:00 hours) Sapporo</option>',
            '<option value="9,80" >(GMT +9:00 hours) Yakutsk</option>',
            '<option value="9.5,81" >(GMT +9:30 hours) Darwin</option>',
            '<option value="9.5,82" >(GMT +9:30 hours) Adelaide</option>',
            '<option value="10,83" >(GMT +10:00 hours) EAST(East Australian Standard)</option>',
            '<option value="10,84" >(GMT +10:00 hours) Guam </option>',
            '<option value="10,85" >(GMT +10:00 hours) Papua New Guinea</option>',
            '<option value="10,86" >(GMT +10:00 hours) Vladivostok</option>',
            '<option value="11,87" >(GMT +11:00 hours) Solomon Islands</option>',
            '<option value="11,88" >(GMT +11:00 hours) New Caledonia</option>',
            '<option value="11,89" >(GMT +11:00 hours) Magadan</option>',
            '<option value="12,90" >(GMT +12:00 hours) Auckland</option>',
            '<option value="12,91" >(GMT +12:00 hours) Wellington</option>',
            '<option value="12,92" >(GMT +12:00 hours) Fiji</option>',
            '<option value="12,93" >(GMT +12:00 hours) Marshall Island</option>',
            '<option value="12,94" >(GMT +12:00 hours) Kamchatka</option>'
          );

  var time_usa = Array(
            '<option value="-10,4" >(GMT -10:00 hours) Hawaii</option>',
            '<option value="-9,5" >(GMT -9:00 hours) Alaska</option>',
            '<option value="-8,6" >(GMT -8:00 hours) Pacific Time (US & Canada)</option>',
            '<option value="-7,7" >(GMT -7:00 hours) Mountain Time (US & Canada)</option>',
            '<option value="-6,8" >(GMT -6:00 hours) Central Time (US & Canada)</option>',
            '<option value="-5,10" >(GMT -5:00 hours) Eastern Time (US & Canada)</option>'
  );

 var country_list = Array(
                                            'Afghanistan',
                                            'Albania',
                                    	    'Algeria',
                                    	    'American Samoa',
                                    	    'Andorra',
                                            'Angola',
                                            'Anguilla',
                                            'Antarctica',

										    'Antigua and Barbuda',

										    'Argentina',

										    'Armenia',

										    'Aruba',

										    'Australia',

										    'Austria',

										    'Azerbaijan',

										    'Bahamas',

										    'Bahrain',

										    'Bangladesh',

										    'Barbados',

										    'Belarus',


										    'Belgium',

										    'Belize',

										    'Benin',

										    'Bermuda',

										    'Bhutan',

										    'Bolivia',

										    'Bosnia and Herzegovina',

										    'Botswana',

										    'Brazil',

										    'British Indian Ocean Territory',

										    'Brunei',

										    'Bulgaria',

										    'Burkina Faso',

										    'Burundi',

										    'Cambodia',

										    'Cameroon',

                                            'Canada',

										    'Cape Verde',

										    'Cayman Islands',

										    'Central African Republic',

										    'Chad',

										     'China',

										    'Christmas Island',

										    'Cocos Islands',

										    'Colombia',

										    'Comoros',

										    'Congo',

										    'Cook Islands',

                                    	    'Costa Rica',

										    'Côte d Ivoire',

										    'Croatia',

										    'Cyprus',

										    'Czech Republic',

										    'Denmark',

										    'Djibouti',

										    'Dominica',

										    'Dominican Republic',

										    'Ecuador',

										    'Egypt',

										    'El Salvador',

										    'Equatorial Guinea',

										    'Eritrea',

										    'Estonia',

										    'Ethiopia',

										    'Falkland Islands',

										    'Faroe Islands',

										    'Fiji',

										    'Finland',

										    'France',

										    'French Guiana',

										    'French Polynesia',

										    'French Southern Territories',

										    'Gabon',

										    'Gambia',

										    'Georgia',

										    'Germany',

										    'Ghana',

										    'Gibraltar',

										    'Greece',

										    'Greenland',

										    'Grenada',

										    'Guadeloupe',

										    'Guam',

										    'Guatemala',

										    'Guinea',

										    'Guinea-Bissau',

										    'Guyana',

										    'Haiti',

										    'Heard Island And McDonald Islands',

										    'Honduras',

										    'Hong Kong',

										    'Hungary',

										    'Iceland',

										    'India',

										    'Indonesia',

										    'Ireland',

										    'Israel',

										    'Italy',

										    'Jamaica',

										    'Japan',

										    'Jordan',

										    'Kazakhstan',

										    'Kenya',

										    'Kiribati',

										    'Kuwait',

										    'Kyrgyzstan',

										    'Laos',

										    'Latvia',

										    'Lebanon',

										    'Lesotho',

										    'Liberia',

										    'Liechtenstein',

										    'Lithuania',

										    'Luxembourg',

										    'Macedonia',

										    'Madagascar',

										    'Malawi',

										    'Malaysia',

										    'Maldives',

										    'Mali',

										    'Malta',

										    'Marshall Islands',

										    'Martinique',

										    'Mauritania',

										    'Mauritius',

										    'Mayotte',

										    'Mexico',

										    'Micronesia',

										    'Moldova',

										    'Monaco',

										    'Mongolia',

										    'Montserrat',

										    'Morocco',

										    'Mozambique',

										    'Myanmar',

										    'Namibia',

										    'Nauru',

										    'Nepal',

										    'Netherlands',

										    'Netherlands Antilles',

										    'New Caledonia',

										    'New Zealand',

										    'Nicaragua',

										    'Niger',

										    'Nigeria',

										    'Niue',

										    'Norfolk Island',

										    'Northern Mariana Islands',

										    'Norway',

										    'Oman',

										    'Pakistan',

										    'Palau',

										    'Palestine',

										    'Panama',

										    'Papua New Guinea',

										    'Paraguay',

										    'Peru',

										    'Philippines',

										    'Pitcairn',

										    'Poland',

										    'Portugal',

										    'Puerto Rico',

										    'Qatar',

										    'Reunion',

										    'Romania',

										    'Russia',

										    'Rwanda',

										    'Saint Helena',

										    'Saint Kitts And Nevis',

										    'Saint Lucia',

										    'Saint Pierre And Miquelon',

										    'Saint Vincent And The Grenadines',

										    'Samoa',

										    'San Marino',

										    'Sao Tome And Principe',

										    'Saudi Arabia',

										    'Senegal',

										    'Serbia and Montenegro',

										    'Seychelles',

										    'Sierra Leone',

										    'Singapore',

										    'Slovakia',

										    'Slovenia',

										    'Solomon Islands',

										    'Somalia',

										    'South Africa',

										    'South Georgia And The South Sandwich Islands',

										    'South Korea',

										    'Spain',

										    'Sri Lanka',

										    'Suriname',

										    'Svalbard And Jan Mayen',

										    'Swaziland',

										    'Sweden',

										    'Switzerland',

										    'Taiwan',

										    'Tajikistan',

										    'Tanzania',

										    'Thailand',

										    'The Democratic Republic Of Congo',

										    'Timor-Leste',

										    'Togo',

										    'Tokelau',

										    'Tonga',

										    'Trinidad and Tobago',

										    'Tunisia',

										    'Turkey',

										    'Turkmenistan',

										    'Turks And Caicos Islands',

										    'Tuvalu',

										    'U.S. Virgin Islands',

										    'Uganda',

										    'Ukraine',

										    'United Arab Emirates',

										    'United Kingdom',

                                            'United States',   // 215

										    'United States Minor Outlying Islands',

										    'Uruguay',

										    'Uzbekistan',

										    'Vanuatu',

										    'Vatican',

										    'Venezuela',

										    'Vietnam',

										    'Wallis And Futuna',

										    'Western Sahara',

										    'Yemen',

										    'Zambia',

										    'Zimbabwe'
                    );




function get_time_zone(country_id)
{


  if(country_id != 216)
  {
    $('#timezone').html('');
    var option = '';
    for (i=0; i<time_zone.length; i++)
	{
		option =option+time_zone[i];
	}
      $('#timezone').html(option);
  }
  else
  {
     $('#timezone').html('');
     var option = '';
    for (i=0; i<time_usa.length; i++)
	{
		option =option+time_usa[i];
	}
      $('#timezone').html(option);
  }

}


  function init_timezone( time_zone_id)
  {

        
        $('#timezone').html('');
        
        var option = '';
        
        for(var i=1; i<=time_zone.length; i++)
		{
                if(i==time_zone_id)
                {
                    var split_time = time_zone[i-1].split('<option');

                    option =option+'<option' + '  selected  ' + split_time[1] ;
                }
                else
                {
                    option =option+time_zone[i-1];
                }
		}

        
        $('#timezone').html(option);

  }


  function country_init()
  {

        $('#timezone').html('');
        var option = '';
        var time_zone_id = 6;
        for(var i=1; i<=time_zone.length; i++)
		{
                if(i==time_zone_id)
                {
                    var split_time = time_zone[i-1].split('<option');

                    option =option+'<option' + '  selected  ' + split_time[1] ;
                }
                else
                {
                    option =option+time_zone[i-1];
                }
		}


        $('#timezone').html(option);
  }






