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