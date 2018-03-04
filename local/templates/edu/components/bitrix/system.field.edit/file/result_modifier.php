<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["VALUE"] as $i => $res) {
    $html = CFile::InputFile($arParams["arUserField"]["FIELD_NAME"], 0, $res, false, 0, "", "", 0, "", ' value="'.$res.'"', true, isset($arParams['SHOW_FILE_PATH']) ? $arParams['SHOW_FILE_PATH'] : true).
        CFile::ShowImage($res, 0, 0, null, '', false, 0, 0, 0, !empty($arParams['FILE_URL_TEMPLATE']) ? $arParams['FILE_URL_TEMPLATE'] : '');
    $arResult["VALUE_HTML"][$i] = parseFileInputFromHTML($html);
}



?>
