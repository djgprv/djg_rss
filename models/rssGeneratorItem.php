<?php

/*
  RSS Feed Generator for PHP 4 or higher version
  Version 1.0.3  
  Written by Vagharshak Tozalakyan <vagh@armdex.com>
  License: GNU Public License

  Classes in package:
    class rssGenerator_rss
    class rssGenerator_channel
    class rssGenerator_image
    class rssGenerator_textInput
    class rssGenerator_item

  For additional information please reffer the documentation
*/
class rssGeneratorItem
{
    var $title = '';
    var $description = '';
    var $link = '';
    var $author = '';
    var $pubDate = '';
    var $comments = '';
    var $guid = '';
    var $guid_isPermaLink = true;
    var $source = '';
    var $source_url = '';
    var $enclosure_url = '';
    var $enclosure_length = '0';
    var $enclosure_type = '';
    var $categories = array();

}
?>