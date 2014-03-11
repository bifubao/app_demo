
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `BifubaoDemoDB`
--

-- --------------------------------------------------------

--
-- 表的结构 `bifubao_app_info`
--

CREATE TABLE `bifubao_app_info` (
  `app_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_hash_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `counter` bigint(20) NOT NULL,
  PRIMARY KEY (`app_info_id`),
  UNIQUE KEY `app_hash_id` (`app_hash_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bifubao_queue_callback`
--

CREATE TABLE `bifubao_queue_callback` (
  `queue_callback_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `handle_status` int(11) NOT NULL DEFAULT '100',
  `request_id` bigint(20) NOT NULL,
  `content_type` varchar(32) NOT NULL,
  `content_json` text NOT NULL,
  `creation_time` datetime NOT NULL,
  `last_modify_time` datetime NOT NULL,
  PRIMARY KEY (`queue_callback_id`),
  UNIQUE KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
