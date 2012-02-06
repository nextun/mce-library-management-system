-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 23, 2009 at 07:01 AM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `sim`
-- 

-- --------------------------------------------------------

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL auto_increment,
  `password` varchar(255) default NULL,
  `LAST_NAME` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `date_of_birth` date default NULL,
  `gender` int(11) default NULL,
  `country_id` int(10) default NULL,
  `time_zone` varchar(20) default NULL,
  `email_time` int(10) default NULL,
  `email_freq` int(10) default NULL,
  `created` datetime default NULL,
  `FIRST_NAME` varchar(255) default NULL,
  `registration_step` int(11) NOT NULL,
  `email_format` INT( 10 ) NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8_general_ci AUTO_INCREMENT=5000 ;




-- 
-- Table structure for table `user_info`
-- 

