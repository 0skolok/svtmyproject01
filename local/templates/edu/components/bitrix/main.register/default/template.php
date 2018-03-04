<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="bx-auth-reg">

<?if($USER->IsAuthorized()):
    echo ShowNote(GetMessage("MAIN_REGISTER_AUTH"), "info");
else:
    if (count($arResult["ERRORS"]) > 0) {
        $arrError = array();
        foreach ($arResult["ERRORS"] as $key => $error) {
            if ($key !== 0) {
                $arrError[] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
            } else {
                $arrError[] .= $error;
            }
        }
        echo ShowError(implode("\n", $arrError));
    } elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && isset($arResult['VALUES']["USER_ID"]) &&  intval($arResult['VALUES']["USER_ID"])>0){
        echo ShowNote(GetMessage("AUTH_EMAIL_SENT"), "success");
    } elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {
        echo ShowNote(GetMessage("REGISTER_EMAIL_WILL_BE_SENT"));
    }?>

    <form method="post" class="form-horizontal" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
        <?if($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif;?>

        <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
            <?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
                <div class="form-group">
                    <label class="control-label col-md-3<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?> required<?endif?>"
                           for="REGISTER[AUTO_TIME_ZONE]">
                        <?=GetMessage("main_profile_time_zones_auto")?>
                    </label>
                    <div class="col-md-9">
                        <select name="REGISTER[AUTO_TIME_ZONE]"
                                class="form-control"
                                id="REGISTER[AUTO_TIME_ZONE]"
                                onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
                            <option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
                            <option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
                            <option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?> required<?endif?>"
                           for="REGISTER[TIME_ZONE]">
                        <?=GetMessage("main_profile_time_zones_zones")?>
                    </label>
                    <div class="col-md-9">
                        <select name="REGISTER[TIME_ZONE]"
                                class="form-control"
                                id="REGISTER[TIME_ZONE]"
                                <?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])):?>
                                    disabled="disabled"
                                <?endif;?>>
                            <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
                                <option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
                            <?endforeach?>
                        </select>
                    </div>
                </div>
            <?else:?>
                <div class="form-group">
                    <label class="control-label col-md-3<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?> required<?endif?>"
                           for="REGISTER[<?=$FIELD?>]">
                        <?=GetMessage("REGISTER_FIELD_".$FIELD)?>
                    </label>
                    <div class="col-md-9">
                        <?switch ($FIELD) {
                            case "PASSWORD":?>
                                <?if($arResult["SECURE_AUTH"]):?>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="REGISTER[<?=$FIELD?>]" id="REGISTER[<?=$FIELD?>]" maxlength="50" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>"></i></span>
                                    </div>
                                <?else:?>
                                    <input type="password" class="form-control" name="REGISTER[<?=$FIELD?>]" id="REGISTER[<?=$FIELD?>]" maxlength="50" id="REGISTER[<?=$FIELD?>]" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>">
                                <?endif;?>
                                <span class="help-block"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
                                <?break;

                            case "CONFIRM_PASSWORD":?>
                                <input type="password" name="REGISTER[<?=$FIELD?>]" class="form-control" id="REGISTER[<?=$FIELD?>]" maxlength="50" id="REGISTER[<?=$FIELD?>]" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>">
                                <?break;

                            case "PERSONAL_GENDER":?>
                                <select name="REGISTER[<?=$FIELD?>]" class="form-control" id="REGISTER[<?=$FIELD?>]">
                                    <option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
                                    <option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
                                    <option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
                                </select>
                                <?break;

                            case "PERSONAL_COUNTRY":
                            case "WORK_COUNTRY":?>
                                <select name="REGISTER[<?=$FIELD?>]" class="form-control" id="REGISTER[<?=$FIELD?>]">
                                    <?foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
                                        <option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
                                    <?endforeach;?>
                                </select>
                                <?break;

                            case "PERSONAL_PHOTO":
                            case "WORK_LOGO":?>
                                <?=parseFileInputFromHTML('<input size="30" type="file" name="REGISTER_FILES_'.$FIELD.'" id="REGISTER['.$FIELD.']" placeholder="'.GetMessage("REGISTER_FIELD_".$FIELD).'" />');?>
                                <?break;

                            case "PERSONAL_NOTES":
                            case "WORK_NOTES":?>
                                <textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]" class="form-control" id="REGISTER[<?=$FIELD?>]" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>"><?=$arResult["VALUES"][$FIELD]?></textarea>
                                <?break;

                            default:?>
                                <?if ($FIELD == "PERSONAL_BIRTHDAY") {
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                            'SHOW_INPUT' => 'Y',
                                            'FORM_NAME' => 'regform',
                                            'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                            'INPUT_VALUE' => $arResult["VALUES"][$FIELD],
                                            'SHOW_TIME' => 'N'
                                        ),
                                        null,
                                        array("HIDE_ICONS"=>"Y")
                                    );
                                    if ($FIELD == "PERSONAL_BIRTHDAY"):?>
                                        <br /><small><?=$arResult["DATE_FORMAT"]?></small>
                                    <?endif;
                                } else {?>
                                    <input size="30" type="text" name="REGISTER[<?=$FIELD?>]" class="form-control" id="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" />
                                <?}

                        }?>
                    </div>
                </div>
            <?endif?>
        <?endforeach?>

        <?// ********************* User properties ***************************************************?>
        <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):
            foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:system.field.edit",
                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                    array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"),
                    null, array("HIDE_ICONS"=>"Y")
                );
            endforeach;
        endif;?>
        <?// ******************** /User properties ***************************************************?>

        <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
            <div class="form-group">
                <label class="control-label col-md-3 required" for="inputCaptcha"><?echo GetMessage("REGISTER_CAPTCHA_PROMT")?></label>
                <div class="col-md-9">
                    <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                    <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                    <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" id="inputCaptcha" placeholder="<?echo GetMessage("REGISTER_CAPTCHA_PROMT")?>">
                </div>
            </div>
        <?endif?>

        <div class="form-group">
            <div class="col-md-9  col-md-offset-3">
                <button type="submit" class="btn btn-primary pull-right" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>"><?=GetMessage("AUTH_REGISTER")?></button>
            </div>
        </div>
    </form>

<?endif?>
</div>