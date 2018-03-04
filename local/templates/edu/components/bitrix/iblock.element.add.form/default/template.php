<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(count($arResult["ERRORS"]) > 0){
    echo ShowError(implode("\n", $arResult["ERRORS"]));
}

if (strlen($arResult["MESSAGE"]) > 0) {
	echo ShowNote($arResult["MESSAGE"]);
}?>

<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="form-horizontal">

	<?=bitrix_sessid_post()?>

	<?if ($arParams["MAX_FILE_SIZE"] > 0):?>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
    <?endif?>

    <?foreach ($arResult["PROPERTY_LIST"] as $propertyID):
        if (intval($propertyID) > 0) {
            $title = $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"];
        } else {
            $title = !empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID);
        }

        $required = in_array($propertyID, $arResult["PROPERTY_REQUIRED"]);

        if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y") {
            $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
            $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
        } else {
            $inputNum = 1;
        }

        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
            $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][0]["VALUE"] :
	            $arResult["ELEMENT"][$propertyID];
        } else {
            $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
        }

        $input_id = "PROPERTY[".$propertyID."][0]";
        ?>

        <div class="form-group">
            <label class="control-label col-md-3<?if($required):?> required<?endif;?>" for="<?=$input_id?>"><?=$title?></label>
            <div class="col-md-9">
                    <?switch($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"]) {
                        case "F":
                            for ($i = 0; $i<$inputNum; $i++) {
                                $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID]; ?>
                                <input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
                                <p>
                                    <span class="btn btn-default">
                                        <span class="choose" data-default="'<?=GetMessage('CHOOSE_FILE')?>'"><?=GetMessage('CHOOSE_FILE')?></span>
                                        <input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" onchange="fileChanged(this)" id="PROPERTY[<?=$propertyID?>][<?=$i?>]" />
                                    </span>
                                </p>
                                <?if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value])) { ?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /> <?=GetMessage('REMOVE_FILE')?>
                                    </label>
                                    <?if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"]) { ?>
                                        <img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" />
                                    <? } else { ?>
                                        <?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
                                        <?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
                                        [<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]
                                    <? }
                                }
                            }
                            break;

                        case "L":
                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                            else
                                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

                            switch ($type) {
                                case "checkbox":
                                case "radio":
                                $keys = array_keys($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"]);
                                $first_key = (count($keys)>0) ? $keys[0] : 0;
                                foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                        $checked = false;
                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                            if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                                                foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                                                    if ($arElEnum["VALUE"] == $key) {$checked = true; break;}
                                                }
                                            }
                                        } else {
                                            if ($arEnum["DEF"] == "Y") $checked = true;
                                        } ?>
                                        <label class="<?=$type?>">
                                            <input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="PROPERTY[<?=$propertyID?>][<?=$key-$first_key?>]"<?=$checked ? " checked=\"checked\"" : ""?> />
                                            <?=$arEnum["VALUE"]?>
                                        </label>
                                    <? }
                                    break;

                                case "dropdown":
                                case "multiselect": ?>
                                    <select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>" id="PROPERTY[<?=$propertyID?>][0]" class="form-control">
                                        <option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
                                        <?if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                                        else $sKey = "ELEMENT";

                                        foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                            $checked = false;
                                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum) {
                                                    if ($key == $arElEnum["VALUE"]) {$checked = true; break;}
                                                }
                                            } else {
                                                if ($arEnum["DEF"] == "Y") $checked = true;
                                            }?>
                                            <option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
                                        <? } ?>
                                    </select>
                                    <?break;
                            }
                            break;

                        case "N":
                        case "S":
                            for ($i = 0; $i<$inputNum; $i++) { ?>
                                <input type="text" class="form-control" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" id="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="30" value="<?=$value?>" placeholder="<?=$title?>" /><?
                            }
                            break;

                        case "T":
                            for ($i = 0; $i<$inputNum; $i++) { ?>
                                <textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" id="PROPERTY[<?=$propertyID?>][<?=$i?>]" placeholder="<?=$title?>" class="form-control"><?=$value?></textarea>
                            <? }
                            break;

                        case "DATETIME":
                            for ($i = 0; $i<$inputNum; $i++) {
                                $APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar', '',
                                    array(
                                        'FORM_NAME' => 'iblock_add',
                                        'SHOW_INPUT' => 'Y',
                                        'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
                                        'INPUT_VALUE' => $value,
                                        "~INPUT_ADDITIONAL_ATTR" => "placeholder='".$title."' ",
                                    ), null, array('HIDE_ICONS' => 'Y')
                                );
                            }
                            break;

                        case "HTML":
                            $LHE = new CLightHTMLEditor;
                            $LHE->Show(array(
                                'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
                                'width' => '100%',
                                'height' => '200px',
                                'inputName' => "PROPERTY[".$propertyID."][0]",
                                'content' => $arResult["ELEMENT"][$propertyID],
                                'bUseFileDialogs' => false,
                                'bFloatingToolbar' => false,
                                'bArisingToolbar' => false,
                                'toolbarConfig' => array(
                                    'Bold', 'Italic', 'Underline', 'RemoveFormat',
                                    'CreateLink', 'DeleteLink', 'Image', 'Video',
                                    'BackColor', 'ForeColor',
                                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
                                    'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
                                    'StyleList', 'HeaderList',
                                    'FontList', 'FontSizeList',
                                ),
                            ));
                            break;

                        case "TAGS":
                            $APPLICATION->IncludeComponent(
                                "bitrix:search.tags.input", "",
                                array(
                                    "VALUE" => $arResult["ELEMENT"][$propertyID],
                                    "NAME" => "PROPERTY[".$propertyID."][0]",
                                    "TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
                                    "PLACEHOLDER" => $title,
                                ), null, array("HIDE_ICONS"=>"Y")
                            );
                            break;

                        case "USER_TYPE":
                        default:?>
                            <?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"]) {
                                for ($i = 0; $i<$inputNum; $i++) {
                                    echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                                        array(
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID],
                                            array(
                                                "VALUE" => $value,
                                                "DESCRIPTION" => $description,
                                            ),
                                            array(
                                                "VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
                                                "DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
                                                "FORM_NAME"=>"iblock_add",
                                            ),
                                        ));
                                }
                            } else
                                echo ShowError(GetMessage("CT_INPROP").$title." ".GetMessage("CT_INPROP_NOFUNC"));
                            break;?>
                        <?
                    }?>
                <?if(strlen($arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"])>0):?>
                    <span class="help-inline"><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["HINT"]?></span>
                <?endif;?>
            </div>
        </div>

    <?endforeach;?>


    <?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
        <div class="form-group">
            <label class="control-label col-md-3 required" for="inputCaptcha"><?echo GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></label>
            <div class="col-md-9">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
                <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                <input class="form-control" type="text" name="captcha_word" maxlength="50" value="" id="inputCaptcha"
                       placeholder="<?echo GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?>">
            </div>
        </div>
    <?endif?>

    <div class="form-group">
        <?if (strlen($arParams["LIST_URL"]) > 0):?>
            <a href="<?=$arParams["LIST_URL"]?>" class="control-label col-md-3"><?=GetMessage("IBLOCK_FORM_BACK")?></a>
        <?endif?>
        <div class="col-md-9<?if (strlen($arParams["LIST_URL"]) > 0):?> col-md-offset-3<?endif?>">
            <button type="submit" class="btn btn-primary pull-right" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>"><?=GetMessage("IBLOCK_FORM_SUBMIT")?></button>
            <?if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0):?>
                <button type="submit" class="btn btn-default pull-right" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>"><?=GetMessage("IBLOCK_FORM_APPLY")?></button>
            <?endif?>
        </div>
    </div>
</form>
