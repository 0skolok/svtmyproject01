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

	<?$APPLICATION->IncludeComponent("bitrix:menu", "main", Array(
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "3",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
		false
	);?>

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
