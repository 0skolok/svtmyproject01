<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$bWasSelect = false;?>

<div class="fields enumeration" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">
    <input type="hidden" name="<?=$arParams["arUserField"]["FIELD_NAME"]?>" value="">

    <div class="form-group">
        <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
               for="<?echo $arParams["arUserField"]["FIELD_NAME"]?>">
            <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
        </label>
        <div class="col-md-9">
            <?if ($arParams["arUserField"]["SETTINGS"]["DISPLAY"] == "CHECKBOX")
            {
                foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val)
                {
                    $bSelected = in_array($key, $arResult["VALUE"]) && (
                        (!$bWasSelect) ||
                        ($arParams["arUserField"]["MULTIPLE"] == "Y")
                    );
                    $bWasSelect = $bWasSelect || $bSelected;

                    if($arParams["arUserField"]["MULTIPLE"]=="Y"):?>
                        <label class="checkbox">
                            <input type="checkbox"
                                value="<?=$key?>"
                                name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                    disabled="disabled"
                                <?endif;?>
                                <?=($bSelected? "checked" : "")?>
                            > <?=$val?>
                        </label>
                    <?else:?>
                        <label class="radio">
                            <input type="radio"
                                value="<?=$key?>"
                                name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                    disabled="disabled"
                                <?endif;?>
                                <?=($bSelected? "checked" : "")?>
                                > <?=$val?>
                        </label>
                    <?endif;
                }
                if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                    <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                <?endif;

            } else {?>
                <select
                    name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                    class="form-control"
                    id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                    <?if($arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"] > 1):?>
                        size="<?=$arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"]?>"
                    <?endif;?>
                    <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                        disabled="disabled"
                    <?endif;?>
                    <?if ($arParams["arUserField"]["MULTIPLE"]=="Y"):?>
                        multiple="multiple"
                    <?endif;?>
                >
                    <?foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val) {
                        $bSelected = in_array(strval($key), $arResult["VALUE"], true) && (
                            (!$bWasSelect) ||
                            ($arParams["arUserField"]["MULTIPLE"] == "Y")
                        );
                        $bWasSelect = $bWasSelect || $bSelected;?>
                        <option value="<?echo $key?>"<?echo ($bSelected? " selected" : "")?>><?echo $val?></option>
                    <?}?>
                </select>
                <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                    <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                <?endif;
            }?>
        </div>
    </div>

</div>
