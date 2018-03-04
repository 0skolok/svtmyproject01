<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="fields boolean" id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">

    <?foreach ($arResult["VALUE"] as $res):?>
        <div class="form-group">
            <?switch($arParams["arUserField"]["SETTINGS"]["DISPLAY"])
            {
                case "DROPDOWN":?>
                    <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
                           for="<?=$arParams["arUserField"]["FIELD_NAME"]?>">
                        <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
                    </label>
                    <div class="col-md-9">
                        <select name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                class="form-control"
                                id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                    disabled="disabled"
                                <?endif;?>
                            >
                            <option value="1"<?=($res? ' selected="selected"': '')?>><?=GetMessage("MAIN_YES")?></option>
                            <option value="0"<?=(!$res? ' selected="selected"': '')?>><?=GetMessage("MAIN_NO")?></option>
                        </select>
                        <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                            <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                        <?endif;?>
                    </div>
                    <?break;
                case "RADIO":?>
                    <label class="control-label col-md-3<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>"
                           for="<?=$arParams["arUserField"]["FIELD_NAME"]?>">
                        <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
                    </label>

                    <div class="col-md-9">
                        <label class="radio-inline">
                            <input type="radio"
                                   value="1"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=($res ? ' checked="checked"': '')?>
                            > <?=GetMessage("MAIN_YES")?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio"
                                   value="0"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=(!$res ? ' checked="checked"': '')?>
                            > <?=GetMessage("MAIN_NO")?>
                        </label>
                        <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                            <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                        <?endif;?>
                    </div>
                    <?break;
                default:?>
                    <div class="col-md-9 col-md-offset-3">
                        <label class="checkbox<?if ($arParams["arUserField"]["MANDATORY"]=="Y"):?> required<?endif;?>">
                            <input type="hidden"
                                   value="0"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                            >
                            <input type="checkbox"
                                   value="1"
                                   name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   id="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
                                   <?if ($arParams["arUserField"]["EDIT_IN_LIST"]!="Y"):?>
                                       disabled="disabled"
                                   <?endif;?>
                                   <?=($res ? 'checked="checked"': '')?>
                            > <?=$arParams["arUserField"]["EDIT_FORM_LABEL"]?>
                        </label>
                        <?if(strlen($arParams["arUserField"]["HELP_MESSAGE"])>0):?>
                            <span class="help-block"><?=$arParams["arUserField"]["HELP_MESSAGE"]?></span>
                        <?endif;?>
                    </div>
                    <?break;
            }?>
        </div>
    <?endforeach;?>
</div>
