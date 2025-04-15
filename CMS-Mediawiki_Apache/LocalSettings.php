<?php
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

# General
$wgSitename = "Wiki";
$wgScriptPath = "";
$wgCacheDirectory = "$IP/cache";
$wgServer = "https://localhost";
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];
$wgEnableUploads = true;
$wgEnableEmail = false;
$wgLocaltimezone = "UTC";
$wgSecretKey = "";
$wgAuthenticationTokenVersion = "1";
$wgUpgradeKey = "";
$wgLogos = [
	'icon' => "/images/site_icon.png",
	'wordmark' => [
		'src' => "/images/site_wordmark.png",
		'width' => 133,
		'height' => 50,
	],
];
$wgHashedUploadDirectory = false;
$wgFavicon = "/resources/assets/icon.png";
unset( $wgFooterIcons['copyright'] );
unset( $wgFooterIcons['poweredby'] );

# Database
$wgDBname = "mediawiki";
$wgDBuser = "mediawiki";
$wgDBpassword = "";
$wgDBprefix = "en_";
$wgSharedDB = 'mediawiki';
$wgSharedPrefix = 'en_';
$wgSharedTables = [
	'actor',
	'block',
	'block_target',
	'bot_passwords',
	'interwiki',
	'module_deps',
	'user',
	'user_autocreate_serial',
	'user_former_groups',
	'user_groups',
	'user_newtalk',
	'user_properties',
	'site_stats',
];

# User
$wgGroupPermissions["*"]["edit"] = false;
$wgGroupPermissions['sysop']['interwiki'] = true;
$wgHiddenPrefs = [
	'skin',
	'fancysig',
	'nickname',
	'gender',
	'realname',
	'language',
	'visualeditor-enable',
	'skin-responsive',
	'date',
	'timecorrection',
	'imagesize',
	'thumbsize',
	'editsectiononrightclick',
	'editondblclick',
	'minordefault',
	'previewonfirst',
	'previewontop',
	'uselivepreview',
	'useeditwarning',
	'editfont',
	'forceeditsummary',
	'visualeditor-betatempdisable',
	'visualeditor-newwikitext',
	'vector-limited-width',
	'vector-font-size',
	'diffonly',
	'norollbackdiff',
	'underline',
	'forcesafemode',
	'showrollbackconfirmation',
	'showhiddencats',
	'vector-theme',
	'rclimit',
	'rcdays',
	'usenewrc',
	'rcenhancedfilters-disable',
	'hideminor',
	'hidepatrolled',
	'newpageshidepatrolled',
	'wllimit',
	'watchlistdays',
	'wlenhancedfilters-disable',
	'watchlistunwatchlinks',
	'extendwatchlist',
	'watchmoves',
	'watchdefault',
	'watchdeletion',
    'watchuploads',
	'watchcreations',
	'watchrollback',
	'watchlisttoken',
	'watchlisthideminor',
	'watchlisthidebots',
	'watchlisthideown',
	'watchlisthideanons',
	'watchlisthideliu',
	'watchlisthideliu',
	'watchlisthidepatrolled',
	'searchlimit',
];

# Skins and Extensions
$wgVectorLanguageInMainPageHeader = true;
$wgVectorUseIconWatch = false;
$wgVectorResponsive = true;
$wgVectorWvuiSearchOptions['showThumbnail'] = false;
$wgVectorWvuiSearchOptions['showDescription'] = false;
wfLoadSkin( 'Vector' );
wfLoadExtension( 'Interwiki' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'VisualEditor' );
wfLoadExtension( 'TemplateData' );
