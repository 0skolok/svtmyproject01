<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arExt = array();
if($arParams["POPUP"])
	$arExt[] = "window";

CUtil::InitJSCore($arExt);
$APPLICATION->SetAdditionalCSS("/bitrix/js/socialservices/css/ss.css");
$APPLICATION->AddHeadScript("/bitrix/js/socialservices/ss.js");
?>