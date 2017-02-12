-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 05 2017 г., 14:22
-- Версия сервера: 5.5.54-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `atestat`
--

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `calc_stats_UUTs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `calc_stats_UUTs`(IN `START_DATE` DATE, IN `STOP_DATE` DATE, INOUT `UUTNAME` VARCHAR(20), IN `START_TIME` TIME, IN `STOP_TIME` TIME, INOUT `NUM_OF_DAYS` DATE)
    NO SQL
set NUM_OF_DAYS = STOP_DATE - START_DATE$$

DROP PROCEDURE IF EXISTS `do_test`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `do_test`(IN `START_DATE` DATE, IN `STOP_DATE` DATE, IN `NUM_OF_DAYS` DATE)
BEGIN 
DECLARE loop0_eof BOOLEAN DEFAULT FALSE; 

      DECLARE tmp_title VARCHAR(200); 
      DECLARE tmp_UUT_name VARCHAR(50); 
      DECLARE total_uuts INT; 
       
      DECLARE cur0 CURSOR FOR SELECT distinct UUTNAME as title FROM PHOSTESTGLOBALTEST ORDER BY UUTNAME; 
      

      DECLARE CONTINUE HANDLER FOR NOT FOUND SET loop0_eof = TRUE; 

  
      OPEN cur0; 
           loop0: LOOP 
                  FETCH cur0 INTO tmp_UUT_name; 
             
                  IF loop0_eof THEN 
                        LEAVE loop0; 
                  END IF; 
SELECT COUNT(distinct SERIALNUMBER) INTO total_uuts FROM PHOSTESTGLOBALTEST
      WHERE UUTNAME = tmp_UUT_name AND (GLOBALRESULT='Pass' or GLOBALRESULT='Pass*') ;


              INSERT INTO tmp_tmp VALUES(null, tmp_UUT_name, total_uuts); 
            END LOOP loop0; 

      CLOSE cur0; 

END$$

--
-- Функции
--
DROP FUNCTION IF EXISTS `GetNewMask_ID`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `GetNewMask_ID`(`NeededIDs` INT(11) UNSIGNED, `StartCounter` INT(11) UNSIGNED) RETURNS int(11)
    READS SQL DATA
BEGIN
 SELECT mask_generator
 INTO StartCounter
 FROM generator;
 UPDATE generator 
 SET mask_generator=mask_generator + NeededIDs;
 
 return(StartCounter+1);
 
END$$

DROP FUNCTION IF EXISTS `GetNewTest_ID`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `GetNewTest_ID`(`NeededIDs` INT(11) UNSIGNED, `StartCounter` INT(11) UNSIGNED) RETURNS int(11)
    READS SQL DATA
BEGIN
 SELECT test_generator
 INTO StartCounter
 FROM generator;
 UPDATE generator 
 SET test_generator=test_generator + NeededIDs;
 
 return(StartCounter+1);
 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `code` char(2) NOT NULL,
  `name` char(52) NOT NULL,
  `population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `generator`
--

