<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * @package Plugins
 * @subpackage djg_crss
 *
 * @author Michał Uchnast <djgprv@gmail.com>
 * @copyright kreacjawww.pl, 2014
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */

Plugin::setInfos(array(
    'id'			=> 'djg_rss',
    'title'			=> __('[djg] RSS'),
    'description'	=> __('RSS generator'),
    'version'		=> '0.1',
   	'license'		=> 'GPL',
	'author'		=> 'Michał Uchanst',
    'website'		=> 'http://www.kreacjawww.pl/',
	'type'			=>	'both'
));
Plugin::addController('djg_rss', __('[djg] RSS'), 'administrator', false);
AutoLoader::addFolder(PLUGINS_ROOT.'/djg_rss/models/');
Dispatcher::addRoute(array(
	'/djg_rss/id/:any.xml' => '/plugin/djg_rss/by_id/$1'
));
?>