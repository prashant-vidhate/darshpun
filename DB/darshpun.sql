-- --------------------------------------------------------------------
-- Table structure for table `user`
-- --------------------------------------------------------------------
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `sponser_id` bigint(20) NOT NULL,
  `placement_id` bigint(20) NOT NULL,
  `placement_position` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` bigint(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin_code` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `account_is_active` varchar(20) DEFAULT 'ACTIVE',
  `created_date` date DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `user` ADD PRIMARY KEY(`id`);
ALTER TABLE `user` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------------------
-- Table structure for table `login`
-- --------------------------------------------------------------------
CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_role` varchar(100) DEFAULT 'USER',
  `created_at` date NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `login` ADD PRIMARY KEY(`username`);

-- --------------------------------------------------------------------
-- Table structure for table `bank_details`
-- --------------------------------------------------------------------
CREATE TABLE `bank_details` (
  `id` bigint(10) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `pan_number` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `bank_ifsc` varchar(25) NOT NULL,
  `account_number` bigint(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `bank_details` ADD PRIMARY KEY(`id`);
ALTER TABLE `bank_details` CHANGE `id` `id` BIGINT(10) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Table structure for table `joining_details`
--

CREATE TABLE `joining_details` (
  `id` bigint(20) NOT NULL,
  `sponser_id` bigint(20) NOT NULL,
  `newly_created_user_id` bigint(20) NOT NULL,
  `joining_date` datetime NOT NULL,
  `joining_amount` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `joining_details` ADD PRIMARY KEY (`id`);
ALTER TABLE `joining_details` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------
--
-- Table structure for table `user_wallet`
--
CREATE TABLE `darshpun`.`user_wallet` ( 
    `id` BIGINT NOT NULL AUTO_INCREMENT , 
    `user_id` BIGINT NOT NULL , 
    `shopping_fund` FLOAT(10, 2) NOT NULL , 
    `profit_sharing_value` FLOAT(10, 2) NOT NULL , 
    `deposited_profit_sharing_value` FLOAT(10, 2) NOT NULL ,
    `direct_referral_income` FLOAT(10, 2) NOT NULL DEFAULT 0, 
    `created_at` DATETIME NOT NULL , 
    `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
) ENGINE = MyISAM;

ALTER TABLE `user_wallet` ADD UNIQUE(`user_id`);

ALTER TABLE `user_wallet` CHANGE `deposited_profit_sharing_value` `daily_profit` FLOAT(10,2) NOT NULL;

INSERT INTO `user_wallet` (`id`, `user_id`, `shopping_fund`, `profit_sharing_value`, `daily_profit`, `direct_referral_income`, `created_at`, `updated_date`) VALUES ('1', '1', '5000.00', '99500.00', '500.00', '0.00', '2018-12-12 00:00:00', CURRENT_TIMESTAMP);
INSERT INTO `joining_details` (`id`, `sponser_id`, `newly_created_user_id`, `joining_date`, `joining_amount`, `created_at`, `updated_date`) VALUES ('1', '1', '1', '2018-12-12 00:00:00', '10000', '2018-12-12 00:00:00', CURRENT_TIMESTAMP);

INSERT INTO `login` (`username`, `password`, `created_at`, `updated_date`, `user_role`) VALUES ('sysadmin', 'a159b7ae81ba3552af61e9731b20870515944538', '2018-12-16', '2018-12-16 08:34:04', 'ADMIN')
INSERT INTO `user` (`id`, `username`, `sponser_id`, `placement_id`, `placement_position`, `title`, `firstname`, `middlename`, `lastname`, `date_of_birth`, `gender`, `mobile`, `email`, `location`, `landmark`, `city`, `district`, `state`, `pin_code`, `country`, `deleted`, `account_is_active`, `created_date`, `updated_date`) VALUES 
(2, 'sysadmin', 0, 0, 'Root', 'Mr. ', 'Admin', 'Admin', 'Admin', '2018-12-09', 'Male', 1236547855, NULL, NULL, NULL, 'Kopargaon', 'Ahemadnagar', 'Maharashtra', '423601', 'India', 0, 'ACTIVE', '2018-12-09', '2018-12-16 09:00:36');