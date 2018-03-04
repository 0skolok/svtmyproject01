<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
    "ITEMS_PER_ROW" => array(
        "NAME" => GetMessage("T_IBLOCK_ITEMS_PER_ROW"),
        "TYPE" => "LIST",
        "VALUES" => Array(
            2 => 2,
            3 => 3,
            4 => 4,
            6 => 6,
        ),
        "PARENT" => "ADDITIONAL_SETTINGS",
    ),
    "ITEMS_IN_LETTER" => array(
        "NAME" => GetMessage("ABC_ITEMS_IN_LETTER"),
        "TYPE" => "STRING",
        "DEFAULT" => "0",
        "PARENT" => "ADDITIONAL_SETTINGS",
    )
);

?>
