<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach (GetModuleEvents("main", "system.field.edit.file", true) as $arEvent) {
    if (ExecuteModuleEventEx($arEvent, array($arResult, $arParams)))
        return;
}

$postFix = ($arParams["arUserField"]["MULTIPLE"] == "Y" ? "[]" : "");?>

<div class="fields files" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">
    <?foreach ($arResult["VALUE"] as $i => $res):?>
        <div class="form-group">
            <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
                   for="<?=$arParams["arUserField"]["FIELD_NAME"]?>">
                <i class="glyphicon glyphicon-remove-circle fa fa-times-circle <?if (
                    $arParams["arUserField"]["MULTIPLE"] != "Y" ||
                    $arParams["SHOW_BUTTON"] == "N" ||
                    $arParams["arUserField"]["EDIT_IN_LIST"]=="N" ||
                    $i==0
                ):?> hide<?endif;?>" onClick="removeFileElement(this); return false;"></i>
                <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
            </label>
            <div class="col-md-9">
                <input type="hidden" name="<?=$arParams["arUserField"]["~FIELD_NAME"]?>_old_id<?=$postFix?>" value="<?=$res?>" />
                <?=$arResult["VALUE_HTML"][$i]?>
                <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                    <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                <?endif;?>
            </div>
        </div>
    <?endforeach;?>
</div>

<?if ($arParams["arUserField"]["MULTIPLE"] == "Y" && $arParams["SHOW_BUTTON"] != "N" && $arParams["arUserField"]["EDIT_IN_LIST"]!="N"):?>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <a href="#" class="action" onClick="addFileElement('<?=$arParams["arUserField"]["FIELD_NAME"]?>', this); return false;"><?=GetMessage("USER_TYPE_PROP_ADD")?></a>
        </div>
    </div>
<?endif;?>
