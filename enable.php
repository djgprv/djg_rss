<?php
if (!defined('IN_CMS')) { exit(); }
/**
 * @package Plugins
 * @subpackage djg_rss
 *
 * @author Micha³ Uchnast <djgprv@gmail.com>
 * @copyright kreacjawww.pl, 2014
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */ 
$settings = array(
	'ver' => '0.1b',
	'displayChannelContent' => '0',
	'generator' => 'djg_rss plugin for Wolf CMS',
	'managingEditor' => 'Wolf CMS',
	'webMaster' => '',
	'maxFeedsPerChannel' => '100',
	'language' => Setting::get('language')
);
Plugin::setAllSettings($settings, 'djg_rss');
exit();