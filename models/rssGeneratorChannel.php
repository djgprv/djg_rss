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

class rssGeneratorChannel 
{ 
    var $atomLinkHref = ''; 
    var $title = ''; 
    var $link = ''; 
    var $description = ''; 
    var $language = ''; 
    var $copyright = ''; 
    var $managingEditor = ''; 
    var $webMaster = ''; 
    var $pubDate = ''; 
    var $lastBuildDate = ''; 
    var $categories = array(); 
    var $generator = ''; 
    var $docs = ''; 
    var $ttl = ''; 
    var $image = ''; 
    var $textInput = ''; 
    var $skipHours = array(); 
    var $skipDays = array(); 
    var $cloud_domain = ''; 
    var $cloud_port = '80'; 
    var $cloud_path = ''; 
    var $cloud_registerProcedure = ''; 
    var $cloud_protocol = ''; 
    var $items = array(); 
    var $extraXML = ''; 
} 
?>