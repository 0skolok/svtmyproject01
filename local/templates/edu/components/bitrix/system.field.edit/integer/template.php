<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="fields integer" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">
    <?foreach ($arResult["VALUE"] as $i => $res):?>
        <div class="form-group">
            <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
                   for="<?=$arParams["arUserField"]["FIELD_NAME"]?>_<?=$i?>">
                <i class="glyphicon glyphicon-remove-circle fa fa-times-circle <?if (
                    $arParams["arUserField"]["MULTIPLE"] != "Y" ||
                    $arParams["SHOW_BUTTON"] == "N" ||
                    $arParams["arUserField"]["EDIT_IN_LIST"]=="N" ||
                    $i==0
                ):?> hide<?endif;?>" onClick="removeIntElement(this); return false;"></i>
                <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
            </label>
            <div class="col-md-9">
                <input type="text"
                       name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                       class="form-control"
                       id="<?=$arParams["arUserField"]["FIELD_NAME"]?>_<?=$i?>"
                       value="<?=$res?>"
                       placeholder="<?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>"
                       <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                           disabled="disabled"
                       <?endif;?>
                >
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
            <a href="#" class="action" onClick="addIntElement('<?=$arParams["arUserField"]["FIELD_NAME"]?>', this); return false;"><?=GetMessage("USER_TYPE_PROP_ADD")?></a>
        </div>
    </div>
<?endif;?>
