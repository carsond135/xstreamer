-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2017 at 08:34 AM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xstreamer_lite`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_activity_logs`
--

CREATE TABLE IF NOT EXISTS `table_activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_activity_logs`
--

INSERT INTO `table_activity_logs` (`id`, `user_id`, `type`, `object_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 23, 'login', 23, 'Signin at 2016-08-11', '2016-08-11 04:05:32', '2016-08-11 04:05:32'),
(2, 23, 'logout', 23, 'Signout at 2016-08-11', '2016-08-11 04:07:04', '2016-08-11 04:07:04'),
(3, 37, 'login', 37, 'Signin at 2016-08-11', '2016-08-11 04:17:28', '2016-08-11 04:17:28'),
(4, 37, 'logout', 37, 'Signout at 2016-08-11', '2016-08-11 04:50:00', '2016-08-11 04:50:00'),
(5, 41, 'login', 41, 'Signin at 2016-08-11', '2016-08-11 04:50:20', '2016-08-11 04:50:20'),
(6, 41, 'logout', 41, 'Signout at 2016-08-11', '2016-08-11 07:32:56', '2016-08-11 07:32:56'),
(7, 37, 'logout', 37, 'Signout at 2016-08-11', '2016-08-11 07:35:41', '2016-08-11 07:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `table_categories`
--

CREATE TABLE IF NOT EXISTS `table_categories` (
  `ID` int(11) NOT NULL,
  `contries_id` int(11) DEFAULT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `recomment` tinyint(1) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_categories`
--

INSERT INTO `table_categories` (`ID`, `contries_id`, `title_name`, `post_name`, `poster`, `description`, `status`, `recomment`, `tag`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Music', 'music', 'Categories_Poster_Music.png', '', 1, 1, NULL, '2016-04-13 18:26:01', '2016-04-13 18:26:01'),
(3, NULL, 'Movies', 'movies', 'Categories_Poster_Movies.jpg', '', 1, 0, NULL, '2016-04-13 18:26:11', '2016-04-13 18:26:11'),
(4, NULL, 'Gaming', 'gaming', 'Categories_Poster_Gaming.jpg', '', 1, 0, NULL, '2016-04-13 18:26:21', '2016-04-13 18:26:21'),
(5, NULL, 'Sports', 'sports', 'Categories_Poster_Sports.png', '', 1, 0, NULL, '2016-04-13 18:26:29', '2016-04-13 18:26:29'),
(6, NULL, 'Comedies', 'comedies', 'Categories_Poster_Comedies.png', '', 1, 0, NULL, '2016-04-13 18:31:46', '2016-04-13 18:31:46'),
(9, NULL, 'Misc', 'misc', NULL, '', 1, 0, NULL, '2016-04-14 17:57:05', '2016-04-14 17:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `table_channel`
--

CREATE TABLE IF NOT EXISTS `table_channel` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) DEFAULT NULL,
  `subscribe_status` tinyint(1) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `tag` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_channel_subscriber`
--

CREATE TABLE IF NOT EXISTS `table_channel_subscriber` (
  `ID` int(11) NOT NULL,
  `channel_Id` int(11) NOT NULL,
  `member_Id` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_config`
--

CREATE TABLE IF NOT EXISTS `table_config` (
  `ID` int(11) NOT NULL,
  `site_logo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `site_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `site_description` text COLLATE utf8_unicode_ci NOT NULL,
  `site_keyword` text COLLATE utf8_unicode_ci NOT NULL,
  `site_address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `site_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_fb` text COLLATE utf8_unicode_ci NOT NULL,
  `site_tw` text COLLATE utf8_unicode_ci NOT NULL,
  `site_linkin` text COLLATE utf8_unicode_ci NOT NULL,
  `site_copyright` text COLLATE utf8_unicode_ci NOT NULL,
  `site_text_footer` text COLLATE utf8_unicode_ci NOT NULL,
  `site_ga` text COLLATE utf8_unicode_ci NOT NULL,
  `site_map` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_submission` int(1) NOT NULL DEFAULT '1',
  `site_post_widththumbnail_size` int(11) NOT NULL,
  `site_post_heightthumbnail_size` int(11) NOT NULL,
  `site_post_widthmedium_size` int(11) NOT NULL,
  `site_post_heightmedium_size` int(11) NOT NULL,
  `site_post_widthlarge_size` int(11) NOT NULL,
  `site_post_heightlarge_size` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_config`
--

INSERT INTO `table_config` (`ID`, `site_logo`, `site_name`, `site_description`, `site_keyword`, `site_address`, `site_phone`, `site_email`, `site_fb`, `site_tw`, `site_linkin`, `site_copyright`, `site_text_footer`, `site_ga`, `site_map`, `site_submission`, `site_post_widththumbnail_size`, `site_post_heightthumbnail_size`, `site_post_widthmedium_size`, `site_post_heightmedium_size`, `site_post_widthlarge_size`, `site_post_heightlarge_size`, `created_at`, `updated_at`) VALUES
(1, 'public/upload/site/logo.png', 'xStreamer Lite Video CMS Software', 'xStreamer - Video streaming script', 'xStreamer - Video streaming script', '', '', '', '', '', '', 'Copyright ©2016', 'xStreamer Lite is a perfect choice to start your own video streaming website. xStreamer Lite is build on the popular PHP Laravel framework. If you want a premium product with more features - please visit Adent.io :)<div><br></div>', '', 'sitemap.xml', 1, 0, 0, 0, 0, 0, 0, '2016-08-08 17:01:05', '2016-08-08 17:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `table_contact`
--

CREATE TABLE IF NOT EXISTS `table_contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) NOT NULL COMMENT '1: New 2:replied',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_contact`
--

INSERT INTO `table_contact` (`id`, `email`, `name`, `type`, `message`, `reply`, `status`, `created_at`, `updated_at`, `account`) VALUES
(1, 'testing@yopmail.com', 'testinggg', 'bug', 'sdf dfgfdg', 'cfvbcbsdf v sdfgvdsvfdsfv', 2, '2016-08-11 08:13:43', '2016-08-11 08:13:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `table_conversion_config`
--

CREATE TABLE IF NOT EXISTS `table_conversion_config` (
  `id` int(11) NOT NULL,
  `php_cli_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mplayer_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mencoder_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ffmpeg_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flvtool2_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mp4box_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mediainfo_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `yamdi_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail_tool` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_injection_tool` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_thumbnail_w` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_thumbnail_h` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowed_extension` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_conversion_config`
--

INSERT INTO `table_conversion_config` (`id`, `php_cli_path`, `mplayer_path`, `mencoder_path`, `ffmpeg_path`, `flvtool2_path`, `mp4box_path`, `mediainfo_path`, `yamdi_path`, `thumbnail_tool`, `meta_injection_tool`, `max_thumbnail_w`, `max_thumbnail_h`, `allowed_extension`, `created_at`, `updated_at`) VALUES
(1, '/usr/local/bin/php', '/usr/bin/mplayer', '/usr/bin/mencoder', '~/bin/ffmpeg', '/usr/bin/flvtool2', '/usr/bin/MP4Box', '/usr/bin/mediainfo', '/usr/bin/yamdi', 'ffmpeg', 'yamdi', '250', '180', 'avi,mpg,mov,asf,mpeg,xvid,divx,3gp,mkv,3gpp,mp4, rmvb,rm,dat,wmv,flv,ogg', '2016-08-09 21:18:03', '2016-08-09 21:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `table_countries`
--

CREATE TABLE IF NOT EXISTS `table_countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `alpha_2` varchar(2) NOT NULL DEFAULT '',
  `alpha_3` varchar(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_count_report`
--

CREATE TABLE IF NOT EXISTS `table_count_report` (
  `ID` int(11) NOT NULL,
  `report_status` tinyint(1) NOT NULL COMMENT '1=video-comment ; 2= Profile-comment ; 3= member-report',
  `count_report` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_email_setting`
--

CREATE TABLE IF NOT EXISTS `table_email_setting` (
  `id` int(11) NOT NULL,
  `registration_email` int(11) NOT NULL,
  `admin_forgot_password_email` int(11) NOT NULL,
  `member_forgot_password_email` int(11) NOT NULL,
  `channel_subscriber_email` int(11) NOT NULL,
  `channel_register_email` int(11) NOT NULL,
  `reply_comment_email` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_email_setting`
--

INSERT INTO `table_email_setting` (`id`, `registration_email`, `admin_forgot_password_email`, `member_forgot_password_email`, `channel_subscriber_email`, `channel_register_email`, `reply_comment_email`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 4, 5, 0, '2015-12-12 09:46:26', '2015-12-17 06:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `table_email_temp`
--

CREATE TABLE IF NOT EXISTS `table_email_temp` (
  `email_id` varchar(50) NOT NULL DEFAULT '',
  `email_subject` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `email_path` varchar(255) NOT NULL DEFAULT '',
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_email_temp`
--

INSERT INTO `table_email_temp` (`email_id`, `email_subject`, `content`, `email_path`, `comment`, `created_at`, `updated_at`) VALUES
('video_comment', 'You received video comment from {$username}!', '', 'emails/video_comment.tpl', 'video comment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('request_rejected', 'Your friend request has been approved!', '', 'emails/request_rejected.tpl', 'Friend request rejected', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('request_approved', 'Your friend request has been approved!', '', 'emails/request_approved.tpl', 'Friend request approve', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('wall_comment', 'Your received wall comment!', '', 'emails/wall_comment.tpl', 'Wall comment email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('game_upload', 'Your game was successfuly uploaded to {$site_name}!', '', 'emails/game_upload.tpl', 'Game upload email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('game_approve', 'Your game was successfuly uploaded to {$site_name}!', '', 'emails/game_approve.tpl', 'Game approve email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('photo_upload', 'Your album was successfuly uploaded to {$site_name}!', '', 'emails/photo_upload.tpl', 'Album upload email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('photo_approve', 'Your album was successfuly uploaded to {$site_name}!', '', 'emails/photo_approve.tpl', 'Album approve email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('video_approve', 'Your video was successfuly uploaded to {$site_name}!', '', 'emails/video_approve.tpl', 'Video upload email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('video_upload', 'Your video was successfuly uploaded to {$site_name}!', '', 'emails/video_upload.tpl', 'Video upload email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('verify_email', '{$site_name} Confirmation Email', '', 'emails/verify_email.tpl', 'Email verification', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('share_game', '{$sender_name} has sent you a game!', '', 'emails/share_game.tpl', 'Share game email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('share_photo', '{$sender_name} has sent you a photo!', '', 'emails/share_photo.tpl', 'Share photo email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('share_video', '{$sender_name} has sent you a video!', '', 'emails/share_video.tpl', 'Share video email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('invite_friends_email', '{$sender_name} has sent you a invitation!', '', 'emails/invite.tpl', 'Invite friends email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('friend_request', '{$username} added you as a friend on {$site_name}', '', 'emails/friend_request.tpl', 'Friend Request', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('subscribe_email', '{$sender_name} has uploaded a new video', '', 'emails/subscribe_email.tpl', 'Video Subscription Email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('recover_password', 'Your {$site_name} Username and Password', '', 'emails/recover_password.tpl', 'Recovering user login password', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('welcome', 'Welcome to {$site_title}', '', 'emails/welcome.tpl', 'Register welcome email', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('blog_comment', 'You received blog comment from {$username}!', '', 'emails/blog_comment.tpl', 'blog comment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('game_comment', 'You received game comment from {$username}!', '', 'emails/game_comment.tpl', 'game comment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('photo_comment', 'You received photo comment from {$username}!', '', 'emails/photo_comment.tpl', 'photo comment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('player_email', 'I want to share this video with you!', '', 'emails/player_email.tpl', 'Player email', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_email_templete`
--

CREATE TABLE IF NOT EXISTS `table_email_templete` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_email_templete`
--

INSERT INTO `table_email_templete` (`id`, `email_id`, `name`, `name_slug`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 'Confirm Signup', 'confirm_signup', 'Confirm Signup', '<div id=":32y" class="ii gt m15124d0c96835615 adP adO">\r\n    <div id=":32z" class="a3s" style="overflow: hidden;"><u></u>\r\n\r\n        <div style="font-size:16px;font-family:''Helvetica Neue'',Helvetica,Arial,sans-serif">\r\n\r\n            <table style="width:60%;margin:0 auto;border:0">\r\n                <tbody>\r\n                    <tr>\r\n                        <td style="border-bottom:1px solid #ddd">\r\n                            <a href="{{URL()}}" style="color:#08c;text-decoration:none" target="_blank"><img alt="{{$site_name}}" src="{{URL(''public/assets/images/logo.jpg'')}}" style="margin:10px 0;width:200px" class="CToWUd">\r\n                            </a>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                            <h1 style="font-weight:lighter">Welcome to {{$site_name}}</h1>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style="padding-top:20px">\r\n                            Hello {{$firstname}} {{$lastname}},\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                            <p>Welcome to {{$site_name}}!</p>\r\n                            <p>Please follow this link to verify your account: <a href="{{URL(''register.html&action=active&token='')}}{{$token}}" style="color:#08c;text-decoration:none" target="_blank">{{URL(''register.html&action=active&token='')}}{{$token}}</a>\r\n                            </p>\r\n\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            \r\n        </div>\r\n        <div class="yj6qo"></div>\r\n        <div class="adL">\r\n\r\n\r\n        </div>\r\n    </div>\r\n</div>', 1, '2015-12-12 00:56:16', '2015-12-12 00:56:16'),
(2, '', 'admin change password', 'admin_change_password', 'admin change password', '<div style="padding: 40px 0px; background: #f0f0f0;font-family: Arial, roboto; line-height: 23px; color: #666">\r\n<div style="width:600px; margin: auto; background:#fff;">\r\n<div style="background: #191a1c; padding: 20px; overflow: hidden; color: #fff;">\r\n<div style="float: left;"><img height="50px" src="http://85.17.15.242/public/assets/images/logo.jpg" /></div>\r\n<div style="background:#191a1c;height: 140px;background-size: 100%; text-align: center; padding-top: 80px"></div>\r\n<div style="padding: 30px">\r\n<div style="font-size: 20px; margin-bottom: 20px; font-weight: bold;">New password reset from  {{$site_name}}!</div>\r\n<br />\r\nIt seems that you or someone requested a new password for you.<br />\r\nWe have generated a new password, as requested:\r\n<p> </p>\r\n\r\n<p><strong>New Password: {{$newpassword}}</strong></p>\r\n<br />\r\nYou can change your password after you sign in.</p>\r\n<br />\r\n </div>\r\n\r\n<div style="background: #252525; padding: 20px; text-align: center; color: #fff;"><strong><strong>Contact us:</strong><br />\r\n{{$site_email}}<br />\r\n{{$site_phone}}</strong></div>\r\n</div>\r\n</div>\r\n', 1, '2015-12-12 02:19:07', '2015-12-12 07:10:06'),
(3, '', 'Member forgot password', 'member_forgot_password', 'Member forgot password', '<div style="padding: 40px 0px; background: #f0f0f0;font-family: Arial, roboto; line-height: 23px; color: #666">\n<div style="width:600px; margin: auto; background:#fff;">\n<div style="background: #191a1c; padding: 20px; overflow: hidden; color: #fff;">\n<div style="float: left;"><img height="50px" src="http://85.17.15.242/public/assets/images/logo.jpg" /></div>\n<div style="background:#191a1c;height: 140px;background-size: 100%; text-align: center; padding-top: 80px"></div>\n<div style="padding: 30px">\n<div style="font-size: 20px; margin-bottom: 20px; font-weight: bold;">New password reset from  {{$site_name}}!</div>\nHello<strong>&nbsp{{$firstname}}  {{$lastname}},</strong><br />\n<br />\nIt seems that you or someone requested a new password for you.<br />\nWe have generated a new password, as requested:\n<p> </p>\n\n<p><strong>New Password: {{$newpassword}}</strong></p>\n<br />\nYou can change your password after you sign in.</p>\n<br />\n </div>\n\n<div style="background: #252525; padding: 20px; text-align: center; color: #fff;"><strong><strong>Contact us:</strong><br />\n{{$site_email}}<br />\n{{$site_phone}}</strong></div>\n</div>\n</div>\n', 1, '2015-12-12 03:11:53', '2015-12-12 03:11:53'),
(4, '', 'Channel subscriber email', 'channel_subscriber_email', 'Channel subscriber email', '<div style="padding: 40px 0px; background: #f0f0f0;font-family: Arial, roboto; line-height: 23px; color: #666">\r\n<div style="width:600px; margin: auto; background:#fff;">\r\n<div style="background: #191a1c; padding: 20px; overflow: hidden; color: #fff;">\r\n<div style="float: left;"><img height="50px" src="http://85.17.15.242/public/assets/images/logo.jpg" /></div>\r\n<div style="background:#191a1c;height: 140px;background-size: 100%; text-align: center; padding-top: 80px"></div>\r\n<div style="padding: 30px">\r\n<div style="font-size: 20px; margin-bottom: 20px; font-weight: bold;">WellCome To {{$site_name}}!</div>\r\nHello<strong>&nbsp{{$firstname}} {{$lastname}},</strong><br />\r\n<br />\r\nThank you for subscribe <br />\r\n', 1, '2015-12-12 03:18:41', '2015-12-12 03:18:41'),
(5, '', 'Channel register email', 'channel_register_email', 'Channel register email', '<div style="padding: 40px 0px; background: #f0f0f0;font-family: Arial, roboto; line-height: 23px; color: #666">\r\n<div style="width:600px; margin: auto; background:#fff;">\r\n<div style="background: #191a1c; padding: 20px; overflow: hidden; color: #fff;">\r\n<div style="float: left;"><img height="50px" src="http://85.17.15.242/public/assets/images/logo.jpg" /></div>\r\n<div style="background:#191a1c;height: 140px;background-size: 100%; text-align: center; padding-top: 80px"></div>\r\n<div style="padding: 30px">\r\n<div style="font-size: 20px; margin-bottom: 20px; font-weight: bold;">WellCome To {{$site_name}}!</div>\r\nHello<strong>&nbsp{{$firstname}} {{$lastname}},</strong><br />\r\n<br />\r\nYour Channel {{$channel_name}}  has been approve by Administrator. Now you can publish your channel !<br />\r\n<br />\r\nThank you for register<br />', 1, '2015-12-17 06:54:48', '2015-12-17 06:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `table_fqa`
--

CREATE TABLE IF NOT EXISTS `table_fqa` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_header_link`
--

CREATE TABLE IF NOT EXISTS `table_header_link` (
  `id` int(11) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_header_link`
--

INSERT INTO `table_header_link` (`id`, `title_name`, `content`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xStreamer Premium', 'Start a Pornhub.com like site with this Adult Turnkey Software', 'http://adent.io/products/xstreamer/', 1, '2016-08-08 12:41:30', '2016-08-08 12:41:30'),
(2, 'xStreamer Adult Video Script', 'Premium product at a Non-premium Price', 'http://adent.io/products/xstreamer/', 1, '2016-08-08 12:41:51', '2016-08-08 12:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `table_ipban`
--

CREATE TABLE IF NOT EXISTS `table_ipban` (
  `id` int(11) NOT NULL,
  `ip_ban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_members`
--

CREATE TABLE IF NOT EXISTS `table_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `security_call_pin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_assigned` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reporting_manager` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` int(11) DEFAULT NULL COMMENT '0:employee,1:admin',
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_profile_updated` tinyint(1) DEFAULT NULL,
  `last_login_time` timestamp NULL DEFAULT NULL,
  `signin` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `upload_status` tinyint(1) NOT NULL,
  `embed_status` tinyint(1) NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `is_comment` tinyint(1) NOT NULL,
  `is_addfriend` tinyint(1) NOT NULL,
  `is_message` tinyint(1) NOT NULL,
  `is_channel_member` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_members`
--

INSERT INTO `table_members` (`id`, `user_id`, `username`, `password`, `email`, `avatar`, `sex`, `firstname`, `lastname`, `phone`, `birthdate`, `security_call_pin`, `company`, `address`, `city`, `state`, `zip`, `country`, `department`, `title`, `state_assigned`, `reporting_manager`, `roles`, `bio`, `timezone`, `is_profile_updated`, `last_login_time`, `signin`, `status`, `upload_status`, `embed_status`, `is_public`, `is_comment`, `is_addfriend`, `is_message`, `is_channel_member`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mo@yopmail.com', NULL, 1, 'Hizz', 'Hizz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1, 1, 1, 0, 1, 0, 0, 0, '2016-05-08 15:59:42', '2016-05-08 15:59:42'),
(3, 3, 'dracula2016', '25f9e794323b453885f5181f1b624d0b', 'dracula@yopmail.com', NULL, 0, 'Dracula', 'Drak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-08 16:02:17', '2016-05-08 16:02:17'),
(4, 4, 'burkplay', 'd0970714757783e6cf17b26fb8e2298f', 'burk@gmail.com', NULL, 0, 'ffdf', 'dfdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 10:41:41', '2016-05-27 10:41:41'),
(5, 5, 'burkplay02', 'e138df6a07da0cabd6df71b64f85f3fb', 'burkplay02@gmail.com', NULL, 0, 'Fabio', 'Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 10:43:21', '2016-05-27 10:43:21'),
(6, 6, 'burkplay023', 'e138df6a07da0cabd6df71b64f85f3fb', 'burkplay022@gmail.com', NULL, 0, 'Fabio', 'Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 10:43:47', '2016-05-27 10:43:47'),
(7, 7, 'burkplayff', 'e138df6a07da0cabd6df71b64f85f3fb', 'burkplay02f@gmail.com', NULL, 0, 'Fabio', 'Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 10:43:58', '2016-05-27 10:43:58'),
(8, 8, 'burkplayfffffhhfhf', 'e138df6a07da0cabd6df71b64f85f3fb', 'burkplay02fssr@gmail.com', NULL, 0, 'Fabio', 'Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 10:44:06', '2016-05-27 10:44:06'),
(9, 9, 'Fabio1234', 'e138df6a07da0cabd6df71b64f85f3fb', 'burkhardtplay@gmail.com', NULL, 0, 'Fabio', 'Ferreira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-05-27 11:02:20', '2016-05-27 11:02:20'),
(10, 10, 'testtest', 'c00abc66ecb6477db34fafe2dcddd115', 'eafine@gmail.com', NULL, 0, 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-01 06:21:25', '2016-06-01 06:21:25'),
(13, 13, 'bbmediaof', '7183340adef7e45eba0af3427de4766b', 'bbmediaof@gmail.com', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:57:23', '2016-06-03 18:57:23'),
(14, 14, 'bbmediaof7', '7183340adef7e45eba0af3427de4766b', 'whatsupitsvlad@gmail.com', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:57:39', '2016-06-03 18:57:39'),
(15, 15, 'bbmediao', '7183340adef7e45eba0af3427de4766b', 'whatsupitsvlad@gmail.co', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:57:47', '2016-06-03 18:57:47'),
(16, 16, 'bbmediaoh', '7183340adef7e45eba0af3427de4766b', 'whatsupitsvlad@gmail.comm', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:57:55', '2016-06-03 18:57:55'),
(17, 17, 'bbmedia@gmail.com', '7183340adef7e45eba0af3427de4766b', 'bbmedia@gmail.com', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:58:24', '2016-06-03 18:58:24'),
(18, 18, 'bbmedhhh', '7183340adef7e45eba0af3427de4766b', 'bbmedia@gmail.comkj', NULL, 0, 'Orlando', 'Fernandes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-03 18:58:41', '2016-06-03 18:58:41'),
(19, 19, 'RPSOT2016', 'a961f017d3195402120fc38d1fdc65f4', 'rpsot@ymail.com', NULL, 0, 'RPSOT', 'RPSOT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-16 11:16:24', '2016-06-16 11:16:24'),
(20, 20, 'kuchar111@seznam.cz', 'ba7422a94365829863e70b023de53d2b', 'kuchar111@seznam.cz', NULL, 0, 'Patrik', 'Kuchař', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-19 15:07:31', '2016-06-19 15:07:31'),
(21, 21, 'azeem401786', '0ac20730c61c7e071d8ee9c7a6aa24ea', 'samebuzz1@gmail.com', NULL, 0, 'admin1', 'khan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, 0, 0, 0, 0, 0, 0, '2016-06-29 21:53:06', '2016-08-11 04:11:48'),
(26, 26, 'qwertyuiop', 'e10adc3949ba59abbe56e057f20f883e', 'qwertyuiop@yopmail.com', NULL, 0, 'qwerty', 'tyui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-06 03:01:26', '2016-08-06 03:01:26'),
(28, 28, 'lindseypelas', '4297f44b13955235245b2497399d7a93', 'lindseypelas@mailinator.com', NULL, 0, 'Lindsey', 'Pelas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-08 16:46:52', '2016-08-08 16:46:52'),
(29, 29, 'lisaanne', '4297f44b13955235245b2497399d7a93', 'lisa@mailinator.com', NULL, 0, 'Lisa ', 'Annn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-08 16:58:52', '2016-08-08 16:58:52'),
(30, 30, 'lisaanneasas', '4297f44b13955235245b2497399d7a93', 'aalisa@mailinator.com', NULL, 0, 'Lisa ', 'Annn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-08 16:59:14', '2016-08-08 16:59:14'),
(31, 31, 'lisannanana', '4297f44b13955235245b2497399d7a93', 'lisannanana@mailinator.com', NULL, 0, 'Lisa', 'Annna', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-08 16:59:38', '2016-08-08 16:59:38'),
(32, 32, 'miadasajnansd', '4297f44b13955235245b2497399d7a93', 'mikejodanaa@mailinator.com', NULL, 0, 'mike', 'jordadsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-09 09:22:00', '2016-08-09 09:22:00'),
(33, 33, 'asdasndjasdkasd', '4297f44b13955235245b2497399d7a93', 'adasdadasdas@mailinator.com', NULL, 0, 'mike', 'jhordan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, 0, 0, 0, 0, 0, 0, '2016-08-09 09:48:44', '2016-08-11 04:11:48'),
(34, 34, 'asdasndjasdk', '4297f44b13955235245b2497399d7a93', 'adasdadasdas@mailina0tor.com', NULL, 0, 'mike', 'jhordan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, 0, 0, 0, 0, 0, 0, 0, '2016-08-09 09:49:15', '2016-08-11 04:11:47'),
(37, 37, 'testingqq', '46f94c8de14fb36680850768ff1b7f2a', 'testingqq@yopmail.com', NULL, 1, 'qwerty', 'rfttyyi', NULL, '0000-00-00', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-08-11 04:16:35', '2016-08-11 07:35:41'),
(40, 40, 'stafftest', 'f9655d7b3995b8a6a63bf4aacc46bec9', 'mauriciolucasuMN@teleosaurs.xyz', NULL, 0, 'Staff', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-08-11 04:44:01', '2016-08-11 04:45:06'),
(41, 41, 'testing1', '46f94c8de14fb36680850768ff1b7f2a', 'testing1@yopmail.com', NULL, 1, 'tyyue', 'qwewet', NULL, '0000-00-00', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-08-11 04:49:56', '2016-08-11 07:32:56'),
(42, 42, 'testing2', '46f94c8de14fb36680850768ff1b7f2a', 'testing2@yopmail.com', NULL, 0, 'qwert', 'fghjj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-08-11 07:33:42', '2016-08-11 07:33:42'),
(43, 43, 'motomindjass', 'ead9b290d4b6440b9751fd874b500ca7', 'motomindjass@mailinator.com', NULL, 0, 'Motomind', 'jass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-08-11 19:46:41', '2016-08-11 19:47:04'),
(44, 44, 'chhayasorsor', '0bc7d27e721a7508eae447a5cc1d9abb', 'chhayasor3@gmail.com', NULL, 0, 'chhaya', 'sorsor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-08-12 09:25:10', '2016-08-12 09:25:30'),
(45, 45, 'fahmiprasetya', '55b6bf812a15b30ae9d5fb082acf3291', 'fahmiprasetya10@gmail.com', NULL, 0, 'Fahmi', 'Prasetya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-09-26 00:09:17', '2016-09-26 00:09:17'),
(46, 46, 'Sksksksk', 'e99a18c428cb38d5f260853678922e03', 'abc@abcm.com', NULL, 0, 'Ddkkts', 'Djdds', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-11-16 02:52:29', '2016-11-16 02:52:29'),
(47, 47, 'asdfg420', '7a9e6c167d9f188aec500d052b9d4857', 'sample4200@gmail.com', NULL, 0, 'cfdc', 'rdrb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-11-27 15:16:20', '2016-11-27 15:16:44'),
(48, 48, 'sadsmile', 'f03a5a20bb764a1284da6114e74faa10', 'sadsmile2u@gmail.com', NULL, 0, 'sadsmile', 'smile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2016-11-29 09:44:11', '2016-11-29 09:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `table_member_friend`
--

CREATE TABLE IF NOT EXISTS `table_member_friend` (
  `ID` int(11) NOT NULL,
  `member_Id` int(11) NOT NULL,
  `member_friend` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=waiting active,1=active, 2=block, 3=delete',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_member_message`
--

CREATE TABLE IF NOT EXISTS `table_member_message` (
  `ID` int(11) NOT NULL,
  `frommember` int(11) NOT NULL,
  `tomember` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `message_status` tinyint(1) NOT NULL COMMENT '1=new,2=readed,3=delete,4=replay',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_member_report`
--

CREATE TABLE IF NOT EXISTS `table_member_report` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_Id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1:block,2:report',
  `member_status` tinyint(1) NOT NULL COMMENT '0:waiting 1:blocking,2:reporting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_member_video`
--

CREATE TABLE IF NOT EXISTS `table_member_video` (
  `ID` int(11) NOT NULL,
  `member_Id` int(11) NOT NULL,
  `video_Id` text COLLATE utf8_unicode_ci NOT NULL,
  `title_name` text COLLATE utf8_unicode_ci NOT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_migrations`
--

CREATE TABLE IF NOT EXISTS `table_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_msg_private`
--

CREATE TABLE IF NOT EXISTS `table_msg_private` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `string_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_npt_users`
--

CREATE TABLE IF NOT EXISTS `table_npt_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '2',
  `supper_admin` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_npt_users`
--

INSERT INTO `table_npt_users` (`id`, `username`, `user_id`, `password`, `email`, `status`, `supper_admin`, `created_at`, `updated_at`) VALUES
(26, 'superadmin', 10, '21232f297a57a5a743894a0e4a801fc3', 'long.it.stu@gmail.com', 2, 1, NULL, '2015-12-12 07:13:14'),
(57, 'admin', 10, '21232f297a57a5a743894a0e4a801fc3', 'phlong1011@gmail.com', 1, 0, '2015-04-04 01:07:36', '2016-09-26 00:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `table_paymentconfig`
--

CREATE TABLE IF NOT EXISTS `table_paymentconfig` (
  `id` int(11) NOT NULL,
  `clientAccnum` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clientSubacc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `formName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `form_signle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `allowedTypes` text COLLATE utf8_unicode_ci NOT NULL,
  `allowedTypes_signle` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `subscriptionTypeId` text COLLATE utf8_unicode_ci NOT NULL,
  `subscriptionTypeId_signle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_paymentconfig`
--

INSERT INTO `table_paymentconfig` (`id`, `clientAccnum`, `clientSubacc`, `formName`, `form_signle`, `language`, `allowedTypes`, `allowedTypes_signle`, `subscriptionTypeId`, `subscriptionTypeId_signle`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', '', '', '', '', '', '2016-04-13 13:59:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_pornstar`
--

CREATE TABLE IF NOT EXISTS `table_pornstar` (
  `ID` int(11) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wall_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `born` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ethnicity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hair_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eye_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `subscribe_status` tinyint(1) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `tag` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_pornstar_photo`
--

CREATE TABLE IF NOT EXISTS `table_pornstar_photo` (
  `id` int(11) NOT NULL,
  `pornstar_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_pornstar_rating`
--

CREATE TABLE IF NOT EXISTS `table_pornstar_rating` (
  `id` int(11) NOT NULL,
  `pornstar_id` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_pornstar_subscriber`
--

CREATE TABLE IF NOT EXISTS `table_pornstar_subscriber` (
  `ID` int(11) NOT NULL,
  `channel_Id` int(11) NOT NULL,
  `member_Id` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_profile_comment`
--

CREATE TABLE IF NOT EXISTS `table_profile_comment` (
  `ID` int(11) NOT NULL,
  `profile_Id` int(11) NOT NULL,
  `member_post_Id` int(11) NOT NULL,
  `post_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_rating`
--

CREATE TABLE IF NOT EXISTS `table_rating` (
  `ID` int(11) NOT NULL,
  `string_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_rating`
--

INSERT INTO `table_rating` (`ID`, `string_id`, `like`, `dislike`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '709857141', 1, 0, 37, '2016-08-11 04:17:35', '2016-08-11 04:17:35'),
(2, '495133857', 0, 1, 37, '2016-08-11 04:17:48', '2016-08-11 04:17:48'),
(3, '193529508', 1, 0, 37, '2016-08-11 04:22:54', '2016-08-11 04:22:54'),
(4, '709857141', 1, 0, 40, '2016-08-11 04:45:31', '2016-08-11 04:45:31'),
(5, '734857465', 1, 0, 40, '2016-08-11 04:46:24', '2016-08-11 04:46:24'),
(6, '193529508', 0, 1, 41, '2016-08-11 04:50:30', '2016-08-11 04:50:30'),
(7, '709857141', 1, 0, 41, '2016-08-11 04:50:38', '2016-08-11 04:50:38'),
(8, '606190053', 1, 0, 43, '2016-08-11 19:47:20', '2016-08-11 19:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `table_standard_ads`
--

CREATE TABLE IF NOT EXISTS `table_standard_ads` (
  `ID` int(11) NOT NULL,
  `string_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delay_time` int(11) NOT NULL,
  `ads_content` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `script_code` text COLLATE utf8_unicode_ci NOT NULL,
  `ads_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cl_version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ads_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `return_url` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_standard_ads`
--

INSERT INTO `table_standard_ads` (`ID`, `string_id`, `position`, `delay_time`, `ads_content`, `script_code`, `ads_type`, `type`, `cl_version`, `ads_title`, `return_url`, `status`, `created_at`, `updated_at`) VALUES
(8, '1411431887', 'home', 0, 'http://clonemojo.com/public/upload/ads/Standard_1411431887.jpg', ' ', 'jpg', 'upload', '', 'ad2', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2017-02-27 08:14:02', '2017-02-27 08:14:02'),
(9, '1804255939', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_1804255939.jpg', ' ', 'jpg', 'upload', '', 'ad3', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2017-02-27 08:15:01', '2017-02-27 08:15:01'),
(10, '1044393251', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_1044393251.jpg', '', 'jpg', 'upload', '', 'ad4', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:47:34', '2016-08-08 15:47:34'),
(11, '517378799', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_517378799.jpg', '', 'jpg', 'upload', '', 'ad5', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:47:51', '2016-08-08 15:47:51'),
(12, '590938376', 'video', 0, 'http://clonemojo.com/public/upload/ads/Standard_590938376.jpg', '', 'jpg', 'upload', '', 'ad6', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:48:05', '2016-08-08 15:48:05'),
(13, '407321911', 'video', 0, 'http://clonemojo.com/public/upload/ads/Standard_407321911.jpg', '', 'jpg', 'upload', '', 'ad7', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:48:18', '2016-08-08 15:48:18'),
(14, '2008341803', 'toprate', 0, 'http://clonemojo.com/public/upload/ads/Standard_2008341803.jpg', '', 'jpg', 'upload', '', 'ad8', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:48:35', '2016-08-08 15:48:35'),
(15, '1028600466', 'toprate', 0, 'http://clonemojo.com/public/upload/ads/Standard_1028600466.jpg', '', 'jpg', 'upload', '', 'ad10', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:48:49', '2016-08-08 15:48:49'),
(16, '1222747465', 'mostview', 0, 'http://clonemojo.com/public/upload/ads/Standard_1222747465.jpg', '', 'jpg', 'upload', '', 'ad11', 'https://adent.dpdcart.com/cart/add?product_id=125353&method_id=133552', 1, '2016-08-08 15:49:04', '2016-08-08 15:49:04'),
(17, '31498069', 'home', 0, 'http://clonemojo.com/public/upload/ads/Standard_31498069.jpg', '', 'jpg', 'upload', '', 'qwertwer', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:39:33', '2016-12-14 10:39:33'),
(18, '436646927', 'home', 0, 'http://clonemojo.com/public/upload/ads/Standard_436646927.jpg', '', 'jpg', 'upload', '', 'dsfbgfdsadfv', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:39:49', '2016-12-14 10:39:49'),
(19, '31249297', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_31249297.jpg', ' ', 'jpg', 'upload', '', 'asdadsas', 'http://adent.io/holidaysales/', 1, '2017-02-27 08:15:33', '2017-02-27 08:15:33'),
(20, '45939403', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_45939403.jpg', '', 'jpg', 'upload', '', 'dfgfdssdf', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:40:48', '2016-12-14 10:40:48'),
(21, '1808531013', 'footer', 0, 'http://clonemojo.com/public/upload/ads/Standard_1808531013.jpg', ' ', 'jpg', 'upload', '', 'sdfdsdfd', 'http://adent.io/holidaysales/', 1, '2017-02-27 08:17:09', '2017-02-27 08:17:09'),
(22, '1368755852', 'toprate', 0, 'http://clonemojo.com/public/upload/ads/Standard_1368755852.jpg', '', 'jpg', 'upload', '', 'dfsgddfd', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:41:00', '2016-12-14 10:41:00'),
(23, '412053180', 'mostview', 0, 'http://clonemojo.com/public/upload/ads/Standard_412053180.jpg', '', 'jpg', 'upload', '', 'dfdgdsdf', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:41:08', '2016-12-14 10:41:08'),
(24, '1596814096', 'video', 0, 'http://clonemojo.com/public/upload/ads/Standard_1596814096.jpg', '', 'jpg', 'upload', '', 'dfdsaad', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:41:14', '2016-12-14 10:41:14'),
(25, '757470145', 'video', 0, 'http://clonemojo.com/public/upload/ads/Standard_757470145.jpg', '', 'jpg', 'upload', '', 'dfsgdsaadf', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:41:19', '2016-12-14 10:41:19'),
(26, '1538420232', 'video', 0, 'http://clonemojo.com/public/upload/ads/Standard_1538420232.jpg', '', 'jpg', 'upload', '', 'dfgdssdf', 'http://adent.io/holidaysales/', 1, '2016-12-14 10:41:25', '2016-12-14 10:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `table_static_page`
--

CREATE TABLE IF NOT EXISTS `table_static_page` (
  `id` int(11) NOT NULL,
  `titlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_page` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_static_page`
--

INSERT INTO `table_static_page` (`id`, `titlename`, `content_page`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Terms of Service', '<div>1.	ACCEPTANCE</div>By using and/or visiting the AVS Demo website (collectively, including but not limited to all Content, Uploads and User Submissions available through avsdemo.com, "AVS Demo", the website) you agree to the terms and conditions contained herin and the terms and conditions of AVS Demo''s privacy policy incorporated herin, and all future amendments and modifications (collectively referred to as the "Agreement"). By entering, you agree to be bound by these terms and conditions. If you do not agree to be bound the terms and conditions contained herein, then do not use avsdemo.com.The terms and conditions of this Agreement are subject to change by AVS Demo at any time in its sole discretion and you agree be bound by all modifications, changes and/or revisions. If you do not accept to be bound by any and all modifications, changes and/or revisions of this agreement, you many not use avsdemo.com.The terms and conditions contained herein apply to all users of AVS Demo whether a ''visitor'' or a ''member'' and you are only authorized to use avsdemo.com if you agree to abide by all applicable laws and be legally bound by the terms and conditions of this Agreement.<span>2. DESCRIPTION<br><br>The AVS Demo website allows for uploading, sharing and general viewing various types of content allowing registered and unregistered users to share and view visual depictions of adult content, including sexually explicit images. In addition, AVS Demo contains video content, information and other materials posted/uploaded by users. AVS Demo allows its users to view the Content and Website subject to the terms and conditions of this Agreement.</span>The AVS Demo website may also contain certain links to third party websites which are in no way owned or controlled by AVS Demo. AVS Demo assumes no responsibility for the content, privacy policies, practices of any and all third party websites. AVS Demo cannot censor or edit the content of third party sites. You acknowledge that AVS Demo will not be liable for any and all liability arising for your use of any third-party website.avsdemo.com is for your personal use and shall not be used for any commercial endeavor except those specifically endorsed or approved by avsdemo.com. Any illegal and/or unauthorized use of AVS Demo is prohibited including but not limited to collecting usernames and e-mail addresses for sending unsolicited emails or unauthorized framing or linking to the AVS Demo website is prohibited.<span>3. ACCESS<br><br>In order to use this website, you affirm that you are at least eighteen (18) year of age and/or over the age of majority in the jurisdiction you reside and from which you access the website where the age of majority is greater than eighteen (18) years of age. If you are under the age of 18 and/or under the age of majority in the jurisdiction you reside and from which you access the website, then you are not permitted to use the website.</span><span>4. CONDUCT<br><br>You acknowledge and agree that you shall be responsible for your own user submissions and the consequences of posting, uploading, publishing transmitting or other making them available on AVS Demo. You agree that you shall not (nor others using your account) post, upload, publish, transmit or make available in any way on AVS Demo content which is illegal, unlawful, harassing, harmful, threatening, tortuous, abusive, defamatory, obscene, libelous, invasive of one''s privacy including but not limited to personal information, hateful, racial. You also agree that you shall not post, upload, publish, transmit or make available in any way on AVS Demo software containing viruses or any other computer code, files, or programs designed to destroy, interrupt, limit the functionality of, or monitor, or persistently reside in or on any computer software or hardware or telecommunications equipment. You agree that you shall not (nor others using your account) post, upload, publish, transmit or make available in any way on AVS Demo content which is intentionally or unintentionally violating any applicable local, state, national, or international law, or any regulations or laws having the force of law where you reside and elsewhere, including but not limited to any laws or regulations relating to securities, privacy, and export control; engage in, promote, You agree that you shall not (nor others using your account) post, upload, publish, transmit or make available in any way on AVS Demo content depicting illegal activities, promote or depict physical harm or injury against any group or individual, or promote or depict any act of cruelty to animals; You agree not to use AVS Demo in any way that exposes AVS Demo to criminal or civil liability.</span>You agree that AVS Demo shall have the right to determine in its sole and unfettered discretion, what action shall be taken in the event of any discovered or reported violation of the terms and conditions contained herein.<span>5. INTELLECTUAL PROPERTY<br><br>The Content contained on the AVS Demo with the exception of User Submissions including but not limited to the text, software, scripts, graphics, music, videos, photos, sounds, interactive features and trademarks, service marks and logos contained therein, are owned by and/or licensed to AVS Demo, subject to copyright and other intellectual property rights under United States, Canada and foreign laws and international conventions. Content on the Website is provided to you AS IS for your information and personal use only and may not be used, copied, reproduced, distributed, transmitted, broadcast, displayed, sold, licensed, or otherwise exploited for any other purposes whatsoever without the prior written consent of the respective owners. AVS Demo reserves all rights not expressly granted in and to the Website and the Content. You agree to not engage in the use, copying, or distribution of any of the Content other than expressly permitted herein, including any use, copying, and/or distribution of User Submissions of third parties obtained through the Website for any commercial purposes. If you download or print a copy of the Content for personal use, you must retain all copyright and other proprietary notices contained therein. You agree not to disable, circumvent, or otherwise interfere with security related features of the AVS Demo or features that prevent or restrict use or copying of any Content or enforce limitations on use of the AVS Demo Website or the Content therein.</span><span>6. USER SUBMISSIONS<br><br>AVS Demo permits the submission of video and other communications and the hosting, sharing and publishing of such user submissions. You understand that whether or not such User Submissions are published and/or uploaded, AVS Demo does not guarantee any confidentiality with respect to any submissions.</span>AVS Demo allows/permits you to link to materials on the Website for personal, non-commercial purposes only. More over, AVS Demo provides an "Embeddable Player" feature, which you may incorporate into your own personal, non-commercial websites for use in accessing the materials on the Website, provided that you include a prominent link back to the AVS Demo website on the pages containing the Embeddable Player. AVS Demo reserves the right to discontinue any aspect of the AVS Demo website at any time. In addition, you may not modify, build upon or block any portion of the Embeddable Player in any way.You shall be solely responsible for any and all of your own User Submissions and the consequences of posting, uploading and publishing them. Furthermore, with User Submissions, you affirm, represent and/or warrant that:<ol><li>you own or retain the necessary licenses, rights, consents, and permissions to use and authorize AVS Demo to use all trademarks, copyrights, trade secrets, patents, or other proprietary rights in and to any and all User Submissions to enable inclusion and use of the User Submissions in the manner contemplated by the Website and these Terms of Service; and</li><li>you will not post, or allow anyone else to post, any material that depicts any person under the age of 18 years and you have inspected and are maintaining written documentation sufficient to confirm that all subjects of your submissions are, in fact, over the age of 18 years.</li><li>You have the written consent, release, and/or permission of each and every identifiable individual person in the User Submission to use the name or likeness of each and every such identifiable individual person to enable inclusion and use of the User Submissions in the manner contemplated by the Website and these Terms of Service. For clarity, you retain all of your ownership rights in your User Submissions. By submitting the User Submissions to AVS Demo, you hereby grant AVS Demo a worldwide, non-exclusive, royalty-free, sublicenseable and transferable license to use, reproduce, distribute, prepare derivative works of, display, and perform the User Submissions in connection with the AVS Demo Website and AVS Demo''s (and its successor''s) business, including without limitation for promoting and redistributing part or all of the AVS Demo Website (and derivative works thereof) in any media formats and through any media channels. You also hereby grant each user of the AVS Demo Website a non-exclusive license to access your User Submissions through the Website, and to use, reproduce, distribute, prepare derivative works of, display and perform such User Submissions as permitted through the functionality of the Website and under these Terms of Service. The foregoing license granted by you terminates once you remove or delete a User Submission from the AVS Demo Website.</li></ol>In submitting material (video or other communication), you further agree that you shall not:<ol><li>submit material that is copyrighted, protected by trade secret or otherwise subject to third party proprietary rights, including privacy and publicity rights, unless you are the owner of such rights or have permission from their rightful owner to post the material and to grant AVS Demo all of the license rights granted herein;</li><li>publish falsehoods or misrepresentations that could damage AVS Demo or any third party;</li><li>submit material that is obscene, illegal, unlawful, , defamatory, libelous, harassing, hateful, racially or ethnically offensive, or encourages conduct that would be considered a criminal offense, give rise to civil liability, violate any law, or is otherwise inappropriate;</li><li>post advertisements or solicitations of business;</li><li>Impersonate another person. AVS Demo does not endorse any User Submission or any opinion, recommendation, or advice expressed therein, and AVS Demo expressly disclaims any and all liability in connection with User Submissions. AVS Demo does not permit copyright infringing activities and infringement of intellectual property rights on its Website, and AVS Demo will remove all Content and User Submissions if properly notified that such Content or User Submission infringes on another''s intellectual property rights. AVS Demo reserves the right to remove Content and User Submissions without prior notice or delay. AVS Demo will also terminate a User''s access to its Website, if they are determined to be an infringer. While pornographic and adult content are accepted, AVS Demo also reserves the right to decide in its sole and unfettered discretion, whether Content or a User Submission is appropriate and complies with these Terms of Service for violations other than copyright infringement and violations of intellectual property law, such as, but not limited to, obscene or defamatory material, or excessive length. AVS Demo may remove such User Submissions and/or terminate a User''s access for uploading such material in violation of these Terms of Service at any time, without prior notice and at its sole discretion.</li></ol>You understand and acknowledge that when using avsdemo.com, you will be exposed to User Submissions from a variety of sources, and that AVS Demo is not responsible for the accuracy, usefulness, safety, or intellectual property rights of or relating to such User Submissions. You further understand and acknowledge that you may be exposed to User Submissions that are inaccurate, offensive, indecent, or objectionable, and you agree to waive, and hereby do waive, any legal or equitable rights or remedies you have or may have against AVS Demo with respect thereto, and agree to indemnify and hold AVS Demo, its Owners, affiliates, operators, and/or licensors, harmless to the fullest extent allowed by law regarding all matters related to your use of the website.You agree that AVS Demo may at its sole discretion have the right to refuse to publish, remove, or block access to any User Submission that is available via the Website or other AVS Demo network or services at any time, for any reason, or for no reason at all, with or without notice.AVS Demo provides its website as a service to its users. However, AVS Demo assumes no responsibility whatsoever for monitoring the AVS Demo Services for inappropriate content or conduct. If at any time AVS Demo chooses, in its sole discretion, to monitor the AVS Demo Services, however, AVS Demo assumes no responsibility for the content, no obligation to modify or remove any inappropriate content, and no responsibility for the conduct of the User submitting any such content. AVS Demo may review and delete any User Submissions that, in its sole judgment, violates this Agreement or may be otherwise offensive or illegal, or violate the rights, harm, or threaten the safety of any User or person not associated with the Website (collectively "Inappropriate User Submissions"). You are solely responsible for the User Submissions that you make visible on the Website or to any third-party website via an embedded player provided by the Website or any other material or information that you transmit or share with other Users or unrelated third-parties via the Website.You further understand, acknowledge, agree and specifically authorize AVS Demo to use, reuse, post, publish or upload any User Submissions on any other website owned or controlled by AVS Demo or on any website with whom AVS Demo has an agreement with respect to User Submissions content or sponsor uploaded video. In addition, User submission is deemed to include any sponsored or otherwise branded uploaded videos. AVS Demo reserves the right to determine as its discretion on what basis would a User submissions or an uploaded video might be shared with other websites (rating, number of views, user reviews, etc.).7. ACCOUNT TERMINATION POLICY<ol><li>a User''s access to AVS Demo will be terminated if, under appropriate conditions, the User is determined to infringe repeatedly.</li><li>AVS Demo reserves the right to decide whether Content or if a User''s Submission is appropriate and complies with these Terms and Conditions in regards to violations other than copyright infringement or privacy law, such as, but not limited to, hate crimes, pornography, obscene or defamatory material, or excessive length. AVS Demo may remove such User Submissions and/or terminate a User''s access for uploading such material in violation of these Terms and Conditions at any time, without prior notice and at its sole discretion.</li></ol><span>8. POLICY<br><br>AVS Demo abides by a ZERO TOLERANCE policy relating to any illegal content. Child Pornography, bestiality, rape, torture, snuff, death and/or any other type of obscene and/or illegal material shall not be tolerated by AVS Demo. AVS Demo shall not condone child pornography and will cooperate with all governmental agencies that seek those who produce child pornography.</span><span>9. FEES<br><br>You acknowledge that AVS Demo reserves the right to charge for AVS Demo services and to change its fees from time to time in its discretion. Further more, in the event AVS Demo terminates your rights to use the website because of a breach of this Agreement, you shall not be entitled to the refund of any unused portion of subscription fees.</span><span>10. WARRANTIES<br><br>You represent and warrant that all of the information provided by you to AVS Demo to participate in the AVS Demo website is accurate and current and you have all necessary right, power, and authority to enter into this Agreement and to perform the acts required of you hereunder.</span>As a condition to using the AVS Demo, you must agree to the terms of AVS Demo''s privacy policy and its modifications. You acknowledge and agree that the technical processing and transmission of the Website, including your User Submissions, may involve transmissions over various networks; and changes to conform and adapt to technical requirements of connecting networks or devices. You further acknowledge and agree that other data collected and maintained by AVS Demo with regard to its users may be disclosed in accordance with the AVS Demo Privacy Policy.<span>11. WARRANTY DISCLAIMER<br><br>YOU AGREE THAT YOUR USE OF THE AVS Demo WEBSITE SHALL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, AVS Demo, ITS OFFICERS, DIRECTORS, EMPLOYEES, AND AGENTS DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE WEBSITE AND YOUR USE THEREOF. AVS Demo MAKES NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THIS SITE''S CONTENT OR THE CONTENT OF ANY SITES LINKED TO THIS SITE AND ASSUMES NO LIABILITY OR RESPONSIBILITY FOR ANY</span><ol><li>ERRORS, MISTAKES, OR INACCURACIES OF CONTENT,</li><li>PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF OUR WEBSITE,</li><li>ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN,</li><li>ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM OUR WEBSITE, (IV) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH OUR WEBSITE BY ANY THIRD PARTY, AND/OR</li><li>ANY ERRORS OR OMISSIONSIN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE AVS Demo WEBSITE. AVS Demo DOES NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE AVS Demo WEBSITE OR ANY HYPERLINKED WEBSITE OR FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND AVS Demo WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE. THE FOREGOING LIMITATION OF LIABILITY SHALL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW IN THE APPLICABLE JURISDICTION. YOU SPECIFICALLY ACKNOWLEDGE THAT AVS Demo SHALL NOT BE LIABLE FOR USER SUBMISSIONS OR THE DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT OF ANY THIRD PARTY AND THAT THE RISK OF HARM OR DAMAGE FROM THE FOREGOING RESTS ENTIRELY WITH YOU.</li></ol><span>12. LIMITATION OF LIABILITY<br><br>IN NO EVENT SHALL AVS Demo, ITS OFFICERS, DIRECTORS, EMPLOYEES, OR AGENTS, BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE, OR CONSEQUENTIAL DAMAGES WHATSOEVER RESULTING FROM ANY</span><ol><li>ERRORS, MISTAKES, OR INACCURACIES OF CONTENT,</li><li>PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF OUR WEBSITE,</li><li>ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN,</li><li>ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM OUR WEBSITE,</li><li>ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE, WHICH MAY BE TRANSMITTED TO OR THROUGH OUR WEBSITE BY ANY THIRD PARTY, AND/OR</li><li>ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF YOUR USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE AVS Demo WEBSITE, WHETHER BASED ON WARRANTY, CONTRACT, TORT, OR ANY OTHER LEGAL THEORY, AND WHETHER ORNOT THE COMPANY IS ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATION OF LIABILITY SHALL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW IN THE APPLICABLE JURISDICTION. YOU SPECIFICALLY ACKNOWLEDGE THAT AVS Demo SHALL NOT BE LIABLE FOR USER SUBMISSIONS OR THE DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT OF ANY THIRD PARTY AND THAT THE RISK OF HARM OR DAMAGE FROM THE FOREGOING RESTS ENTIRELY WITH YOU.</li></ol><span>13. INDEMNITY<br><br>You agree to defend, indemnify and hold harmless AVS Demo, its parent corporation, officers, directors, employees and agents, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney''s fees) arising from:</span><ol><li>your use of and access to the AVS Demo Website;</li><li>your violation of any term of these Terms of Service;</li><li>your violation of any third party right, including without limitation any copyright, property, or privacy right; or</li><li>Any claim that one of your User Submissions caused damage to a third party. This defense and indemnification obligation will survive these Terms of Service and your use of the AVS Demo Website.</li></ol>You affirm that you are either more than 18 years of age or an emancipated minor, or possess legal parental or guardian consent, and are fully able and competent to enter into the terms, conditions, obligations, affirmations, representations, and warranties set forth in these Terms of Service, and to abide by and comply with these Terms and Conditions contained herein.<span>14. ASSIGNMENT<br><br>The Terms and Conditions contained herein and any rights and licenses granted hereunder, may not be transferred or assigned by you, but may be assigned by AVS Demo without restriction.</span>If any term, clause or provision of the agreement is held invalid or unenforceable by a court of competent jurisdiction, such invalidity shall not affect the validity or operation of any term, clause or provision and such invalid term, clause or provision shall be deemed to be severed from this Agreement.<span>15. JURISDICTION<br><br>This Agreement shall be governed by and construed in accordance with the laws of Cyprus, without regard to conflicts of law principles. The sole and exclusive jurisdiction and venue for any action or proceeding arising out of or related to this Agreement shall be in an appropriate court located in Limassol, Cyprus. You hereby submit to the jurisdiction and venue of said Courts. You consent to service of process in any legal proceeding.</span>', 0, '2015-12-05 06:35:24', '2015-12-04 23:35:24'),
(2, 'Privacy Policy', 'This document details important information regarding the use and disclosure of User Data collected on avsdemo.comThe security of your Data is very important to avsdemo.com and as such we take all appropriate steps to limit the risk that it may be lost, damaged or misused.This site expressly and strictly limits its membership and/or viewing privileges to adults 18 years of age and over or having attained the age of majority in their community. All persons who do not meet its criteria are strictly forbidden from accessing or viewing the contents of this Site. We do not knowingly seek or collect any personal information or data from persons who have not attained the age of majority.DATA COLLECTED<ul><li>Personal Information:&nbsp;<br><ul><li>Non-Registered users can watch videos without registering and without any information being collected and processed. However the visitor''s IP address will be recorded in the event that there is any misappropriation of information and/or content.</li><li>Registered Members: Registration is required for uploading videos, and accessing a number of other features. The following personal information is requested at the time of registration: username (required), and email address (required). Additional personal information, such as year of birth, relationship status and sexual orientation may be added on a voluntary basis after registration, for members interested in identifying and potentially contacting other members meeting specific criteria. All this data with the exception of the email address and IP address becomes publicly accessible information.</li></ul></li><li>Content Uploaded to the site: Any personal information or video content that you voluntarily disclose online becomes publicly available and can be collected and used by others.</li><li>Cookies: When you visit avsdemo.com, we may send one or more cookies to your computer that uniquely identifies your browser session. avsdemo.com uses both session cookies and persistent cookies. If you remove your persistent cookie, some of the site''s features may not function properly.</li><li>Log File Information: When you visit avsdemo.com, our servers may automatically record certain information that your web browser sends such as your web request, IP address, browser type, browser language, referring URL, platform type, domain names and the date and time of your request.</li><li>Emails: If you contact us, we may keep a record of that correspondence.</li></ul>USES<ul><li>Your Personally identifiable information submitted to avsdemo.com is used to provide to the user the website''s features and special personalized features.</li><li>Your chosen username (not your email address) is displayed to other Users alongside the content you upload, including videos, comments, at, the messages you send through the avsdemo.com private mail, etc. Other Users can contact you through, private messages.</li><li>Any videos that you submit to avsdemo.com may be redistributed through the internet and other media channels, and may be viewed by the general public.</li><li>We do not use your email address or other personally identifiable information to send commercial or marketing messages without your consent.</li><li>We may use your email address without further consent for non-marketing or administrative purposes (such as notifying you of key website changes or for customer service purposes).</li><li>OPT-IN AND USER COMMUNICATION – Subscriber''s expressly and specifically acknowledges and agrees that his email address or other means of communicating with subscriber may be used to send him offers, information or any other commercially oriented emails or other means of communications. More specifically, some offers may be presented to the subscriber via email campaigns or other means of communications with the option to express the subscriber''s preference by either clicking or entering "accept" (alternatively "yes") or "decline" (alternatively "no"). By selecting or clicking the "accept" or "yes", the subscriber indicates that the subscriber "OPTS-IN" to that offer and thereby agrees and assents that the subscriber''s personal information, including its email address and data may be used for that matter or disclosed to third-parties."</li><li>OPT-OUT AND USER COMMUNICATION – Subscriber''s expressly and specifically acknowledges and agrees that his email address or other means of communicating with subscriber may be used to send him offers, information or any other commercially oriented emails or other means of communications. More specifically, other offers may be presented to the subscriber via email campaigns or other means of communications with a pre-selected preference or choice. If the subscriber does not deselect the pre-selected preference of choice (i.e. "OPT-OUT" of the offer) then the site may transfer the subscriber''s personal profile information to the third-party service or content provider making the offer. If the subscriber deselects the pre-selected preference then no personal information about the subscriber may be disclosed to any third-party service or content provider.</li><li>We analyze aggregated user traffic information to help streamline our marketing and hosting operations and to improve the quality of the avsdemo.com user-experience.</li></ul>DISCLOSURE OF INFORMATION<ul><li>if under duty to do so avsdemo.com may release data to comply with any legal obligation, or in order to enforce our Terms Of Service and other agreements; or to protect the rights, property or safety of avsdemo.com or our subscribers or others. This includes exchanging information with other companies and organizations including the police and governmental authorities for the purposes of protection against fraud or any other kind of illegal activity whether or not identified in the Terms Of Service. It is avsdemo.com''s policy, whenever possible and legally permissible, to promptly notify you upon an obligation to supply data to any third party.</li><li>Should you deliberately upload any illegal material avsdemo.com shall forward all available information to all relevant authorities and this without notice.&nbsp;<br>- We do not share your personally identifiable information (such as name or email address) with other, third-party companies for their commercial or marketing use without your consent or except as part of a specific program or feature for which you will have the ability to opt-in or opt-out.</li></ul>SECURITYWhere we have given you (or where you have chosen a password) which enables you to access certain parts of our Site, you are responsible for keeping this password confidential. We ask you not to share your password with anyone.Unfortunately, the transmission of information via the Internet is not completely secure. avsdemo.com uses commercially reasonable physical, managerial and technical safeguards to preserve the integrity and security of your personal information. We cannot, however, ensure or warrant the security of any information you transmit to avsdemo.com and you do so at your own risk.YOUR RIGHTSYou are entitled to access and correct your Data by doing so directly on the website or by requesting us to do so via the Contact us section.', 1, '2015-11-27 04:55:17', '2015-11-27 09:38:40'),
(3, 'DMCA', 'REPORTING CLAIMS OF COPYRIGHT INFRINGEMENT<br><br>We take claims of copyright infringement seriously. We will respond to notices of alleged copyright infringement that comply with the Digital Millennium Copyright Act (the “DMCA”) or any other applicable intellectual property legislation or laws. Responses may include removing, blocking or disabling access to material claimed to be the subject of infringing activity, terminating the user’s access to&nbsp;<a href="http://www.xstreamer.com/" target="" rel="">www.xStreamer.com</a>&nbsp;(“xStreamer”), or all of the foregoing.<br><br>If you believe any material accessible on xStreamer infringes your copyright, you may submit a copyright infringement notification (see below, “Filing a DMCA Notice of Copyright Infringement” for instructions on filing such a notice). These requests should only be submitted by the copyright owner or an agent authorized to act on the owner’s behalf.<br><br>If we remove or disable access to material in response to such a notice, we will take reasonable steps to notify the user that uploaded the affected content material that we have removed or disabled access to so that the user has the opportunity to submit a counter notification (see below, “Counter-Notification Procedures” for instructions on filing a counter notification). It is our policy to document all notices of alleged infringement on which we act.<br><br>All copyright infringement notifications and counter-notifications must be written in English. Any attempted notifications written in foreign languages or using foreign characters may, at our discretion, be deemed non-compliant and disregarded.<br><br>FILING A DMCA NOTICE OF COPYRIGHT INFRINGEMENT<br><br>If you choose to request removal of content by submitting an infringement notification, please remember that you are initiating a legal process. Do not make false claims. Misuse of this process may result in the suspension of your account or other legal consequences.<br><br>In accordance with the DMCA, the written notice (the “DMCA Notice”) must include substantially the following:<br><br>Identification of the copyrighted work you believe to have been infringed or, if the claim involves multiple works, a representative list of such works.<br>Identification of the material you believe to be infringing in a sufficiently precise manner to allow us to locate that material. If your complaint does not contain the specific URL of the video you believe infringes your rights, we may be unable to locate and remove it. General information about the video, such as a channel URL or username, is typically not adequate. Please include the URL(s) of the exact video(s).<br>Adequate information by which we, and the uploader(s) of any video(s) you remove, can contact you (including your name, postal address, telephone number and, if available, e-mail address).<br>A statement that you have a good faith belief that use of the copyrighted material is not authorized by the copyright owner, its agent or the law..<br>A statement that the information in the written notice is accurate, and under penalty of perjury, that you are the owner, or an agent authorized to act on behalf of the owner, of an exclusive right that is allegedly infringed.<br>Complete complaints require the physical or electronic signature of the copyright owner or a representative authorized to act on their behalf. To satisfy this requirement, you may type your full legal name to act as your signature at the bottom of your complaint.<br>Our designated Copyright Agent to receive DMCA Notices is:<br><br>Adent Biz<br>180 Sansome st,<br>San Francisco.<br>CA - 94104.<br>Email: copyright@xStreamer.com<br>Please do not send other inquiries or requests to our designated copyright agent. Absent prior express permission, our designated copyright agent is not authorized to accept or waive service of formal legal process, and any agency relationship beyond that required to receive valid DMCA Notices or Counter-Notices (as defined below) is expressly disclaimed.<br><br>If you fail to comply with all of the requirements of Section 512(c)(3) of the DMCA, your DMCA Notice may not be effective.<br><br>Please be aware that if you knowingly materially misrepresent that material or activity on xStreamer is infringing your copyright, you may be held liable for damages (including costs and attorneys’ fees) under Section 512(f) of the DMCA.<br><br>The copyright owner’s name will be published on xStreamer in place of disabled content. This will become part of the public record of your DMCA Notice, along with your description of the work(s) allegedly infringed. All the information provided in a DMCA Notice, the actual DMCA Notice (including your personal information), or both may be forwarded to the uploader of the allegedly infringing content. By submitting a DMCA Notice, you consent to having your information revealed in this way.<br><br>COUNTER-NOTIFICATION PROCEDURES<br><br>If you have received a DMCA Notice and believe that material you posted on xStreamer was removed or access to it was disabled by mistake or misidentification, you may file a counter-notification with us (a “Counter-Notice”). Counter notifications must be submitted by the video’s original uploader or an agent authorized to act on their behalf.<br><br>Counter-notices must be sent to our designated agent:<br><br>Adent Biz<br>180 Sansome st,<br>San Francisco.<br>CA - 94104.<br>Email: copyright@xStreamer.com<br>Please do not send other inquiries or requests to our designated copyright agent. Absent prior express permission, our designated copyright agent is not authorized to accept or waive service of formal legal process, and any agency relationship beyond that required to receive valid DMCA Notices or Counter-Notices (as defined below) is expressly disclaimed.<br><br>Pursuant to the DMCA, the Counter-Notice must include substantially the following:<br><br>Your name, address, phone number and physical or electronic signature;<br>Identification of the allegedly infringing content and its location before removal or access to it was disabled;<br>A statement under penalty of perjury that you believe in good faith that the content was removed by mistake or misidentification; and<br>A statement that you consent to the jurisdiction of the U.S. Federal District Court for the judicial district in which you are located (or if you are outside the U.S., for any judicial district in which the operator of xStreamer may be found), and that you will accept service of process from the person who originally provided us with the DMCA Notice or an agent of such person.<br>We will not respond to counter notifications that do not meet the requirements above.<br><br>After we receive your Counter Notice, we will forward it to the party who submitted the original DMCA Notice and inform that party that the removed material may be restored after 10 business days but no later than 14 business days from the date we received your Counter Notice, unless our Designated Agent first receives notice from the party who filed the original DMCA Notice informing us that such party has filed a court action to restrain you from engaging in infringing activity related to the material in question.<br><br>Please note that when we forward your Counter Notice, it will include your personal information. By submitting a counter notification, you consent to having your information revealed in this way. We will not forward the counter notification to any party other than the original claimant or to law enforcement or parties that assist us with enforcing and protecting our rights.<br><br>Please be aware that if you knowingly materially misrepresent that material or activity on xStreamer was removed or disabled by mistake or misidentification, you may be held liable for damages (including costs and attorneys’ fees) under Section 512(f) of the DMCA.<br><br>REPEAT INFRINGERS<br><br>In accordance with the DMCA and other applicable law, we have adopted a policy of terminating or disabling, in appropriate circumstances and at our sole discretion, the accounts of users who are deemed to be repeat infringers. We may also at our sole discretion limit access to xStreamer, terminate or disable the accounts of any users who infringe any intellectual property rights of others, whether or not there is any repeat infringement.', 1, '2016-08-08 16:56:21', '2016-08-08 16:56:21'),
(4, '2257', 'xstreamer.com is not a producer (primary or secondary) of any and all of the content found on the website (xstreamer.com). With respect to the records as per 18 USC 2257 for any and all content found on this site, please kindly direct your request to the site for which the content was produced.<br><br>xstreamer.com is a video sharing site in which allows for the uploading, sharing and general viewing of various types of adult content and while xstreamer.com does the best it can with verifying compliance, it may not be 100% accurate.<br><br>xstreamer.com abides by the following procedures to ensure compliance:<br><br>Requiring all users to be 18 years of age to upload videos.<br>When uploading, user must verify the content; assure he/she is 18 years of age; certify that he/she keeps records of the models in the content and that they are over 18 years of age.<br>For further assistance and/or information in finding the content''s originating site, please contact xstreamer.com compliance at copyright@xstreamer.com<br><br>xstreamer.com allows content to be flagged as inappropriate. Should any content be flagged as illegal, unlawful, harassing, harmful, offensive or various other reasons, xstreamer.com shall remove it from the site without delay.<br><br>Users of xstreamer.com who come across such content are urged to flag it as inappropriate by clicking ''Flag this video'' link found below each video.<br>', 1, '2016-08-17 02:57:35', '2016-08-17 02:57:35'),
(5, 'Contact', 'fahmiprasetya10@gmail.com', 1, '2016-09-26 00:20:33', '2016-09-26 00:20:33'),
(6, 'Content Partner Program', 'Contact@adent.biz', 1, '2016-08-08 16:55:54', '2016-08-08 16:55:54'),
(7, 'Advertise', 'Contact@adent.biz', 1, '2016-08-08 16:55:35', '2016-08-08 16:55:35'),
(8, 'Feedback Board', '<a href="http://laravel.localhost:70/#" target="" rel="">Feedback Board</a><br>', 1, '2015-11-27 04:57:57', '2015-11-27 04:57:57'),
(9, 'FAQ', '<a href="http://laravel.localhost:70/#" target="" rel="">FAQ</a><br>', 1, '2015-11-27 04:58:09', '2015-11-27 04:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `table_subscription`
--

CREATE TABLE IF NOT EXISTS `table_subscription` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ipAddress` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priceDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscriptionInitialPrice` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referringUrl` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscriptionCurrency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscriptionCurrencyCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscriptionId` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscriptionTypeId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `initialPeriod` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transactionId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1:active 2:Inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_users`
--

CREATE TABLE IF NOT EXISTS `table_users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthDate` date NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sciPin` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` int(10) unsigned DEFAULT NULL,
  `city` mediumint(8) unsigned DEFAULT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stateAssigned` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reportingManager` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8_unicode_ci,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_users`
--

INSERT INTO `table_users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `confirmation_code`, `remember_token`, `birthDate`, `phone`, `sciPin`, `company`, `address`, `country`, `city`, `state`, `zip`, `title`, `department`, `stateAssigned`, `reportingManager`, `bio`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 'demodemo', 'mo@yopmail.com', 'c514c91e4ed341f263e458d44b3bb0a7', 'Hizz', 'Hizz', '', 'gh2IHoRJ22eW4JupsqSE1k35K7hUtkNbFFHIehxP', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-08 15:59:42', '2016-05-08 15:59:42'),
(2, 'demodemo2016', 'mozzzzzz@yopmail.com', 'c514c91e4ed341f263e458d44b3bb0a7', 'Hizz', 'Hizz', '', 'gh2IHoRJ22eW4JupsqSE1k35K7hUtkNbFFHIehxP', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-08 16:00:01', '2016-05-08 16:00:01'),
(3, 'dracula2016', 'dracula@yopmail.com', '25f9e794323b453885f5181f1b624d0b', 'Dracula', 'Drak', '', 'gh2IHoRJ22eW4JupsqSE1k35K7hUtkNbFFHIehxP', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-08 16:02:17', '2016-05-08 16:02:17'),
(4, 'burkplay', 'burk@gmail.com', 'd0970714757783e6cf17b26fb8e2298f', 'ffdf', 'dfdf', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 10:41:41', '2016-05-27 10:41:41'),
(5, 'burkplay02', 'burkplay02@gmail.com', 'e138df6a07da0cabd6df71b64f85f3fb', 'Fabio', 'Ferreira', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 10:43:21', '2016-05-27 10:43:21'),
(6, 'burkplay023', 'burkplay022@gmail.com', 'e138df6a07da0cabd6df71b64f85f3fb', 'Fabio', 'Ferreira', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 10:43:47', '2016-05-27 10:43:47'),
(7, 'burkplayff', 'burkplay02f@gmail.com', 'e138df6a07da0cabd6df71b64f85f3fb', 'Fabio', 'Ferreira', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 10:43:58', '2016-05-27 10:43:58'),
(8, 'burkplayfffffhhfhf', 'burkplay02fssr@gmail.com', 'e138df6a07da0cabd6df71b64f85f3fb', 'Fabio', 'Ferreira', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 10:44:06', '2016-05-27 10:44:06'),
(9, 'Fabio1234', 'burkhardtplay@gmail.com', 'e138df6a07da0cabd6df71b64f85f3fb', 'Fabio', 'Ferreira', '', 'cRI2JUTp20y1vNfWdd0eiPqWcLuywwNL4x1ozUtE', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-05-27 11:02:20', '2016-05-27 11:02:20'),
(10, 'testtest', 'eafine@gmail.com', 'c00abc66ecb6477db34fafe2dcddd115', 'test', 'test', '', 'zLOeggXmVpwStckjqNT4UWuD1aP31WvwzJtD60dy', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-01 06:21:25', '2016-06-01 06:21:25'),
(11, 'afefesafsdfsdfsd', 'edfsdfsdf@gmail.com', 'c00abc66ecb6477db34fafe2dcddd115', 'test', 'test', '', 'zLOeggXmVpwStckjqNT4UWuD1aP31WvwzJtD60dy', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-01 06:21:37', '2016-06-01 06:21:37'),
(13, 'bbmediaof', 'bbmediaof@gmail.com', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:57:23', '2016-06-03 18:57:23'),
(14, 'bbmediaof7', 'whatsupitsvlad@gmail.com', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:57:39', '2016-06-03 18:57:39'),
(15, 'bbmediao', 'whatsupitsvlad@gmail.co', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:57:47', '2016-06-03 18:57:47'),
(16, 'bbmediaoh', 'whatsupitsvlad@gmail.comm', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:57:55', '2016-06-03 18:57:55'),
(17, 'bbmedia@gmail.com', 'bbmedia@gmail.com', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:58:24', '2016-06-03 18:58:24'),
(18, 'bbmedhhh', 'bbmedia@gmail.comkj', '7183340adef7e45eba0af3427de4766b', 'Orlando', 'Fernandes', '', 'vJSW6GMsJYXb3t66wmPWmF3H50XL5Yi3ELNQZvcG', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-03 18:58:41', '2016-06-03 18:58:41'),
(19, 'RPSOT2016', 'rpsot@ymail.com', 'a961f017d3195402120fc38d1fdc65f4', 'RPSOT', 'RPSOT', '', 'LCB9TysikddIbzPEhRoxvsgmI0mqECAgnewgShEc', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-16 11:16:24', '2016-06-16 11:16:24'),
(20, 'kuchar111@seznam.cz', 'kuchar111@seznam.cz', 'ba7422a94365829863e70b023de53d2b', 'Patrik', 'Kuchař', '', 'Jr3QRfZ8t06PYikoM3ZHXcyKnkB3IwyzhjsQG2KW', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-19 15:07:31', '2016-06-19 15:07:31'),
(21, 'azeem401786', 'samebuzz1@gmail.com', '0ac20730c61c7e071d8ee9c7a6aa24ea', 'admin1', 'khan', '', 'P6LVNvtMTdTCobEHZo6DDumxXSBfUh4wRuBmAnZR', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-06-29 21:53:06', '2016-06-29 21:53:06'),
(22, 'testing123', 'testing@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'lorem', 'ipsum', '', 'haXVHfVsV3SCtrokIHAsXstuOUeSaxfIoa2F1mvT', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-06 02:55:46', '2016-08-06 02:55:46'),
(24, 'testingd@yopmail.com', 'testingd@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'lorem', 'ipsum', '', 'haXVHfVsV3SCtrokIHAsXstuOUeSaxfIoa2F1mvT', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-06 02:57:53', '2016-08-06 02:57:53'),
(25, 'testinga', 'testinga@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'qqqq', 'aaaa', '', 'haXVHfVsV3SCtrokIHAsXstuOUeSaxfIoa2F1mvT', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-06 02:59:08', '2016-08-06 02:59:08'),
(26, 'qwertyuiop', 'qwertyuiop@yopmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'qwerty', 'tyui', '', 'haXVHfVsV3SCtrokIHAsXstuOUeSaxfIoa2F1mvT', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-06 03:01:26', '2016-08-06 03:01:26'),
(28, 'lindseypelas', 'lindseypelas@mailinator.com', '4297f44b13955235245b2497399d7a93', 'Lindsey', 'Pelas', '', 'tRBzOvSDx9soiAn5B2mCx8lM56W5EuSo0AXfE2jY', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-08 16:46:52', '2016-08-08 16:46:52'),
(29, 'lisaanne', 'lisa@mailinator.com', '4297f44b13955235245b2497399d7a93', 'Lisa ', 'Annn', '', 'tRBzOvSDx9soiAn5B2mCx8lM56W5EuSo0AXfE2jY', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-08 16:58:52', '2016-08-08 16:58:52'),
(30, 'lisaanneasas', 'aalisa@mailinator.com', '4297f44b13955235245b2497399d7a93', 'Lisa ', 'Annn', '', 'tRBzOvSDx9soiAn5B2mCx8lM56W5EuSo0AXfE2jY', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-08 16:59:14', '2016-08-08 16:59:14'),
(31, 'lisannanana', 'lisannanana@mailinator.com', '4297f44b13955235245b2497399d7a93', 'Lisa', 'Annna', '', 'tRBzOvSDx9soiAn5B2mCx8lM56W5EuSo0AXfE2jY', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-08 16:59:38', '2016-08-08 16:59:38'),
(32, 'miadasajnansd', 'mikejodanaa@mailinator.com', '4297f44b13955235245b2497399d7a93', 'mike', 'jordadsa', '', '8kzlGnSFayVAB1RW7SlRdCJv822udmJvcA6RBqIn', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-09 09:22:00', '2016-08-09 09:22:00'),
(33, 'asdasndjasdkasd', 'adasdadasdas@mailinator.com', '4297f44b13955235245b2497399d7a93', 'mike', 'jhordan', '', '8kzlGnSFayVAB1RW7SlRdCJv822udmJvcA6RBqIn', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-09 09:48:44', '2016-08-09 09:48:44'),
(34, 'asdasndjasdk', 'adasdadasdas@mailina0tor.com', '4297f44b13955235245b2497399d7a93', 'mike', 'jhordan', '', '8kzlGnSFayVAB1RW7SlRdCJv822udmJvcA6RBqIn', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-09 09:49:15', '2016-08-09 09:49:15'),
(35, 'anotnony', 'antonsyas@gmail.com', '4297f44b13955235245b2497399d7a93', 'Antony', 'Dasss', '', 'AePn0vZ3NrjqTK5Bag0rEIQwhS4abXgJITanr2nH', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-09 17:33:07', '2016-08-09 17:33:07'),
(37, 'testingqq', 'testingqq@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'qwerty', 'rfttyyi', '', 'B2OCaa9VwlIa2GTPbX8ucYyhKuWXQOOknFXhnQTt', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-11 04:16:35', '2016-08-11 04:16:35'),
(40, 'stafftest', 'mauriciolucasuMN@teleosaurs.xyz', 'f9655d7b3995b8a6a63bf4aacc46bec9', 'Staff', 'Test', '', '6AcnINTdwJI6JcJAvpN6UFuNeDziz5PwldJFDBcD', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-11 04:44:01', '2016-08-11 04:44:01'),
(41, 'testing1', 'testing1@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'tyyue', 'qwewet', '', 'B2OCaa9VwlIa2GTPbX8ucYyhKuWXQOOknFXhnQTt', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-11 04:49:56', '2016-08-11 04:49:56'),
(42, 'testing2', 'testing2@yopmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'qwert', 'fghjj', '', 'B2OCaa9VwlIa2GTPbX8ucYyhKuWXQOOknFXhnQTt', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-11 07:33:42', '2016-08-11 07:33:42'),
(43, 'motomindjass', 'motomindjass@mailinator.com', 'ead9b290d4b6440b9751fd874b500ca7', 'Motomind', 'jass', '', 'e1aCoV1U1jKPMB3e24Wva57mEfG8JLHRQzexen1T', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-11 19:46:41', '2016-08-11 19:46:41'),
(44, 'chhayasorsor', 'chhayasor3@gmail.com', '0bc7d27e721a7508eae447a5cc1d9abb', 'chhaya', 'sorsor', '', 'xv4iMpL0ySbAwZuUdNu92JjmASLT9Y8RNn7nAwMl', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-08-12 09:25:09', '2016-08-12 09:25:09'),
(45, 'fahmiprasetya', 'fahmiprasetya10@gmail.com', '55b6bf812a15b30ae9d5fb082acf3291', 'Fahmi', 'Prasetya', '', 'pPYuAGYMew47PyrT7fwQujgy5EN0Gg4shYjAe9tF', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-09-26 00:09:17', '2016-09-26 00:09:17'),
(46, 'Sksksksk', 'abc@abcm.com', 'e99a18c428cb38d5f260853678922e03', 'Ddkkts', 'Djdds', '', 'OJkmX9a8lqBgNa74X7Cz2C8UykhNNVxdDmhztGz5', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-11-16 02:52:29', '2016-11-16 02:52:29'),
(47, 'asdfg420', 'sample4200@gmail.com', '7a9e6c167d9f188aec500d052b9d4857', 'cfdc', 'rdrb', '', 'rUmdVSuykzYOcMKyRLivKa84VnFfeFvUneqVi6s8', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-11-27 15:16:20', '2016-11-27 15:16:20'),
(48, 'sadsmile', 'sadsmile2u@gmail.com', 'f03a5a20bb764a1284da6114e74faa10', 'sadsmile', 'smile', '', 'hsBbyVpfkrRxYwgiEmhBth8rWFA71YY0co4aFETH', '0000-00-00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2016-11-29 09:44:11', '2016-11-29 09:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `table_video`
--

CREATE TABLE IF NOT EXISTS `table_video` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `string_Id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `buy_this` tinyint(1) NOT NULL,
  `is_subscription` tinyint(1) NOT NULL,
  `categories_Id` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_Id` int(11) DEFAULT NULL,
  `pornstar_Id` int(11) DEFAULT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_src` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_sd` text COLLATE utf8_unicode_ci NOT NULL,
  `video_url` text COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dowloader` int(11) DEFAULT NULL,
  `video_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `comment_status` tinyint(1) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `tag` text COLLATE utf8_unicode_ci,
  `porn_star` tinyint(1) DEFAULT NULL,
  `form_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowedTypes` text COLLATE utf8_unicode_ci NOT NULL,
  `subscriptionTypeId` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_video`
--

INSERT INTO `table_video` (`ID`, `user_id`, `string_Id`, `buy_this`, `is_subscription`, `categories_Id`, `cat_id`, `channel_Id`, `pornstar_Id`, `title_name`, `post_name`, `video_src`, `video_sd`, `video_url`, `website`, `dowloader`, `video_type`, `poster`, `duration`, `description`, `status`, `featured`, `total_view`, `comment_status`, `rating`, `tag`, `porn_star`, `form_name`, `allowedTypes`, `subscriptionTypeId`, `created_at`, `updated_at`) VALUES
(112, NULL, '1792869192', 0, 0, '3_Movies', '3', NULL, NULL, 'First Date – Hyundai Super Bowl Commercial The Hyundai Genesis', 'first-date-hyundai-super-bowl-commercial-the-hyundai-genesis', 'http://clonemojo.com/videos/2017-02-27/993299613.mp4', 'http://clonemojo.com/videos/2017-02-27/1792869192_SD.mp4', '', NULL, NULL, 'mp4', 'http://clonemojo.com/videos/2017-02-27/1792869192.jpg', '60.316000\n', '', 1, NULL, 1, NULL, 0, 'test', NULL, '', '', '', '2017-02-27 08:22:33', '2017-02-27 08:28:18'),
(113, NULL, '1972087774', 0, 0, '3_Movies', '3', NULL, NULL, 'Miley Cyrus - Wrecking Ball [NO MUSIC SOUND DESIGN]', 'miley-cyrus-wrecking-ball-no-music-sound-design', 'http://clonemojo.com/videos/2017-02-27/1506589163.mp4', 'http://clonemojo.com/videos/2017-02-27/1972087774_SD.mp4', '', NULL, NULL, 'mp4', 'http://clonemojo.com/videos/2017-02-27/1972087774.jpg', '120.664000\n', '', 1, NULL, NULL, NULL, 0, 'test', NULL, '', '', '', '2017-02-27 08:29:49', '2017-02-27 08:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `table_video_ads`
--

CREATE TABLE IF NOT EXISTS `table_video_ads` (
  `id` bigint(20) unsigned NOT NULL,
  `string_id` varchar(10) NOT NULL,
  `adv_url` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `descr` text NOT NULL,
  `duration` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `media` varchar(255) NOT NULL DEFAULT 'flv',
  `views` bigint(20) NOT NULL DEFAULT '0',
  `clicks` bigint(20) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_video_ads_text`
--

CREATE TABLE IF NOT EXISTS `table_video_ads_text` (
  `ID` int(11) NOT NULL,
  `ads_content` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ads_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `return_url` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_video_cat`
--

CREATE TABLE IF NOT EXISTS `table_video_cat` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_video_cat`
--

INSERT INTO `table_video_cat` (`id`, `video_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(59, '686128224', 3, '2016-08-06 08:58:23', '2016-08-06 08:58:23'),
(60, '453101595', 3, '2016-08-06 09:02:08', '2016-08-06 09:02:08'),
(66, '390576200', 3, '2016-08-06 09:12:09', '2016-08-06 09:12:09'),
(67, '390576200', 3, '2016-08-06 09:12:46', '2016-08-06 09:12:46'),
(68, '516725522', 3, '2016-08-06 09:13:14', '2016-08-06 09:13:14'),
(69, '516725522', 3, '2016-08-06 09:13:32', '2016-08-06 09:13:32'),
(70, '448324200', 3, '2016-08-06 09:14:25', '2016-08-06 09:14:25'),
(71, '766878439', 3, '2016-08-06 09:17:07', '2016-08-06 09:17:07'),
(72, '766878439', 3, '2016-08-06 09:17:19', '2016-08-06 09:17:19'),
(73, '44867980', 3, '2016-08-06 09:22:11', '2016-08-06 09:22:11'),
(74, '44867980', 3, '2016-08-06 09:22:54', '2016-08-06 09:22:54'),
(75, '848622445', 3, '2016-08-06 09:23:18', '2016-08-06 09:23:18'),
(76, '1529388806', 3, '2016-08-06 09:24:52', '2016-08-06 09:24:52'),
(77, '1786799475', 3, '2016-08-06 09:37:55', '2016-08-06 09:37:55'),
(78, '2019603264', 3, '2016-08-06 09:39:15', '2016-08-06 09:39:15'),
(79, '1950116703', 3, '2016-08-06 09:40:08', '2016-08-06 09:40:08'),
(80, '1240702711', 3, '2016-08-06 09:42:10', '2016-08-06 09:42:10'),
(81, '18705039', 3, '2016-08-06 09:43:02', '2016-08-06 09:43:02'),
(82, '1430095997', 3, '2016-08-06 09:43:18', '2016-08-06 09:43:18'),
(83, '102755555', 10, '2016-08-06 09:43:40', '2016-08-06 09:43:40'),
(84, '347925569', 3, '2016-08-06 09:47:04', '2016-08-06 09:47:04'),
(85, '2003875642', 3, '2016-08-06 09:49:24', '2016-08-06 09:49:24'),
(86, '2003875642', 3, '2016-08-06 09:49:56', '2016-08-06 09:49:56'),
(87, '792308466', 3, '2016-08-06 09:53:21', '2016-08-06 09:53:21'),
(88, '792308466', 3, '2016-08-06 09:53:43', '2016-08-06 09:53:43'),
(89, '1051481944', 3, '2016-08-06 09:54:49', '2016-08-06 09:54:49'),
(90, '862709898', 3, '2016-08-06 09:57:13', '2016-08-06 09:57:13'),
(91, '211089467', 3, '2016-08-06 09:59:38', '2016-08-06 09:59:38'),
(92, '86799583', 3, '2016-08-06 10:10:24', '2016-08-06 10:10:24'),
(115, '726022015', 3, '2016-08-08 02:45:51', '2016-08-08 02:45:51'),
(116, '1803905750', 3, '2016-08-08 02:48:30', '2016-08-08 02:48:30'),
(127, '946129484', 3, '2016-08-08 06:48:56', '2016-08-08 06:48:56'),
(129, '44317732', 3, '2016-08-08 06:53:26', '2016-08-08 06:53:26'),
(130, '44317732', 3, '2016-08-08 06:56:17', '2016-08-08 06:56:17'),
(131, '1925437213', 3, '2016-08-08 06:58:10', '2016-08-08 06:58:10'),
(132, '1925437213', 3, '2016-08-08 06:58:42', '2016-08-08 06:58:42'),
(133, '796333622', 3, '2016-08-08 07:10:02', '2016-08-08 07:10:02'),
(134, '796333622', 3, '2016-08-08 07:14:05', '2016-08-08 07:14:05'),
(135, '796333622', 3, '2016-08-08 07:15:16', '2016-08-08 07:15:16'),
(136, '1331389495', 3, '2016-08-08 07:18:25', '2016-08-08 07:18:25'),
(143, '1640787927', 3, '2016-08-08 07:30:22', '2016-08-08 07:30:22'),
(149, '1227070676', 3, '2016-08-08 09:19:33', '2016-08-08 09:19:33'),
(150, '1227070676', 3, '2016-08-08 09:22:32', '2016-08-08 09:22:32'),
(151, '1494749539', 3, '2016-08-08 09:30:47', '2016-08-08 09:30:47'),
(152, '1227070676', 3, '2016-08-08 09:32:40', '2016-08-08 09:32:40'),
(153, '202568246', 3, '2016-08-08 09:47:56', '2016-08-08 09:47:56'),
(154, '958204526', 3, '2016-08-08 09:54:45', '2016-08-08 09:54:45'),
(155, '1610017329', 3, '2016-08-08 10:30:43', '2016-08-08 10:30:43'),
(156, '1329190591', 3, '2016-08-08 10:37:21', '2016-08-08 10:37:21'),
(202, '1192612848', 3, '2016-08-09 08:21:09', '2016-08-09 08:21:09'),
(203, '924437788', 3, '2016-08-09 08:30:43', '2016-08-09 08:30:43'),
(204, '924437788', 3, '2016-08-09 08:33:15', '2016-08-09 08:33:15'),
(215, '59548895', 3, '2017-02-27 07:45:47', '2017-02-27 07:45:47'),
(216, '609831626', 3, '2017-02-27 07:53:53', '2017-02-27 07:53:53'),
(223, '1792869192', 3, '2017-02-27 08:21:27', '2017-02-27 08:21:27'),
(224, '1972087774', 3, '2017-02-27 08:27:46', '2017-02-27 08:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `table_video_comment`
--

CREATE TABLE IF NOT EXISTS `table_video_comment` (
  `ID` int(11) NOT NULL,
  `video_Id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `member_Id` int(11) NOT NULL,
  `post_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_parent` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_video_comment`
--

INSERT INTO `table_video_comment` (`ID`, `video_Id`, `member_Id`, `post_comment`, `status`, `created_at`, `updated_at`, `comment_parent`) VALUES
(1, '2037705893', 41, 'qwert tytyh', 0, '2016-08-11 07:27:55', '2016-08-11 07:27:55', 0),
(2, '2037705893', 41, 'fgh r56h', 0, '2016-08-11 07:28:01', '2016-08-11 07:28:01', 0),
(3, '606190053', 43, 'hey', 0, '2016-08-11 19:47:43', '2016-08-11 19:47:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `table_video_setting`
--

CREATE TABLE IF NOT EXISTS `table_video_setting` (
  `id` int(11) NOT NULL,
  `is_subscribe` tinyint(1) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL,
  `is_download` tinyint(1) NOT NULL,
  `is_embed` tinyint(1) NOT NULL,
  `is_ads` tinyint(1) NOT NULL,
  `time_skip_ads` int(11) NOT NULL,
  `video_reload` tinyint(1) NOT NULL,
  `player_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `player_loading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `table_video_setting`
--

INSERT INTO `table_video_setting` (`id`, `is_subscribe`, `is_favorite`, `is_download`, `is_embed`, `is_ads`, `time_skip_ads`, `video_reload`, `player_logo`, `player_loading`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, '', '', '2016-02-15 10:23:00', '2016-02-15 10:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_watch_now`
--

CREATE TABLE IF NOT EXISTS `table_watch_now` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=1082 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_activity_logs`
--
ALTER TABLE `table_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_categories`
--
ALTER TABLE `table_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_channel`
--
ALTER TABLE `table_channel`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_channel_subscriber`
--
ALTER TABLE `table_channel_subscriber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_config`
--
ALTER TABLE `table_config`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_contact`
--
ALTER TABLE `table_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_conversion_config`
--
ALTER TABLE `table_conversion_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_countries`
--
ALTER TABLE `table_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_count_report`
--
ALTER TABLE `table_count_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_email_setting`
--
ALTER TABLE `table_email_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_email_temp`
--
ALTER TABLE `table_email_temp`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `table_email_templete`
--
ALTER TABLE `table_email_templete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_fqa`
--
ALTER TABLE `table_fqa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_header_link`
--
ALTER TABLE `table_header_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_ipban`
--
ALTER TABLE `table_ipban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_members`
--
ALTER TABLE `table_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_member_friend`
--
ALTER TABLE `table_member_friend`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_member_message`
--
ALTER TABLE `table_member_message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_member_report`
--
ALTER TABLE `table_member_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_member_video`
--
ALTER TABLE `table_member_video`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_msg_private`
--
ALTER TABLE `table_msg_private`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_npt_users`
--
ALTER TABLE `table_npt_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_paymentconfig`
--
ALTER TABLE `table_paymentconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_pornstar`
--
ALTER TABLE `table_pornstar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_pornstar_photo`
--
ALTER TABLE `table_pornstar_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_pornstar_rating`
--
ALTER TABLE `table_pornstar_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_pornstar_subscriber`
--
ALTER TABLE `table_pornstar_subscriber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_profile_comment`
--
ALTER TABLE `table_profile_comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_rating`
--
ALTER TABLE `table_rating`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_standard_ads`
--
ALTER TABLE `table_standard_ads`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_static_page`
--
ALTER TABLE `table_static_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_subscription`
--
ALTER TABLE `table_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_country_foreign` (`country`),
  ADD KEY `users_city_foreign` (`city`),
  ADD KEY `users_state_foreign` (`state`);

--
-- Indexes for table `table_video`
--
ALTER TABLE `table_video`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_video_ads`
--
ALTER TABLE `table_video_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `table_video_ads_text`
--
ALTER TABLE `table_video_ads_text`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_video_cat`
--
ALTER TABLE `table_video_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_video_comment`
--
ALTER TABLE `table_video_comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `table_video_setting`
--
ALTER TABLE `table_video_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_watch_now`
--
ALTER TABLE `table_watch_now`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_activity_logs`
--
ALTER TABLE `table_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `table_categories`
--
ALTER TABLE `table_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `table_channel`
--
ALTER TABLE `table_channel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_channel_subscriber`
--
ALTER TABLE `table_channel_subscriber`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_config`
--
ALTER TABLE `table_config`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_contact`
--
ALTER TABLE `table_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_conversion_config`
--
ALTER TABLE `table_conversion_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_countries`
--
ALTER TABLE `table_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `table_count_report`
--
ALTER TABLE `table_count_report`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_email_setting`
--
ALTER TABLE `table_email_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_email_templete`
--
ALTER TABLE `table_email_templete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `table_fqa`
--
ALTER TABLE `table_fqa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_header_link`
--
ALTER TABLE `table_header_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `table_ipban`
--
ALTER TABLE `table_ipban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_members`
--
ALTER TABLE `table_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `table_member_friend`
--
ALTER TABLE `table_member_friend`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_member_message`
--
ALTER TABLE `table_member_message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_member_report`
--
ALTER TABLE `table_member_report`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_member_video`
--
ALTER TABLE `table_member_video`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_msg_private`
--
ALTER TABLE `table_msg_private`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_npt_users`
--
ALTER TABLE `table_npt_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `table_paymentconfig`
--
ALTER TABLE `table_paymentconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_pornstar`
--
ALTER TABLE `table_pornstar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_pornstar_photo`
--
ALTER TABLE `table_pornstar_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_pornstar_rating`
--
ALTER TABLE `table_pornstar_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_pornstar_subscriber`
--
ALTER TABLE `table_pornstar_subscriber`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_profile_comment`
--
ALTER TABLE `table_profile_comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_rating`
--
ALTER TABLE `table_rating`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `table_standard_ads`
--
ALTER TABLE `table_standard_ads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `table_static_page`
--
ALTER TABLE `table_static_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `table_subscription`
--
ALTER TABLE `table_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `table_video`
--
ALTER TABLE `table_video`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `table_video_ads`
--
ALTER TABLE `table_video_ads`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `table_video_ads_text`
--
ALTER TABLE `table_video_ads_text`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `table_video_cat`
--
ALTER TABLE `table_video_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `table_video_comment`
--
ALTER TABLE `table_video_comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `table_video_setting`
--
ALTER TABLE `table_video_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `table_watch_now`
--
ALTER TABLE `table_watch_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1082;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
