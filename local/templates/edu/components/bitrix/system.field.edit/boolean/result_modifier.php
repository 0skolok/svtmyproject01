<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult["VALUE"] as $key => $value) {
    if ($value===NULL) unset($arResult["VALUE"][$key]);
}
?>
