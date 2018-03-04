<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init(array('jquery', 'fx', 'popup', 'window', 'ajax'));

if($arParams["DELIVERY_NO_AJAX"] == "N") {
    $APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");
    $APPLICATION->AddHeadScript($templateFolder."/proceed.js");
}


