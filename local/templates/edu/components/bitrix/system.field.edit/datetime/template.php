<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="fields datetime" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">

    <?$index = 0; $fIndex = time();
    foreach ($arResult["VALUE"] as $i => $res):

        if($index == 0 && $arParams["arUserField"]["ENTITY_VALUE_ID"]<1 && $arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"]["TYPE"]!="NONE")
        {
            if($arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"]["TYPE"]=="NOW")
                $res = ConvertTimeStamp(time()+CTimeZone::GetOffset(), "FULL");
            else
                $res = str_replace(" 00:00:00", "", CDatabase::FormatDate($arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"]["VALUE"], "YYYY-MM-DD HH:MI:SS", CLang::GetDateFormat("FULL")));
        }

        $name = $arParams["arUserField"]["FIELD_NAME"];
        if ($arParams["arUserField"]["MULTIPLE"] == "Y")
            $name = $arParams["arUserField"]["~FIELD_NAME"]."[".$index."]";

        if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y") {
            $disabled="disabled='disabled' ";
        }


        ?>
        <div class="form-group">
            <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
                   for="<?=$name?>_<?=$i?>">
                <i class="glyphicon glyphicon-remove-circle fa fa-times-circle <?if (
                    $arParams["arUserField"]["MULTIPLE"] != "Y" ||
                    $arParams["SHOW_BUTTON"] == "N" ||
                    $arParams["arUserField"]["EDIT_IN_LIST"]=="N" ||
                    $i==0
                ):?> hide<?endif;?>" onClick="removeDateElement(this); return false;"></i>
                <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
            </label>
            <div class="col-md-9">
                <?$GLOBALS['APPLICATION']->IncludeComponent(
                    "bitrix:main.calendar",
                    "",
                    array(
                        "SHOW_INPUT" => "Y",
                        "FORM_NAME" => $arParams["form_name"],
                        "INPUT_NAME" => $name,
                        "INPUT_VALUE" => $res,
                        "SHOW_TIME" => 'Y',
                        "~INPUT_ADDITIONAL_ATTR" => "placeholder='".$arParams["arUserField"]["EDIT_FORM_LABEL"]."' ".$disabled,
                        "ADD_ID" => '_'.$i,
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );?>
                <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                    <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                <?endif;?>
            </div>
        </div>
        <?$index++;
    endforeach;?>
</div>

<?if ($arParams["arUserField"]["MULTIPLE"] == "Y" && $arParams["SHOW_BUTTON"] != "N" && $arParams["arUserField"]["EDIT_IN_LIST"]!="N"):?>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <a href="#" class="action" onClick="addDateElement('<?=$arParams["arUserField"]["FIELD_NAME"]?>', this); return false;"><?=GetMessage("USER_TYPE_PROP_ADD")?></a>
        </div>
    </div>
<?endif;?>