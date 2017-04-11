<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$isMainPage = false;

if ($APPLICATION->GetCurPage(false) === SITE_DIR)
{
	$isMainPage = true;
}

?>
<!DOCTYPE HTML>
<!--
	TXT by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="<?=LANGUAGE_ID?>">
<head>
	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle(); ?></title>
	<?=$APPLICATION->AddHeadString('<meta name="viewport" content="width=device-width, initial-scale=1" />', false)?>
	<?=$APPLICATION->AddHeadString(
		'<!--[if lte IE 8]><script src="' . SITE_TEMPLATE_PATH .
		'/struct/assets/js/ie/html5shiv.js"></script><![endif]-->', false
	);?>
	<?=$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/struct/assets/css/main.css")?>
	<?=$APPLICATION->AddHeadString(
		'<!--[if lte IE 8]><link rel="stylesheet" href="' . SITE_TEMPLATE_PATH .
		'/struct/assets/css/ie8.css" /><![endif]-->', false
	);?>
</head>
<body class="homepage">
<? $APPLICATION->ShowPanel() ?>
<div id="page-wrapper">
	<!-- Header -->
	<header id="header">
		<div class="logo container">
			<div>
				<h1>
					<a href="<?=SITE_DIR?>" id="logo">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/include/subtext-logo.php"
							)
						); ?>
					</a>
				</h1>
				<p>
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/text-logo.php"
						)
					); ?>
				</p>
			</div>
		</div>
	</header>

	<!-- Nav -->
	<nav id="nav">
		<ul>
			<li class="current"><a href="<?=SITE_TEMPLATE_PATH?>index.html">Home</a></li>
			<li>
				<a href="#">Dropdown</a>
				<ul>
					<li><a href="#">Lorem ipsum dolor</a></li>
					<li><a href="#">Magna phasellus</a></li>
					<li>
						<a href="#">Phasellus consequat</a>
						<ul>
							<li><a href="#">Lorem ipsum dolor</a></li>
							<li><a href="#">Phasellus consequat</a></li>
							<li><a href="#">Magna phasellus</a></li>
							<li><a href="#">Etiam dolore nisl</a></li>
						</ul>
					</li>
					<li><a href="#">Veroeros feugiat</a></li>
				</ul>
			</li>
			<li><a href="<?=SITE_TEMPLATE_PATH?>left-sidebar.html">Left Sidebar</a></li>
			<li><a href="<?=SITE_TEMPLATE_PATH?>right-sidebar.html">Right Sidebar</a></li>
			<li><a href="<?=SITE_TEMPLATE_PATH?>no-sidebar.html">No Sidebar</a></li>
		</ul>
	</nav>

	<? if ($isMainPage): ?>
		<!-- Banner -->
		<div id="banner-wrapper">
			<section id="banner">
				<h2><? $APPLICATION->ShowTitle(false) ?></h2>
				<p>A free responsive site template built on HTML5, CSS3, skel, and some other stuff</p>
				<a href="#" class="button">Alright let's go</a>
			</section>
		</div>
		<!-- Main -->
	<? endif; ?>
	<div id="main-wrapper">
		<div id="main" class="container">
