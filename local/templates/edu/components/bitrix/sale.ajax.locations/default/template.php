<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-ajax-locations">

    <?$disabled = false;
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
                $disabled = true;
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
    <?endif;


    if (isset($_REQUEST["NEW_LOCATION_".$arParams["ORDER_PROPS_ID"]]) && IntVal($_REQUEST["NEW_LOCATION_".$arParams["ORDER_PROPS_ID"]]) > 0) {
        $disabled = true;
    }

    if ($arParams["AJAX_CALL"] != "Y"):?>
        <div id="LOCATION_<?=$arParams["CITY_INPUT_NAME"];?>">
    <?endif?>


    <?if (count($arResult["COUNTRY_LIST"]) == 1):
        $arCountry = array_pop(array_values($arResult["COUNTRY_LIST"]));?>
        <select class="form-control location-select" disabled id="<?=$arParams["COUNTRY_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" name="<?=$arParams["COUNTRY_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" onChange="<?=$change?>" type="location">
            <option value="<?= $arCountry["ID"] ?>" selected="selected"><?=$arCountry["NAME_LANG"]?></option>
        </select>
    <?elseif (count($arResult["COUNTRY_LIST"]) > 1):
        if ($arResult["EMPTY_CITY"] == "Y" && $arResult["EMPTY_REGION"] == "Y") {
            $change = $arParams["ONCITYCHANGE"];
        } else {
            $change = "getLocation(this.value, '', '', ".$arResult["JS_PARAMS"].", '".CUtil::JSEscape($arParams["SITE_ID"])."', '".$templateFolder."')";
        }?>
        <select class="form-control location-select" <?if($disabled) echo "disabled";?> id="<?=$arParams["COUNTRY_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" name="<?=$arParams["COUNTRY_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" onChange="<?=$change?>" type="location">
            <option><?echo GetMessage('SAL_CHOOSE_COUNTRY')?></option>
            <?foreach ($arResult["COUNTRY_LIST"] as $arCountry):?>
                <option value="<?=$arCountry["ID"]?>"<?if ($arCountry["ID"] == $arParams["COUNTRY"]):?> selected="selected"<?endif;?>><?=$arCountry["NAME_LANG"]?></option>
            <?endforeach;?>
        </select>
    <?endif;?>


    <?if (count($arResult["REGION_LIST"]) == 1):
        $arRegion = array_pop(array_values($arResult["REGION_LIST"]));?>
        <select class="form-control location-select" <?=$id?> disabled name="<?=$arParams["REGION_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" onChange="<?=$change?>" type="location">
            <option value="<?= $arRegion["ID"] ?>" selected="selected"><?=$arRegion["NAME_LANG"]?></option>
        </select>
    <?elseif (count($arResult["REGION_LIST"]) > 1):
        $id = "";
        if (count($arResult["COUNTRY_LIST"]) <= 0) {
            $id = "id=\"".$arParams["COUNTRY_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]."\"";
        }

        if ($arResult["EMPTY_CITY"] == "Y") {
            $change = $arParams["ONCITYCHANGE"];
        } else {
            $change = "getLocation(".$arParams["COUNTRY"].", this.value, '', ".$arResult["JS_PARAMS"].", '".CUtil::JSEscape($arParams["SITE_ID"])."', '".$templateFolder."')";
        }?>
        <select class="form-control location-select" <?=$id?> <?if($disabled) echo "disabled";?> name="<?=$arParams["REGION_INPUT_NAME"].$arParams["CITY_INPUT_NAME"]?>" onChange="<?=$change?>" type="location">
            <option><?echo GetMessage('SAL_CHOOSE_REGION')?></option>
            <?foreach ($arResult["REGION_LIST"] as $arRegion):?>
                <option value="<?=$arRegion["ID"]?>"<?if ($arRegion["ID"] == $arParams["REGION"]):?> selected="selected"<?endif;?>><?=$arRegion["NAME_LANG"]?></option>
            <?endforeach;?>
        </select>
    <?endif;?>


    <?if (count($arResult["CITY_LIST"]) > 0):
        $id = "";
        if (count($arResult["COUNTRY_LIST"]) <= 0 && count($arResult["REGION_LIST"]) <= 0) {
            $id = "id=\"".$arParams["COUNTRY_INPUT_NAME"]."\"";
        } else {
            $id = "id=\"".$arParams["CITY_INPUT_NAME"]."\"";
        }?>
        <select class="form-control location-select" <?=$id?> <?if($disabled) echo "disabled";?> name="<?=$arParams["CITY_INPUT_NAME"]?>"<?if (strlen($arParams["ONCITYCHANGE"]) > 0):?> onchange="<?=$arParams["ONCITYCHANGE"]?>"<?endif;?> type="location">
            <option><?echo GetMessage('SAL_CHOOSE_CITY')?></option>
            <?foreach ($arResult["CITY_LIST"] as $arCity):?>
                <option value="<?=$arCity["ID"]?>"<?if ($arCity["ID"] == $arParams["CITY"]):?> selected="selected"<?endif;?>><?=($arCity['CITY_ID'] > 0 ? $arCity["CITY_NAME"] : GetMessage('SAL_CHOOSE_CITY_OTHER'))?></option>
            <?endforeach;?>
        </select>
    <?endif;?>

    <?if ($arParams["AJAX_CALL"] != "Y"):?>
        </div>
        <div id="wait_container_<?=$arParams["CITY_INPUT_NAME"]?>" style="display: none;"></div>
    <?endif;?>

    <?if ($arParams["AJAX_CALL"] != "Y" && $arParams["PUBLIC"] != "N"):?>
        <script>
            function newlocation(orderPropId) {
                var select = document.getElementById("LOCATION_ORDER_PROP_" + orderPropId);

                arSelect = select.getElementsByTagName("select");
                if (arSelect.length > 0) {
                    for (var i in arSelect) {
                        var elem = arSelect[i];
                        elem.disabled = false;
                    }
                }
            }
        </script>
    <?endif;?>
</div>