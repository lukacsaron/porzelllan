<?php

namespace Chandelier\Modules\Shortcodes\Lib;

use Chandelier\Modules\CallToAction\CallToAction;
use Chandelier\Modules\Counter\Countdown;
use Chandelier\Modules\Counter\Counter;
use Chandelier\Modules\ElementsHolder\ElementsHolder;
use Chandelier\Modules\ElementsHolderItem\ElementsHolderItem;
use Chandelier\Modules\GoogleMap\GoogleMap;
use Chandelier\Modules\Process\Process;
use Chandelier\Modules\Process\ProcessHolder;
use Chandelier\Modules\Separator\SectionTitle;
use Chandelier\Modules\Separator\Separator;
use Chandelier\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Chandelier\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Chandelier\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Chandelier\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Chandelier\Modules\Shortcodes\Icon\Icon;
use Chandelier\Modules\Shortcodes\ImageGallery\ImageGallery;
use Chandelier\Modules\SocialShare\SocialShare;
use Chandelier\Modules\Team\Team;
use Chandelier\Modules\TeamHolder\TeamHolder;
use Chandelier\Modules\OrderedList\OrderedList;
use Chandelier\Modules\UnorderedList\UnorderedList;
use Chandelier\Modules\Message\Message;
use Chandelier\Modules\ProgressBar\ProgressBar;
use Chandelier\Modules\IconListItem\IconListItem;
use Chandelier\Modules\Tabs\Tabs;
use Chandelier\Modules\Tab\Tab;
use Chandelier\Modules\PricingTables\PricingTables;
use Chandelier\Modules\PricingTable\PricingTable;
use Chandelier\Modules\Accordion\Accordion;
use Chandelier\Modules\AccordionTab\AccordionTab;
use Chandelier\Modules\BlogList\BlogList;
use Chandelier\Modules\Shortcodes\Button\Button;
use Chandelier\Modules\Blockquote\Blockquote;
use Chandelier\Modules\CustomFont\CustomFont;
use Chandelier\Modules\Highlight\Highlight;
use Chandelier\Modules\VideoButton\VideoButton;
use Chandelier\Modules\Dropcaps\Dropcaps;
use Chandelier\Modules\Shortcodes\IconWithText\IconWithText;
use Chandelier\Modules\CoverBoxesHolder\CoverBoxesHolder;
use Chandelier\Modules\CoverBoxesItem\CoverBoxesItem;
use Chandelier\Modules\ImageWaterfall\ImageWaterfall;
use Chandelier\Modules\ImageWaterfallItem\ImageWaterfallItem;
use Chandelier\Modules\ImageWaterfallHeading\ImageWaterfallHeading;
/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader
{
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new TeamHolder());
		$this->addShortcode(new Team());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Message());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new CoverBoxesHolder());
		$this->addShortcode(new CoverBoxesItem());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new Process());
		$this->addShortcode(new ImageWaterfall());
		$this->addShortcode(new ImageWaterfallItem());
		$this->addShortcode(new ImageWaterfallHeading());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();