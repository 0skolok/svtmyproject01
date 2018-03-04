<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if( $arParams["arUserField"]["ENTITY_VALUE_ID"] <= 0
	&& $arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"] > 0 ) {
	$arResult['VALUE'] = array($arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"]);
} else {
	$arResult['VALUE'] = array_filter($arResult["VALUE"]);
}?>
<div class="fields iblock_element" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">

    <div class="form-group">
        <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
               for="<?echo $arParams["arUserField"]["FIELD_NAME"]?>">
            <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
        </label>
        <div class="col-md-9">
            <?if($arParams['arUserField']["SETTINGS"]["DISPLAY"] != "CHECKBOX")
            {
                if($arParams["arUserField"]["MULTIPLE"] == "Y")
                { ?>

                    <select multiple="multiple"
                            name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                            class="form-control"
                            id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                            size="<?=$arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"]?>"
                            <?=($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"? ' disabled="disabled" ':'')?> >
                        <?foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val) {
                            $bSelected = in_array($key, $arResult["VALUE"]);?>
                            <option value="<?=$key?>" <?=($bSelected? 'selected="selected"' : '')?> title="<?=trim($val, " .")?>"><?=$val?></option>
                        <?}?>
                    </select>
                    <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                        <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                    <?endif;
                } else { ?>
                    <select name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                            class="form-control"
                            id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                            size="<?=$arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"]?>"
                            <?=($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"? ' disabled="disabled" ':'')?> >
                    <?$bWasSelect = false;
                    foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val) {
                        if($bWasSelect)
                            $bSelected = false;
                        else
                            $bSelected = in_array($key, $arResult["VALUE"]);

                        if($bSelected)
                            $bWasSelect = true;
                        ?>
                        <option value="<?=$key?>" <?=($bSelected? 'selected="selected"' : '')?> title="<?=trim($val, " .")?>"><?=$val?></option>
                    <? } ?>
                    </select>
                    <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                        <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                    <?endif;?>
                <? }
            } else {
                if($arParams["arUserField"]["MULTIPLE"] == "Y") { ?>
                    <input type="hidden" value="" name="<?echo $arParams["arUserField"]["FIELD_NAME"]?>">
                    <?foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val) {
                        $id = $arParams["arUserField"]["FIELD_NAME"]."_".$key;
                        $bSelected = in_array($key, $arResult["VALUE"]); ?>
                        <label class="checkbox<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>">
                            <input type="checkbox"
                                   value="<?=$key?>"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=($bSelected? 'checked="checked"' : '')?>
                            > <?=$val?>
                        </label>
                    <? }
                    if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                        <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                    <?endif;
                } else {
                    if($arParams["arUserField"]["MANDATORY"] != "Y") {
                        $id = $arParams["arUserField"]["FIELD_NAME"]."_no"; ?>
                        <label class="radio<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>">
                            <input type="radio"
                                   value="<?=$key?>"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=($bSelected? 'checked="checked"' : '')?>
                                > <?=GetMessage("MAIN_NO")?>
                        </label>
                    <? }

                    $bWasSelect = false;
                    foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val) {
                        $id = $arParams["arUserField"]["FIELD_NAME"]."_".$key;

                        if($bWasSelect)
                            $bSelected = false;
                        else
                            $bSelected = in_array($key, $arResult["VALUE"]);

                        if($bSelected)
                            $bWasSelect = true; ?>
                        <label class="radio<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>">
                            <input type="radio"
                                   value="<?=$key?>"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=($bSelected? 'checked="checked"' : '')?>
                            > <?=$val?>
                        </label>
                    <? }
                    if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                        <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                    <?endif;

                }
            } ?>
        </div>
    </div>

</div>
