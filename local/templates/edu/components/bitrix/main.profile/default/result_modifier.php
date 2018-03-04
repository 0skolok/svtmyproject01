<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["profileErrors"] = explode('<br>', $arResult["strProfileError"]);
foreach($arResult["profileErrors"] as $i => $v) {
    if (strpos($v, '<br')!==false) { unset($arResult["profileErrors"][$i]); }
}

$arResult["arUser"]["PERSONAL_PHOTO_CONTROL"] = parseFileInputFromHTML(
    $arResult["arUser"]["PERSONAL_PHOTO_INPUT"].
    $arResult["arUser"]["PERSONAL_PHOTO"].
    $arResult["arUser"]["PERSONAL_PHOTO_HTML"]
);

$arResult["arUser"]["WORK_LOGO_CONTROL"] = parseFileInputFromHTML(
    $arResult["arUser"]["WORK_LOGO_INPUT"].
    $arResult["arUser"]["WORK_LOGO"].
    $arResult["arUser"]["WORK_LOGO_HTML"]
);

$arResult["arForumUser"]["AVATAR_CONTROL"] = parseFileInputFromHTML(
    $arResult["arForumUser"]["AVATAR_INPUT"].
    $arResult["arForumUser"]["AVATAR"].
    $arResult["arForumUser"]["AVATAR_HTML"]
);

$arResult["arBlogUser"]["AVATAR_CONTROL"] = parseFileInputFromHTML(
    $arResult["arBlogUser"]["AVATAR_INPUT"].
    $arResult["arBlogUser"]["AVATAR"].
    $arResult["arBlogUser"]["AVATAR_HTML"]
);


?>
