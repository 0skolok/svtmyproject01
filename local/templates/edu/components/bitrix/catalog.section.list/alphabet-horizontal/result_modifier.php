<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arEng = array();
$arRus = array();
$allEng = array();
$allRus = array();

foreach ($arResult["SECTIONS"] as &$arItem) {
    $firstSymbol = substr($arItem["NAME"], 0, 1);

    if (IsEnglishSymbol($firstSymbol)) {
        $arEng[ strtoupper($firstSymbol) ][] = $arItem;
        $allEng[] = $arItem;
    } elseif (IsRussianSymbol($firstSymbol)) {
        $arRus[ strtoupper($firstSymbol) ][] = $arItem;
        $allRus[] = $arItem;
    } else { // (is_numeric($firstSymbol)) - all other
        $arNum[] = $arItem;
    }
}



if (count($arEng) < 3) { // say we need 3 different letters to show this language letters in different rows
    unset($arEng);
    sort($allEng);
} else {
    unset($allEng);
    ksort($arEng);
}

if (count($arRus) < 3) { // say we need 3 different letters to show this language letters in different rows
    unset($arRus);
    sort($allRus);
} else {
    unset($allRus);
    ksort($arRus);
}

$arResult["GROUPS"] = array();

if (count($arNum) > 0) {
    $arResult["GROUPS"][] = array("TITLE" => "#", "ELEMENTS" => $arNum);
}

if (isset($allEng) && count($allEng) > 0) {
    $arResult["GROUPS"][] = array("TITLE" => "ENG", "ELEMENTS" => $allEng);
}

if (isset($arEng) && count($arEng) > 0) {
    foreach ($arEng as $symbol => $arElements) {
        $arResult["GROUPS"][] = array("TITLE" => $symbol, "ELEMENTS" => $arElements);
    }
}

if (isset($allRus) && count($allRus) > 0) {
    $arResult["GROUPS"][] = array("TITLE" => GetMessage('ALPHABET_RUS'), "ELEMENTS" => $allRus);
}

if (isset($arRus) && count($arRus) > 0) {
    foreach ($arRus as $symbol => $arElements) {
        $arResult["GROUPS"][] = array("TITLE" => $symbol, "ELEMENTS" => $arElements);
    }
}


switch ($arParams['ITEMS_PER_ROW']) {
    case 2:
        $arResult["COLUMN_CLASS"] = "col-sm-6";
        break;

    case 3:
        $arResult["COLUMN_CLASS"] = "col-sm-4";
        break;

    case 4:
        $arResult["COLUMN_CLASS"] = "col-sm-3";
        break;

    case 6:
        $arResult["COLUMN_CLASS"] = "col-sm-2";
        break;

    default: //4
        $arResult["COLUMN_CLASS"] = "col-sm-3";
        break;
}


?>
