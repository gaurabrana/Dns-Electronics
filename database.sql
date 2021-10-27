-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 04:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerceproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `active`) VALUES
('admin@admin.com', 'admin@admin.com', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `billing_info`
--

CREATE TABLE `billing_info` (
  `info_id` varchar(10) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_one` varchar(100) NOT NULL,
  `address_two` varchar(100) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `shipping_info` varchar(10) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_info`
--

INSERT INTO `billing_info` (`info_id`, `user_id`, `firstname`, `lastname`, `email_address`, `phone_number`, `country`, `address_one`, `address_two`, `postal_code`, `shipping_info`, `added_date`, `active`) VALUES
('123dassad', '2', 'Gaurab', 'Samsher Rana', 'gaurab@rana.com', '123321', 'TO', 'asd', 'Birendranagar', '44100', 'Same', '2021-08-27 14:38:23 PM', 'No'),
('9258948281', '2', 'Sudip', 'Rana', 'sudip@rana.com', '123456789', 'NP', 'Surkhet', 'Kathmandu', '44600', '5597261015', '2021-10-24 08:02:38 PM', 'Yes'),
('ZwIvJyOeuc', '2', 'Gaurab', 'Rana', 'ericwinty90@gmail.com', '98683045222', 'NP', 'Kathmandu, Baneshwor', 'Near Venus Hospital', '21700', 'asd213', '2021-10-24 03:19:03 PM', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `compare`
--

CREATE TABLE `compare` (
  `customer_id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code` varchar(2) NOT NULL,
  `countries_isd_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`) VALUES
(1, 'Afghanistan', 'AF', '93'),
(2, 'Albania', 'AL', '355'),
(3, 'Algeria', 'DZ', '213'),
(4, 'American Samoa', 'AS', '1-684'),
(5, 'Andorra', 'AD', '376'),
(6, 'Angola', 'AO', '244'),
(7, 'Anguilla', 'AI', '1-264'),
(8, 'Antarctica', 'AQ', '672'),
(9, 'Antigua and Barbuda', 'AG', '1-268'),
(10, 'Argentina', 'AR', '54'),
(11, 'Armenia', 'AM', '374'),
(12, 'Aruba', 'AW', '297'),
(13, 'Australia', 'AU', '61'),
(14, 'Austria', 'AT', '43'),
(15, 'Azerbaijan', 'AZ', '994'),
(16, 'Bahamas', 'BS', '1-242'),
(17, 'Bahrain', 'BH', '973'),
(18, 'Bangladesh', 'BD', '880'),
(19, 'Barbados', 'BB', '1-246'),
(20, 'Belarus', 'BY', '375'),
(21, 'Belgium', 'BE', '32'),
(22, 'Belize', 'BZ', '501'),
(23, 'Benin', 'BJ', '229'),
(24, 'Bermuda', 'BM', '1-441'),
(25, 'Bhutan', 'BT', '975'),
(26, 'Bolivia', 'BO', '591'),
(27, 'Bosnia and Herzegowina', 'BA', '387'),
(28, 'Botswana', 'BW', '267'),
(29, 'Bouvet Island', 'BV', '47'),
(30, 'Brazil', 'BR', '55'),
(31, 'British Indian Ocean Territory', 'IO', '246'),
(32, 'Brunei Darussalam', 'BN', '673'),
(33, 'Bulgaria', 'BG', '359'),
(34, 'Burkina Faso', 'BF', '226'),
(35, 'Burundi', 'BI', '257'),
(36, 'Cambodia', 'KH', '855'),
(37, 'Cameroon', 'CM', '237'),
(38, 'Canada', 'CA', '1'),
(39, 'Cape Verde', 'CV', '238'),
(40, 'Cayman Islands', 'KY', '1-345'),
(41, 'Central African Republic', 'CF', '236'),
(42, 'Chad', 'TD', '235'),
(43, 'Chile', 'CL', '56'),
(44, 'China', 'CN', '86'),
(45, 'Christmas Island', 'CX', '61'),
(46, 'Cocos (Keeling) Islands', 'CC', '61'),
(47, 'Colombia', 'CO', '57'),
(48, 'Comoros', 'KM', '269'),
(49, 'Congo Democratic Republic of', 'CG', '242'),
(50, 'Cook Islands', 'CK', '682'),
(51, 'Costa Rica', 'CR', '506'),
(52, 'Cote D\'Ivoire', 'CI', '225'),
(53, 'Croatia', 'HR', '385'),
(54, 'Cuba', 'CU', '53'),
(55, 'Cyprus', 'CY', '357'),
(56, 'Czech Republic', 'CZ', '420'),
(57, 'Denmark', 'DK', '45'),
(58, 'Djibouti', 'DJ', '253'),
(59, 'Dominica', 'DM', '1-767'),
(60, 'Dominican Republic', 'DO', '1-809'),
(61, 'Timor-Leste', 'TL', '670'),
(62, 'Ecuador', 'EC', '593'),
(63, 'Egypt', 'EG', '20'),
(64, 'El Salvador', 'SV', '503'),
(65, 'Equatorial Guinea', 'GQ', '240'),
(66, 'Eritrea', 'ER', '291'),
(67, 'Estonia', 'EE', '372'),
(68, 'Ethiopia', 'ET', '251'),
(69, 'Falkland Islands (Malvinas)', 'FK', '500'),
(70, 'Faroe Islands', 'FO', '298'),
(71, 'Fiji', 'FJ', '679'),
(72, 'Finland', 'FI', '358'),
(73, 'France', 'FR', '33'),
(75, 'French Guiana', 'GF', '594'),
(76, 'French Polynesia', 'PF', '689'),
(77, 'French Southern Territories', 'TF', NULL),
(78, 'Gabon', 'GA', '241'),
(79, 'Gambia', 'GM', '220'),
(80, 'Georgia', 'GE', '995'),
(81, 'Germany', 'DE', '49'),
(82, 'Ghana', 'GH', '233'),
(83, 'Gibraltar', 'GI', '350'),
(84, 'Greece', 'GR', '30'),
(85, 'Greenland', 'GL', '299'),
(86, 'Grenada', 'GD', '1-473'),
(87, 'Guadeloupe', 'GP', '590'),
(88, 'Guam', 'GU', '1-671'),
(89, 'Guatemala', 'GT', '502'),
(90, 'Guinea', 'GN', '224'),
(91, 'Guinea-bissau', 'GW', '245'),
(92, 'Guyana', 'GY', '592'),
(93, 'Haiti', 'HT', '509'),
(94, 'Heard Island and McDonald Islands', 'HM', '011'),
(95, 'Honduras', 'HN', '504'),
(96, 'Hong Kong', 'HK', '852'),
(97, 'Hungary', 'HU', '36'),
(98, 'Iceland', 'IS', '354'),
(99, 'India', 'IN', '91'),
(100, 'Indonesia', 'ID', '62'),
(101, 'Iran (Islamic Republic of)', 'IR', '98'),
(102, 'Iraq', 'IQ', '964'),
(103, 'Ireland', 'IE', '353'),
(104, 'Israel', 'IL', '972'),
(105, 'Italy', 'IT', '39'),
(106, 'Jamaica', 'JM', '1-876'),
(107, 'Japan', 'JP', '81'),
(108, 'Jordan', 'JO', '962'),
(109, 'Kazakhstan', 'KZ', '7'),
(110, 'Kenya', 'KE', '254'),
(111, 'Kiribati', 'KI', '686'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', '850'),
(113, 'South Korea', 'KR', '82'),
(114, 'Kuwait', 'KW', '965'),
(115, 'Kyrgyzstan', 'KG', '996'),
(116, 'Lao People\'s Democratic Republic', 'LA', '856'),
(117, 'Latvia', 'LV', '371'),
(118, 'Lebanon', 'LB', '961'),
(119, 'Lesotho', 'LS', '266'),
(120, 'Liberia', 'LR', '231'),
(121, 'Libya', 'LY', '218'),
(122, 'Liechtenstein', 'LI', '423'),
(123, 'Lithuania', 'LT', '370'),
(124, 'Luxembourg', 'LU', '352'),
(125, 'Macao', 'MO', '853'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', '389'),
(127, 'Madagascar', 'MG', '261'),
(128, 'Malawi', 'MW', '265'),
(129, 'Malaysia', 'MY', '60'),
(130, 'Maldives', 'MV', '960'),
(131, 'Mali', 'ML', '223'),
(132, 'Malta', 'MT', '356'),
(133, 'Marshall Islands', 'MH', '692'),
(134, 'Martinique', 'MQ', '596'),
(135, 'Mauritania', 'MR', '222'),
(136, 'Mauritius', 'MU', '230'),
(137, 'Mayotte', 'YT', '262'),
(138, 'Mexico', 'MX', '52'),
(139, 'Micronesia, Federated States of', 'FM', '691'),
(140, 'Moldova', 'MD', '373'),
(141, 'Monaco', 'MC', '377'),
(142, 'Mongolia', 'MN', '976'),
(143, 'Montserrat', 'MS', '1-664'),
(144, 'Morocco', 'MA', '212'),
(145, 'Mozambique', 'MZ', '258'),
(146, 'Myanmar', 'MM', '95'),
(147, 'Namibia', 'NA', '264'),
(148, 'Nauru', 'NR', '674'),
(149, 'Nepal', 'NP', '977'),
(150, 'Netherlands', 'NL', '31'),
(151, 'Netherlands Antilles', 'AN', '599'),
(152, 'New Caledonia', 'NC', '687	'),
(153, 'New Zealand', 'NZ', '64'),
(154, 'Nicaragua', 'NI', '505'),
(155, 'Niger', 'NE', '227'),
(156, 'Nigeria', 'NG', '234'),
(157, 'Niue', 'NU', '683'),
(158, 'Norfolk Island', 'NF', '672'),
(159, 'Northern Mariana Islands', 'MP', '1-670'),
(160, 'Norway', 'NO', '47'),
(161, 'Oman', 'OM', '968'),
(162, 'Pakistan', 'PK', '92'),
(163, 'Palau', 'PW', '680'),
(164, 'Panama', 'PA', '507'),
(165, 'Papua New Guinea', 'PG', '675'),
(166, 'Paraguay', 'PY', '595'),
(167, 'Peru', 'PE', '51'),
(168, 'Philippines', 'PH', '63'),
(169, 'Pitcairn', 'PN', '64'),
(170, 'Poland', 'PL', '48'),
(171, 'Portugal', 'PT', '351'),
(172, 'Puerto Rico', 'PR', '1-787'),
(173, 'Qatar', 'QA', '974'),
(174, 'Reunion', 'RE', '262'),
(175, 'Romania', 'RO', '40'),
(176, 'Russian Federation', 'RU', '7'),
(177, 'Rwanda', 'RW', '250'),
(178, 'Saint Kitts and Nevis', 'KN', '1-869'),
(179, 'Saint Lucia', 'LC', '1-758'),
(180, 'Saint Vincent and the Grenadines', 'VC', '1-784'),
(181, 'Samoa', 'WS', '685'),
(182, 'San Marino', 'SM', '378'),
(183, 'Sao Tome and Principe', 'ST', '239'),
(184, 'Saudi Arabia', 'SA', '966'),
(185, 'Senegal', 'SN', '221'),
(186, 'Seychelles', 'SC', '248'),
(187, 'Sierra Leone', 'SL', '232'),
(188, 'Singapore', 'SG', '65'),
(189, 'Slovakia (Slovak Republic)', 'SK', '421'),
(190, 'Slovenia', 'SI', '386'),
(191, 'Solomon Islands', 'SB', '677'),
(192, 'Somalia', 'SO', '252'),
(193, 'South Africa', 'ZA', '27'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', '500'),
(195, 'Spain', 'ES', '34'),
(196, 'Sri Lanka', 'LK', '94'),
(197, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '290'),
(198, 'St. Pierre and Miquelon', 'PM', '508'),
(199, 'Sudan', 'SD', '249'),
(200, 'Suriname', 'SR', '597'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', '47'),
(202, 'Swaziland', 'SZ', '268'),
(203, 'Sweden', 'SE', '46'),
(204, 'Switzerland', 'CH', '41'),
(205, 'Syrian Arab Republic', 'SY', '963'),
(206, 'Taiwan', 'TW', '886'),
(207, 'Tajikistan', 'TJ', '992'),
(208, 'Tanzania, United Republic of', 'TZ', '255'),
(209, 'Thailand', 'TH', '66'),
(210, 'Togo', 'TG', '228'),
(211, 'Tokelau', 'TK', '690'),
(212, 'Tonga', 'TO', '676'),
(213, 'Trinidad and Tobago', 'TT', '1-868'),
(214, 'Tunisia', 'TN', '216'),
(215, 'Turkey', 'TR', '90'),
(216, 'Turkmenistan', 'TM', '993'),
(217, 'Turks and Caicos Islands', 'TC', '1-649'),
(218, 'Tuvalu', 'TV', '688'),
(219, 'Uganda', 'UG', '256'),
(220, 'Ukraine', 'UA', '380'),
(221, 'United Arab Emirates', 'AE', '971'),
(222, 'United Kingdom', 'GB', '44'),
(223, 'United States', 'US', '1'),
(224, 'United States Minor Outlying Islands', 'UM', '246'),
(225, 'Uruguay', 'UY', '598'),
(226, 'Uzbekistan', 'UZ', '998'),
(227, 'Vanuatu', 'VU', '678'),
(228, 'Vatican City State (Holy See)', 'VA', '379'),
(229, 'Venezuela', 'VE', '58'),
(230, 'Vietnam', 'VN', '84'),
(231, 'Virgin Islands (British)', 'VG', '1-284'),
(232, 'Virgin Islands (U.S.)', 'VI', '1-340'),
(233, 'Wallis and Futuna Islands', 'WF', '681'),
(234, 'Western Sahara', 'EH', '212'),
(235, 'Yemen', 'YE', '967'),
(236, 'Serbia', 'RS', '381'),
(238, 'Zambia', 'ZM', '260'),
(239, 'Zimbabwe', 'ZW', '263'),
(240, 'Aaland Islands', 'AX', '358'),
(241, 'Palestine', 'PS', '970'),
(242, 'Montenegro', 'ME', '382'),
(243, 'Guernsey', 'GG', '44-1481'),
(244, 'Isle of Man', 'IM', '44-1624'),
(245, 'Jersey', 'JE', '44-1534'),
(247, 'CuraÃ§ao', 'CW', '599'),
(248, 'Ivory Coast', 'CI', '225'),
(249, 'Kosovo', 'XK', '383');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `uniquekey` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `joined_date` date NOT NULL,
  `profile_picture` varchar(50) DEFAULT NULL,
  `approved` varchar(5) NOT NULL,
  `active` varchar(5) NOT NULL,
  `access` varchar(10) NOT NULL,
  `verificationkey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `uniquekey`, `username`, `name`, `password`, `email`, `phone_no`, `age`, `gender`, `joined_date`, `profile_picture`, `approved`, `active`, `access`, `verificationkey`) VALUES
(1, '1061623852871', 'testing123', 'testing', 'd0aabe9a362cb2712ee90e04810902f3', 'testing@testing.com', '+9779868304522', 25, 'Male', '2021-06-16', 'medium6941623852871.jpg', 'YES', 'NO', 'DISABLED', '5aca7571734e1df16738dad7ac1f73f9'),
(2, '2401628224127', 'gaurab9775', 'Gaurab Rana', 'd0aabe9a362cb2712ee90e04810902f3', 'ericwinty90@gmail.com', '+9779868309222', 23, 'Male', '2021-06-19', 'medium4931635170665.jpg', 'YES', 'YES', 'ENABLED', '2541a52cd5831641287d155fa891553c'),
(3, '2401672224127', 'gaurab8784', 'Gaurab Rana', 'd7f83334408c96a53bf0fe3a6999bb39', 'hello@hello.com', '+9779868304522', 16, 'Male', '2021-08-06', 'medium6731628224127.jpg', 'NO', 'NO', 'DISABLED', '60b868bae203243d77ecd62e66ed4544'),
(4, '1971628226256', 'gaurab1842', 'Gaurab Rana', 'd0aabe9a362cb2712ee90e04810902f3', 'dstain17@gmail.com', '+9779868304522', 22, 'Male', '2021-10-14', 'medium7361628226256.jpg', 'YES', 'NO', 'ENABLED', 'd30feb4060eb4f3b59a0447bf2529131'),
(5, '2631632499394', 'd3097', 'D stain', 'd0aabe9a362cb2712ee90e04810902f3', 'dstain7@gmail.com', '+9779868604522', 22, 'Female', '2021-09-24', 'notset', 'NO', 'NO', 'DISABLED', 'fc977f7e6c852cfda6523fdaeeafded0');

-- --------------------------------------------------------

--
-- Table structure for table `email_update`
--

CREATE TABLE `email_update` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_email` varchar(50) NOT NULL,
  `new_email` varchar(50) NOT NULL,
  `code` int(6) NOT NULL,
  `validity_date` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_update`
--

INSERT INTO `email_update` (`id`, `user_id`, `old_email`, `new_email`, `code`, `validity_date`, `status`) VALUES
(1, 2, 'ericwinty90@gmail.com', 'ranagaurab4@gmail.com', 769348, '2021-10-27 07:49:57 PM', 'completed'),
(2, 2, 'ranagaurab4@gmail.com', 'ericwinty90@gmail.com', 251076, '2021-10-27 07:55:34 PM', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_image`
--

CREATE TABLE `homepage_image` (
  `id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `placing` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homepage_image`
--

INSERT INTO `homepage_image` (`id`, `product_id`, `image_name`, `placing`) VALUES
('1', '1', 'havells.jpg', 'heading');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `billing_address_id` varchar(50) NOT NULL,
  `shipping_address_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `payment_type`, `status`, `billing_address_id`, `shipping_address_id`) VALUES
('2135401528', 2, '2021-09-07 04:00:51 PM', 'Paypal', 'completed', '3898722888', '9192823439');

-- --------------------------------------------------------

--
-- Table structure for table `order_billing_info`
--

CREATE TABLE `order_billing_info` (
  `info_id` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_one` varchar(100) NOT NULL,
  `address_two` varchar(100) NOT NULL,
  `postal_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_billing_info`
--

INSERT INTO `order_billing_info` (`info_id`, `firstname`, `lastname`, `email_address`, `phone_number`, `country`, `address_one`, `address_two`, `postal_code`) VALUES
('3898722888', 'Gaurab', 'Rana', 'ericwinty90@gmail.com', '9868304522', 'NP', 'Kathmandu, Baneshwor', 'Near Venus Hospital', '21700');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` varchar(20) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `product_code`, `order_id`, `price`, `quantity`, `total_price`) VALUES
('0022467918', 'TOW5689', '2135401528', 6976, 1, 6976),
('5214101918', 'ELE6646', '2135401528', 3550, 3, 10650),
('6287934374', 'SWE6988', '2135401528', 28500, 2, 57000),
('6765578508', 'HUA5072', '2135401528', 32100, 1, 32100),
('6925883900', 'HAV2901', '2135401528', 15100, 1, 15100),
('8029605590', 'TAN8996', '2135401528', 68990, 4, 275960);

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping_info`
--

CREATE TABLE `order_shipping_info` (
  `shipping_info_id` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_one` varchar(100) NOT NULL,
  `address_two` varchar(100) NOT NULL,
  `postal_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_shipping_info`
--

INSERT INTO `order_shipping_info` (`shipping_info_id`, `fullname`, `email_address`, `phone_number`, `country`, `address_one`, `address_two`, `postal_code`) VALUES
('9192823439', 'Gaurab Rana', 'hello@gmail.com', '9868304522', 'NP', '6th State, Surkhet', 'Birendranagar, RajaChowk', '44100');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `transaction_id` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `paid_date` varchar(50) DEFAULT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `order_id`, `payment_type`, `transaction_id`, `amount`, `paid_date`, `status`) VALUES
('0775516163', 2, '8326462970', 'Esewa', 0, 0, NULL, 'unpaid'),
('2493622247', 2, '2135401528', 'Paypal', 0, 0, NULL, 'unpaid'),
('5782324799', 2, '5378707269', 'COD', 0, 0, NULL, 'unpaid'),
('6110397761', 2, '0528954327', 'Esewa', 0, 0, NULL, 'unpaid'),
('6319728649', 2, '3062778904', 'Paypal', 0, 0, NULL, 'unpaid'),
('zxLE0MJHIU', 2, 'RaR7fNnyl5', 'Paypal', 0, 0, NULL, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `discount` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(10) NOT NULL,
  `sold_by` varchar(50) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `shop_id` int(5) NOT NULL,
  `quantity_stock` varchar(5) NOT NULL,
  `type` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_folder_key` varchar(100) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `discount`, `description`, `code`, `sold_by`, `brand`, `shop_id`, `quantity_stock`, `type`, `category`, `image_name`, `image_folder_key`, `added_date`) VALUES
(1, 'EL-319 Double face Quartz Heater- White\r\n\r\n', 3950, '400', 'Brand:Electron\r\nModel: EL-319\r\nDouble face electric quartz heater.\r\n1600 watts\r\n4 power setting 400/800/1200/1600\r\nCan be shared by 2 person at the same time\r\nElegent design.\r\nCompact.\r\nEasy to use.\r\n1 Year Local seller warranty', 'ELE6646', 'DNS ELECTRONICS', 'Electron', 1, '50', 'Electronics', 'Heater', 'mainimage.jpg', '032721140f52809786361264f1ce109b', '0000-00-00'),
(2, 'OFR – 11Fin 2900-Watt PTC Fan Heater', 17100, '2000', 'Cord storage and rear safety cover\r\nOver heat protection and tilt over switch for safety\r\nThermostatic heat control, quick heating with PTC fan and castor wheels for easy mobility\r\n3 power settings 1000/1500/2500 watts and an additional 400 watts ( Heater + Fan)\r\nThermostatic heat control. Power input: 230 V. Frequency (hertz) : AC 50 Hz\r\nPTC heater with fan\r\nCountry of Origin: India', 'HAV2901', 'DNS ELECTRONICS', 'Havells', 1, '10', 'Electronics', 'Heater', 'mainimage.jpg', '62014d177ca8d083b6ffa20925ac49ca', '0000-00-00'),
(3, 'RD-23DC4SS 195 Ltrs Double Door Refrigerator', 33000, '4500', 'Brand: Hisense\r\nModel No: RD-23DC4SS\r\nColor: Silver\r\nCapacity:195 LTRS\r\nDoor Type: Double Door\r\nHigh efficiency compressor.\r\nHandle & lock.\r\nFood basket.\r\nLow power consumption.\r\nEnvironmental friendly product.\r\nExternal Condenser\r\nAnti bacterial gasket\r\nEgg cum and Ice Tray\r\nWorks without Stabilizer\r\nShelves Toughened Glass Shelves\r\nExteriors High Gloss Designer Panel, Bar Handle\r\nTransparent Freezer Door, Transparent Shelf Utility\r\nDoor Lock: Yes\r\nHandle Type: Ariana.\r\n2 Years Full Warranty\r\n10 Years Warranty on Compressor', 'SWE6988', 'DNS ELECTRONICS', 'Hisense', 1, '30', 'Electronics', 'Fridge', 'mainimage.jpg', 'e13d43c8094f5804c8b72f4884ac6e23', '0000-00-00'),
(4, 'TH-40F403N 40″ Full HD LED TV', 37500, '5400', 'Brand: Hisense.\nModel No: HX43M22160F.\nType: LED.\nScreen Size: 43 inch.\nScreen Size: 108 cm.\nScreen Resolution: 1920 x 1080 (Full HD).\nDisplay Feature: Full HD (FHD).\nModel Year: 2018.\nWall Mount: Yes.\n•Floor Stand: Yes.\n•Aspect Ratio: 16:9.\n•Total Sound Output: 20W.\n•Dolby DigitaL: No.\n•Connectivity: \n•HDMI 3.\n•USB 2\n•1 Year Warranty', 'HUA5072', 'DNS ELECTRONICS', 'Hisense', 1, '50', 'Electronics', 'TV', 'mainimage.jpg', '081f7bde831ab2e9c23609148214d691', '2021-01-22'),
(5, 'Samsung WW80J4213GS Fully Automatic Washing Machine', 69990, '1000', 'Brand Name: Samsung\nModel No: WW80J4213GS\nECO bubble technology\n1200 RPM\nCeramic heater\nDiamond drum\nDigital inverter technology\nIntensive stain removal\nWorks smart\nKeep your washer fresh with eco drum clean\nQuick wash program\nGentle fabric care\nSize: 8 Kg\nDigital display\nStainless Steel Drum.\nPowder coated steel metal body\nFuzzy logic\nFault check display\nWater temperature selection\n12 months full warranty\n10 years warranty on motor', 'TAN8996', 'DNS ELECTRONICS', 'Hisense', 1, '400', 'Electronics', 'Fridge', 'mainimage.jpg', '3ee9f3b434869c3b274f990255cc0fcb', '2021-01-13'),
(6, 'HAVELLS MOMENTA NV 900W MIXER GRINDER', 6976, '400', 'Brand: Havells\nModel: MOMENTA NV 900W\nColour: Blue\n3 SS Jars\nHavells Mixer Grinder has 900 Watts copper winded motors which lead to longer life of motor & superior performance.', 'TOW5689', 'DNS ELECTRONICS', 'Havells', 1, '45', 'Electronics', 'Heater', 'mainimage.jpg', 'ebe8a2202e30dbd0789f60c15e2cda40', '2021-01-17'),
(7, 'Hello', 26000, '1800', 'Too hot', 'HEL2785', 'DNS ELECTRONICS', 'Electron', 0, '80', 'Electronics', 'Heater', 'mainimage.jpg', 'da9ca70f79acdd213114c7813704b96d', '2021-10-19 10:26:10 PM'),
(8, 'Hello', 26000, '1800', 'Too hot', 'HEL9286', 'DNS ELECTRONICS', 'Electron', 0, '80', 'Electronics', 'Heater', 'mainimage.jpg', 'da9ca70f79acdd213114c7813704b96d', '2021-10-19 10:26:15 PM'),
(9, 'Hello', 26000, '1800', 'Too hot', 'HEL2950', 'DNS ELECTRONICS', 'Electron', 0, '80', 'Electronics', 'Heater', 'mainimage.jpg', 'da9ca70f79acdd213114c7813704b96d', '2021-10-19 10:26:44 PM');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `folder_key` varchar(50) NOT NULL,
  `image_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`folder_key`, `image_name`) VALUES
('3ee9f3b434869c3b274f990255cc0fcb', '29bdce05751eead68893a214c0817eb8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_in_cart`
--

CREATE TABLE `product_in_cart` (
  `id` varchar(50) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_code` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_in_cart`
--

INSERT INTO `product_in_cart` (`id`, `cart_id`, `product_code`, `quantity`) VALUES
('2aff4OO7kY', 2, 'HEL2785', 1),
('fa5LxnwB2V', 2, 'TOW5689', 2),
('IdDH2rqQjg', 2, 'ELE6646', 8),
('nJryID02Rs', 2, 'HUA5072', 2),
('pGCkRgYNgc', 2, 'SWE6988', 2),
('Rnfe2oXvh0', 2, 'TAN8996', 3),
('W5oSWeLaxF', 2, 'HAV2901', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_queries`
--

CREATE TABLE `product_queries` (
  `id` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `adminreply` text NOT NULL,
  `replied_date` varchar(50) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_queries`
--

INSERT INTO `product_queries` (`id`, `product_code`, `customer_id`, `question`, `adminreply`, `replied_date`, `added_date`) VALUES
('2458758573', 'HUA5072', '2', 'Will it be available in surkhet??', 'Yes we have delivery option for surkhet.', '2021-10-07 07:27:38 PM', '2021-10-07 07:17:35 PM'),
('2952182593', 'ELE6646', '1', 'Can i buy this product now?', 'Yes it is available in our stock.', '2021-10-07 06:56:24 PM', '2021-08-30 10:46:21 AM'),
('3405781237', 'ELE6646', '3', 'How much for this?', 'Around 60k only. Yes you can buy.', '2021-10-07 06:56:27 PM', '2021-08-30 10:48:52 PM'),
('5959474616', 'ELE6646', '2', 'How much time for delivery?', 'Around 2-3 working days.', '2021-10-07 06:56:30 PM', '2021-09-01 05:07:56 PM'),
('6548245765', 'HAV2901', '2', 'Heloo', '-', '-', '2021-10-19 10:29:41 PM');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` varchar(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `added_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `customer_id`, `product_code`, `rating`, `comment`, `added_date`) VALUES
('23011037804', 2, 'TOW5689', 2, 'Good ', '2021-10-19 10:31:16 PM'),
('74187149815', 2, 'ELE6646', 4, 'Very good Product', '2021-10-20 07:47:59 PM'),
('8058486855f', 3, 'HAV2901', 3, 'Very helpful product', '2021-09-02 03:06:37 AM');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE `shipping_info` (
  `shipping_info_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `billing_info` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `address_one` varchar(100) NOT NULL,
  `address_two` varchar(100) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `added_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`shipping_info_id`, `user_id`, `billing_info`, `fullname`, `email_address`, `phone_number`, `country`, `address_one`, `address_two`, `postal_code`, `added_date`) VALUES
('5597261015', '2', '9258948281', 'Gaurab Rana', 'ericwinty90@gmail.com', '123456798796', 'NP', 'Hello ktm', 'Birendranagar Itram', '66000', '2021-10-24 08:02:38 PM'),
('asd213', '2', 'ZwIvJyOeuc', 'Gaurab Rana', 'ranagaurab4@gmail.com', '9868304522', 'NP', '6th State, Surkhet', 'Birendranagar, RajaChowk', '44100', '2021-10-24 03:19:03 PM');

-- --------------------------------------------------------

--
-- Table structure for table `trader`
--

CREATE TABLE `trader` (
  `shop_id` int(3) NOT NULL,
  `trader_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_type` varchar(50) NOT NULL,
  `shop_description` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `joined_date` date NOT NULL,
  `approved` varchar(5) NOT NULL,
  `active` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trader`
--

INSERT INTO `trader` (`shop_id`, `trader_name`, `username`, `password`, `shop_name`, `shop_type`, `shop_description`, `email`, `phone_number`, `address`, `joined_date`, `approved`, `active`) VALUES
(1, 'Gaurab Rana', 'gaurab3404', 'd0aabe9a362cb2712ee90e04810902f3', 'Hello Nepal', 'Furniture', 'Hand made furnitures', 'ericwinty90@gmail.com', '+9779868304622', 'Surkhet Nepal', '2020-11-29', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(50) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `customer_id`, `product_code`) VALUES
('2kKpe0JtZ4', 2, 'ELE6646'),
('yPhX5os2rF', 2, 'HUA5072');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `billing_info`
--
ALTER TABLE `billing_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_update`
--
ALTER TABLE `email_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_image`
--
ALTER TABLE `homepage_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_billing_info`
--
ALTER TABLE `order_billing_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shipping_info`
--
ALTER TABLE `order_shipping_info`
  ADD PRIMARY KEY (`shipping_info_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`folder_key`);

--
-- Indexes for table `product_in_cart`
--
ALTER TABLE `product_in_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_queries`
--
ALTER TABLE `product_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `shipping_info`
--
ALTER TABLE `shipping_info`
  ADD PRIMARY KEY (`shipping_info_id`);

--
-- Indexes for table `trader`
--
ALTER TABLE `trader`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `email_update`
--
ALTER TABLE `email_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
