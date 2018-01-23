<?php

$eltd_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$eltd_pages[$page->ID] = $page->post_title;
}

global $chandelier_elated_IconCollections;

//Portfolio Images

$eltdPortfolioImages = new ChandelierMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$chandelier_elated_Framework->eltdMetaBoxes->addMetaBox("portfolio_images",$eltdPortfolioImages);

	$eltd_portfolio_image_gallery = new ChandelierMultipleImages("eltd_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$eltdPortfolioImages->addChild("eltd_portfolio-image-gallery",$eltd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$eltdPortfolioImagesVideos2 = new ChandelierMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$chandelier_elated_Framework->eltdMetaBoxes->addMetaBox("portfolio_images_videos2",$eltdPortfolioImagesVideos2);

	$eltd_portfolio_images_videos2 = new ChandelierImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$eltdPortfolioImagesVideos2->addChild("eltd_portfolio_images_videos2",$eltd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$eltdAdditionalSidebarItems = new ChandelierMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$chandelier_elated_Framework->eltdMetaBoxes->addMetaBox("portfolio_properties",$eltdAdditionalSidebarItems);

	$eltd_portfolio_properties = new ChandelierOptionsFramework("Portfolio Properties","ThisIsDescription");
	$eltdAdditionalSidebarItems->addChild("eltd_portfolio_properties",$eltd_portfolio_properties);

