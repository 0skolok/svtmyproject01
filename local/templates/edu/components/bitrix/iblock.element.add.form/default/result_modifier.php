<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["PROPERTY_LIST"] as $propertyID) {
    if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"]) {
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "USER_TYPE";
    }

    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
        && $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1") {

        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
    }

    if (($propertyID == "TAGS") && CModule::IncludeModule('search')) {
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";
    }

    if (isset($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"]) &&
        $arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime") {

        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "DATETIME";
    }
}
?>
