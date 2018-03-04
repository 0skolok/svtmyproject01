<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach($arResult["ITEMS"] as $i => $arItem){
    if(!array_key_exists("HIDDEN", $arItem) && strpos($arItem["INPUT"], "form-control")=== false){
        $arItem["INPUT"] = preg_replace('/(<\S+? )/',
            '${1}'.' class="form-control" id="'.$arItem["INPUT_NAME"].'" '
            , $arItem["INPUT"], 2
        );

        if (strpos($arItem["INPUT"], GetMessage("IBLOCK_FILTER_TILL")) !== false) {
            $arItem["INPUT"] = str_replace("&nbsp;", "", $arItem["INPUT"]);
            $inputs = explode(GetMessage("IBLOCK_FILTER_TILL"), $arItem["INPUT"]);

            $arItem["INPUT"] = '<div class="row"><div class="col-md-6">'.$inputs[0].'</div><div class="col-md-6">'.$inputs[1].'</div></div>';

            $arItem["INPUT"] = str_replace(GetMessage("IBLOCK_FILTER_TILL"), "", $arItem["INPUT"]);
        }

        $arResult["ITEMS"][$i]["INPUT"] = $arItem["INPUT"];
    }
}
?>