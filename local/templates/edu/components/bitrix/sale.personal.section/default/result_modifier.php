<?php
use Bitrix\Main\Localization\Loc;

$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arResult['PATH_TO_ORDERS'],
	"name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
	"icon" => '<i class="fa fa-calculator"></i>'
	);
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arResult['PATH_TO_ACCOUNT'],
	"name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
	"icon" => '<i class="fa fa-credit-card"></i>'
	);
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arResult['PATH_TO_PRIVATE'],
	"name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
	"icon" => '<i class="fa fa-user-secret"></i>'
	);
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
	$availablePages[] = array(
	"path" => $arResult['PATH_TO_ORDERS'].$delimeter."filter_history=Y",
	"name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
	"icon" => '<i class="fa fa-list-alt"></i>'
	);
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arResult['PATH_TO_PROFILE'],
	"name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
	"icon" => '<i class="fa fa-list-ol"></i>'
	);
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arParams['PATH_TO_BASKET'],
	"name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
	"icon" => '<i class="fa fa-shopping-cart"></i>'
	);
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y')
{
	$availablePages[] = array(
	"path" => $arParams['PATH_TO_CONTACT'],
	"name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
	"icon" => '<i class="fa fa-info-circle"></i>'
	);
}

$customPagesList = json_decode(htmlspecialchars_decode($arParams['CUSTOM_PAGES']));
if ($customPagesList)
{
	foreach ($customPagesList as $page)
	{
		$availablePages[] = array(
		"path" => $page[0],
		"name" => $page[1],
		"icon" => (strlen($page[2])) ? '<i class="fa '.htmlspecialcharsbx($page[2]).'"></i>' : ""
		);
	}
}
$arResult['AVAILABLE_PAGES'] = $availablePages;