CREATE TABLE `darshpun`.`profit_sharing_history` ( 
  `id` BIGINT NOT NULL AUTO_INCREMENT , 
  `user_id` BIGINT NOT NULL , 
  `new_user_id` BIGINT NOT NULL , 
  `transaction_date` DATETIME NOT NULL , 
  `transaction_amount` FLOAT(10,2) NOT NULL , 
  `transaction_remark` VARCHAR(250) NOT NULL , 
  `created_date` DATETIME NOT NULL , 
  `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)
) ENGINE = MyISAM;

-- Default entry for Default User
INSERT INTO `profit_sharing_history` (`id`, `user_id`, `new_user_id`, `transaction_date`, `transaction_amount`, `transaction_remark`, `created_date`, `updated_date`) VALUES ('1', '1', '1', '2018-12-05 00:00:00', '500', 'DP111111/Prashant Vidhate/Daily profit', '2018-12-05 00:00:00', CURRENT_TIMESTAMP);

CREATE TABLE `darshpun`.`direct_referral_history` ( 
  `id` BIGINT NOT NULL AUTO_INCREMENT , 
  `user_id` BIGINT NOT NULL , 
  `new_user_id` BIGINT NOT NULL , 
  `transaction_date` DATETIME NOT NULL , 
  `transaction_amount` FLOAT(10,2) NOT NULL , 
  `transaction_remark` VARCHAR(250) NOT NULL , 
  `created_date` DATETIME NOT NULL , 
  `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)
) ENGINE = MyISAM;

CREATE TABLE `darshpun`.`binary_income_history` ( 
  `id` BIGINT NOT NULL AUTO_INCREMENT , 
  `user_id` BIGINT NOT NULL , 
  `new_user_id` BIGINT NOT NULL , 
  `pair_match` BIGINT NOT NULL , 
  `transaction_date` DATETIME NOT NULL , 
  `transaction_amount` FLOAT(10,2) NOT NULL , 
  `transaction_remark` VARCHAR(250) NOT NULL , 
  `created_date` DATETIME NOT NULL , 
  `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)
) ENGINE = MyISAM;

ALTER TABLE user MODIFY COLUMN created_date datetime NOT NULL;