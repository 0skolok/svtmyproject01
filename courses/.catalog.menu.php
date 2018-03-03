<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

global $APPLICATION;

$aMenuLinks = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DEPTH_LEVEL" => "4",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"ID" => "",
		"IS_SEF" => "N",
		"SECTION_URL" => ""
	),
	$component
);