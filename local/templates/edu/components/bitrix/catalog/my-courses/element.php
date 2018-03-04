<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Loader;

$element = array();
$arFilter = array();

Loader::includeModule('iblock');

if ($arResult['VARIABLES']['ELEMENT_ID'])
{
	$arFilter['ID'] = $arResult['VARIABLES']['ELEMENT_ID'];
}
elseif ($arResult['VARIABLES']['ELEMENT_CODE'])
{
	$arFilter['CODE'] = $arResult['VARIABLES']['ELEMENT_CODE'];
}

if ($arFilter)
{
	$arFilter['IBLOCK_ID'] = $arParams['IBLOCK_ID'];

	$rsElement = CIBlockElement::GetList(
		array(),
		$arFilter,
		false,
		false,
		array(
			'IBLOCK_ID',
			'ID',
			'PROPERTY_COURSE',
		)
	);

	$element = $rsElement->fetch();
}
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:learning.course", 
	"main",
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_PERMISSIONS" => "Y",
		"COURSE_ID" => $element["PROPERTY_COURSE_VALUE"],
		"PAGE_NUMBER_VARIABLE" => "PAGE",
		"PAGE_WINDOW" => "10",
		"PATH_TO_USER_PROFILE" => "/company/personal/user/#USER_ID#/",
		"SEF_FOLDER" => $arResult['FOLDER'],
		"SEF_MODE" => "N",
		"SET_TITLE" => "Y",
		"SHOW_TIME_LIMIT" => "Y",
		"TESTS_PER_PAGE" => "20",
		"COMPONENT_TEMPLATE" => "main",
		"VARIABLE_ALIASES" => array(
			"COURSE_ID" => "COURSE_ID",
			"INDEX" => "INDEX",
			"LESSON_ID" => "LESSON_ID",
			"CHAPTER_ID" => "CHAPTER_ID",
			"SELF_TEST_ID" => "SELF_TEST_ID",
			"TEST_ID" => "TEST_ID",
			"TYPE" => "TYPE",
			"TEST_LIST" => "TEST_LIST",
			"GRADEBOOK" => "GRADEBOOK",
			"FOR_TEST_ID" => "FOR_TEST_ID",
		)
	),
	false
);?>