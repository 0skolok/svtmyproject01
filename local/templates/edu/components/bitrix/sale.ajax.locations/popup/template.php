<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-ajax-locations">

    <?$APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");

    if ($arParams["AJAX_CALL"] != "Y"
        && count($arParams["LOC_DEFAULT"]) > 0
        && $arParams["PUBLIC"] != "N"
        && $arParams["SHOW_QUICK_CHOOSE"] == "Y"):

        $isChecked = "";
        foreach ($arParams["LOC_DEFAULT"] as $val):
            $checked = "";
            if ((($val["ID"] == IntVal($_REQUEST["NEW_LOCATION_".$arParams["ORDER_PROPS_ID"]])) || ($val["ID"] == $arParams["CITY"])) && (!isset($_REQUEST["CHANGE_ZIP"]) || $_REQUEST["CHANGE_ZIP"] != "Y"))
            {
                $checked = "checked";
                $isChecked = "Y";
            }?>

            <div class="radio">
                <label>
                    <input type="radio" id="loc_<?=$val["ID"]?>" name="NEW_LOCATION_<?=$arParams["ORDER_PROPS_ID"]?>" value="<?=$val["ID"]?>" onChange="<?=$arParams["ONCITYCHANGE"]?>;" <?=$checked?>>
                    <?=$val["LOC_DEFAULT_NAME"]?>
                </label>
            </div>
        <?endforeach;?>

        <div class="radio">
            <label>
                <input type="radio" onclick="newlocation(<?=$arParams["ORDER_PROPS_ID"]?>);" name="NEW_LOCATION_<?=$arParams["ORDER_PROPS_ID"]?>" value="0" id="loc_0" <?if($isChecked!="Y") echo 'checked';?>>
                <?=GetMessage("LOC_DEFAULT_NAME_NULL")?>
            </label>
        </div>
    <?endif;?>

    <input name="<?echo $arParams["CITY_INPUT_NAME"]?>_val" id="<?echo $arParams["CITY_INPUT_NAME"]?>_val" value="<?=$arResult["LOCATION_STRING"]?>" class="search-suggest form-control location-select" type="text" autocomplete="off" onfocus="loc_sug_CheckThis(this, this.id);" />
    <input type="hidden" name="<?echo $arParams["CITY_INPUT_NAME"]?>" id="<?echo $arParams["CITY_INPUT_NAME"]?>" value="<?=$arResult["LOCATION_DEFAULT"]?>">
    <script type="text/javascript">

        if (typeof oObject != "object")
            window.oObject = {};

        document.loc_sug_CheckThis = function(oObj, id) {
            try {
                if(SuggestLoadedSale) {
                    window.oObject[oObj.id] = new JsSuggestSale(oObj, '<?echo $arResult["ADDITIONAL_VALUES"]?>', '', '', '<?=CUtil::JSEscape($arParams["ONCITYCHANGE"])?>');
                    return;
                } else {
                    setTimeout(loc_sug_CheckThis(oObj, id), 10);
                }
            } catch(e) {
                setTimeout(loc_sug_CheckThis(oObj, id), 10);
            }
        }

        clearLocInput = function() {
            var inp = BX("<?echo $arParams["CITY_INPUT_NAME"]?>_val");
            if(inp) {
                inp.value = "";
                inp.focus();
            }
        }
    </script>
</div>