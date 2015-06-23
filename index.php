<?php
if (!defined('IN_CMS')) { exit(); }
/**
 * @package Plugins
 * @subpackage djg_rss
 *
 * @author Michał Uchnast <djgprv@gmail.com>
 * @copyright kreacjawww.pl, 2014
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */
Plugin::setInfos(array(
    'id'			=>	'djg_rss',
    'title'			=>	__('[djg] RSS Feed'),
    'description'	=>	__('RSS Feed generator'),
    'version'		=>	'0.1b',
	'author'		=>	'Michał Uchanst',
    'website'		=>	'http://www.kreacjawww.pl/',
	'type'			=>	'both'
));
Plugin::addController('djg_rss', __('[djg] RSS Feed'), 'administrator', false);
AutoLoader::addFolder(PLUGINS_ROOT.'/djg_rss/models/');
Dispatcher::addRoute(array(
	'/djg_rss/id/:any.xml' => '/plugin/djg_rss/by_id/$1',
	'/djg_rss/:any.xml' => '/plugin/djg_rss/by_slug/$1'
));
?>