DROP TABLE IF EXISTS `generator`;
CREATE TABLE IF NOT EXISTS `generator` (
  `id` int(11) NOT NULL DEFAULT '0',
  `test_generator` bigint(20) NOT NULL,
  `mask_generator` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `PASSFAIL_DAYLY`
--

DROP TABLE IF EXISTS `PASSFAIL_DAYLY`;
CREATE TABLE IF NOT EXISTS `PASSFAIL_DAYLY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SERVER` varchar(25) NOT NULL,
  `DATE` date NOT NULL,
  `PASS` int(11) NOT NULL,
  `FAIL` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Структура таблицы `PASSFAIL_RESULTS`
--

DROP TABLE IF EXISTS `PASSFAIL_RESULTS`;
CREATE TABLE IF NOT EXISTS `PASSFAIL_RESULTS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SERVER_NAME` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `PASS_RESULT` int(11) NOT NULL,
  `FAIL_RESULT` int(11) NOT NULL,
  `ERROR_RESULT` int(11) NOT NULL,
  `TIME_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Структура таблицы `PHOSTESTGLOBALRES`
--

DROP TABLE IF EXISTS `PHOSTESTGLOBALRES`;
CREATE TABLE IF NOT EXISTS `PHOSTESTGLOBALRES` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `HEADER_ID` int(11) NOT NULL,
  `TEST_ID` int(11) NOT NULL,
  `TESTNAME` varchar(50) CHARACTER SET utf8 NOT NULL,
  `MINRANGE` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `RESULT` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `MAXRANGE` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `UNITS` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `TESTSTATUS` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `TIMEOFTEST` timestamp NULL DEFAULT NULL,
  `GRAPH_ID` int(11) DEFAULT NULL,
  `TEST_TYPE` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `X_AXIS` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Y_AXIS` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `HEADER_ID` (`HEADER_ID`),
  KEY `HEADER_ID_2` (`HEADER_ID`),
  KEY `HEADER_ID_3` (`HEADER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=FIXED AUTO_INCREMENT=24768609 ;

-- --------------------------------------------------------

--
-- Структура таблицы `PHOSTESTGLOBALTEST`
--

DROP TABLE IF EXISTS `PHOSTESTGLOBALTEST`;
CREATE TABLE IF NOT EXISTS `PHOSTESTGLOBALTEST` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FACILITY` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `STATIONID` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `UUTNAME` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PARTNUMBER` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `SERIALNUMBER` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `TECHNAME` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `TESTDATE` date DEFAULT NULL,
  `TIMESTART` time DEFAULT NULL,
  `TIMESTOP` time DEFAULT NULL,
  `UUTPLACE` int(11) DEFAULT NULL,
  `TESTMODE` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `GLOBALRESULT` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `INDEXRANGE` int(11) DEFAULT NULL,
  `VERSIONS` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `FACILITY` (`FACILITY`),
  KEY `SERIALNUMBER` (`SERIALNUMBER`),
  KEY `TESTDATE` (`TESTDATE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=FIXED AUTO_INCREMENT=1269912 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sync_db_config`
--

DROP TABLE IF EXISTS `sync_db_config`;
CREATE TABLE IF NOT EXISTS `sync_db_config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `client_name` varchar(50) NOT NULL,
  `db_host` varchar(75) NOT NULL,
  `db_path` varchar(255) NOT NULL,
  `record_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `client_name` (`client_name`),
  KEY `client_name_2` (`client_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tmp_tmp`
--

DROP TABLE IF EXISTS `tmp_tmp`;
CREATE TABLE IF NOT EXISTS `tmp_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `TRACES_LIST`
--

DROP TABLE IF EXISTS `TRACES_LIST`;
CREATE TABLE IF NOT EXISTS `TRACES_LIST` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `POINT_COUNT` int(11) DEFAULT '0',
  `TRACE_FREQ_DATA` text COLLATE utf8_unicode_ci,
  `TRACE_POWER_DATA` text COLLATE utf8_unicode_ci,
  `X_AXIS` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Y_AXIS` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `TRACE_POINT_IDS` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1156934 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_IDU_ODU_LIST`
--

DROP TABLE IF EXISTS `UUT_IDU_ODU_LIST`;
CREATE TABLE IF NOT EXISTS `UUT_IDU_ODU_LIST` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `UUT_TYPE` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `UUT_PROJECT` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `UUT_TYPE` (`UUT_TYPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_IDU_YELD_MONTH`
--

DROP TABLE IF EXISTS `UUT_IDU_YELD_MONTH`;
CREATE TABLE IF NOT EXISTS `UUT_IDU_YELD_MONTH` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_IDU_YELD_MONTH_TMP`
--

DROP TABLE IF EXISTS `UUT_IDU_YELD_MONTH_TMP`;
CREATE TABLE IF NOT EXISTS `UUT_IDU_YELD_MONTH_TMP` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_ODU_YELD_MONTH`
--

DROP TABLE IF EXISTS `UUT_ODU_YELD_MONTH`;
CREATE TABLE IF NOT EXISTS `UUT_ODU_YELD_MONTH` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_ODU_YELD_MONTH_TMP`
--

DROP TABLE IF EXISTS `UUT_ODU_YELD_MONTH_TMP`;
CREATE TABLE IF NOT EXISTS `UUT_ODU_YELD_MONTH_TMP` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_TOP_FAILS`
--

DROP TABLE IF EXISTS `UUT_TOP_FAILS`;
CREATE TABLE IF NOT EXISTS `UUT_TOP_FAILS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(25) CHARACTER SET utf8 NOT NULL,
  `UUT_FAILS` int(11) NOT NULL,
  `FACILITY` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_YELD_MONTH`
--

DROP TABLE IF EXISTS `UUT_YELD_MONTH`;
CREATE TABLE IF NOT EXISTS `UUT_YELD_MONTH` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Структура таблицы `UUT_YELD_MONTH_TMP`
--

DROP TABLE IF EXISTS `UUT_YELD_MONTH_TMP`;
CREATE TABLE IF NOT EXISTS `UUT_YELD_MONTH_TMP` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UUT_NAME` varchar(20) CHARACTER SET utf8 NOT NULL,
  `TOTAL_UUT` int(11) NOT NULL,
  `TOTAL_PASS` int(11) NOT NULL,
  `TOTAL_FAIL` int(11) NOT NULL,
  `YEILD` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
