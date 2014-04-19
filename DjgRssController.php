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
	public function settings($page=NULL) 
	{
		if($page):
			Flash::set('success', __('Your settings have been updated'));
			redirect(get_url('plugin/djg_rss/settings'));
		else:
			$settings = Plugin::getAllSettings('djg_rss');
			$this->display('djg_rss/views/settings', array('settings' => $settings));
		endif;
	}
	
    function save() 
	{
        if (isset($_POST['settings'])):
            $settings = $_POST['settings'];
            foreach ($settings as $key => $value) $settings[$key] = mysql_escape_string($value);
            $ret = Plugin::setAllSettings($settings, 'djg_rss');
            if ($ret):
                Flash::set('success', __('The settings have been saved.'));
            else:
                Flash::set('error', __('An error occured trying to save the settings.'));
            endif;
        else:
            Flash::set('error', __('Could not save settings, no settings found.'));
        endif;
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
		$find[] = '<';
        $find[] = '\x92';
        $find[] = '\x84';
        $find[] = '\x92';
        $find[] = '\x84';
        $find[] = '&nbsp;';

        $replace[] = '&#x3C;';
        $replace[] = '&#39;';
        $replace[] = '&#34;';
        $replace[] = '&#39;';
        $replace[] = '&#34;';
        $replace[] = ' ';
		
		return strip_tags($string);
	}
	
function xml_character_encode($string, $trans='') {

}
	public static function rss($pageId,$limit=10)
	{
		$rss_channel = new rssGeneratorChannel();
		$rss_channel->atomLinkHref = '';
		$rss_channel->title = Page::findById($pageId)->title();
		$rss_channel->link = Page::findById($pageId)->url();
		$rss_channel->description = 'description';
		$rss_channel->language = 'pl';
		$rss_channel->generator = 'djg_rss WolfCMS plugin';
		$rss_channel->managingEditor = 'editor@mysite.com (Alex Jefferson)';
		$rss_channel->webMaster = 'webmaster@mysite.com (Vagharshak Tozalakyan)';
		
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