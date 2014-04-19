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
class DjgRssController extends PluginController {
    public function __construct() {
		if (defined('CMS_BACKEND')) {
			AuthUser::load();
			if ( !(AuthUser::isLoggedIn()) ) {
				redirect(get_url('login'));
			}		
			$this->setLayout('backend');
			$this->assignToLayout('sidebar', new View('../../plugins/djg_rss/views/sidebar'));
		}else{
			$page = $this->findByUri();
			$this->setLayout('none');
		}
	}
    public function index() {
        $this->documentation();
    }
	public function settings() 
	{
		$this->display('djg_rss/views/settings', array('settings' => Plugin::getAllSettings('djg_rss')));
	}
    function save() {
		$settings = $_POST['settings'];
        $ret = Plugin::setAllSettings($settings, 'djg_rss');
        if ($ret)
            Flash::set('success', __('The settings have been updated.'));
        else
            Flash::set('error', 'An error has occurred while trying to save the settings.');
        redirect(get_url('plugin/djg_rss/settings'));
	}
	public function documentation() {
		$content = Parsedown::instance()->parse(file_get_contents(PLUGINS_ROOT.DS.'djg_rss'.DS.'README.md'));
        $this->display('djg_rss/views/documentation', array('content'=>$content));
    }
	public static function by_id($pageId){
		self::rss($pageId);
	}
	public static function by_slug($slug){
		$page = Page::find($slug);
		self::rss($page->id);
	}
	private static function string_replace($string){
		return strip_tags($string);
	}
	public static function rss($pageId,$limit=null)
	{
		$limit = ($limit==null) ? Plugin::getSetting('maxFeedsPerChanel','djg_rss') : $limit;
		$rss_channel = new rssGeneratorChannel();
		$rss_channel->atomLinkHref = '';
		$rss_channel->title = Page::findById($pageId)->title();
		$rss_channel->link = Page::findById($pageId)->url();
		$rss_channel->description = 'description';
		$rss_channel->language = 'pl';
		$rss_channel->generator = Plugin::getSetting('generator','djg_rss');
		$rss_channel->managingEditor = Plugin::getSetting('managingEditor','djg_rss');
		$rss_channel->webMaster = Plugin::getSetting('webMaster','djg_rss');
		
		$feeds = Page::findById($pageId);
		foreach ($feeds->children(array('limit' => $limit, 'order' => 'page.created_on DESC', 'status_id'=>100)) as $feed):
			$item = new rssGeneratorItem();
			$item->title = self::string_replace($feed->title());
			$item->description = self::string_replace($feed->content());
			$item->link = $feed->url();
			$item->guid = $feed->url();
			$item->pubDate = date(DATE_RSS, mktime( $feed->date('%H', 'created'),  $feed->date('%M', 'created'),  $feed->date('%S', 'created'), $feed->date('%m', 'created'), $feed->date('%d', 'created'), $feed->date('%Y', 'created')));
			$rss_channel->items[] = $item;
		endforeach;
		$rss_feed = new rssGeneratorRss();
		$rss_feed->encoding = 'UTF-8';
		$rss_feed->version = '2.0';
		header('Content-Type: text/xml');
		echo $rss_feed->createFeed($rss_channel);
		exit();
	}
}