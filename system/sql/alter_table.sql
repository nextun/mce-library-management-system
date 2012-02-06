

/*
    This will alter user_info table by adding four new field for the save button in option page

  */

ALTER TABLE `user_info` ADD `email_format` INT( 10 ) NULL AFTER `gender` ,
ADD `time_zone` VARCHAR( 20 ) NULL AFTER `email_format` ,
ADD `email_time` INT( 10 ) NULL AFTER `time_zone` ,
ADD `email_freq` INT( 10 ) NULL AFTER `email_time` ;