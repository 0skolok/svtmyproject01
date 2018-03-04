<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="bx-auth-profile">
    <?
    if (!empty($arResult['profileErrors']))
		echo ShowError(implode("\n", $arResult["profileErrors"]));
	if ($arResult['DATA_SAVED'] == 'Y')
		echo ShowNote(GetMessage('PROFILE_DATA_SAVED'), "success");
	?>

    <form method="post" name="profileform" class="form-horizontal" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
        <div id="bx-auth-profile-content" class="tab-content">
            <ul class="nav nav-tabs" id="bx-auth-profile-tabs" data-cookie-prefix="<?=$arResult["COOKIE_PREFIX"]?>">
                <li class="active"><a href="#tab-reg" data-toggle="tab"><?=GetMessage("REG_SHOW_HIDE")?></a></li>
                <li><a href="#tab-personal" data-toggle="tab"><?=GetMessage("USER_PERSONAL_INFO")?></a></li>
                <li><a href="#tab-work" data-toggle="tab"><?=GetMessage("USER_WORK_INFO")?></a></li>
                <?if($arResult["INCLUDE_FORUM"] == "Y"):?>
                    <li><a href="#tab-forum" data-toggle="tab"><?=GetMessage("forum_INFO")?></a></li>
                <?endif?>
                <?if($arResult["INCLUDE_BLOG"] == "Y"):?>
                    <li><a href="#tab-blog" data-toggle="tab"><?=GetMessage("blog_INFO")?></a></li>
                <?endif?>
                <?if($arResult["INCLUDE_LEARNING"] == "Y"):?>
                    <li><a href="#tab-learning" data-toggle="tab"><?=GetMessage("learning_INFO")?></a></li>
                <?endif?>
                <?if($arResult["IS_ADMIN"]):?>
                    <li><a href="#tab-notes" data-toggle="tab"><?=GetMessage("USER_ADMIN_NOTES")?></a></li>
                <?endif;?>
                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                    <li><a href="#tab-properties" data-toggle="tab"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></li>
                <?endif;?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab-reg">
                    <?=$arResult["BX_SESSION_CHECK"]?>
                    <input type="hidden" name="lang" value="<?=LANG?>" />
                    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                    <div class="form-group">
                        <label class="control-label col-md-3" for="LAST_NAME"><?=GetMessage('LAST_NAME')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="LAST_NAME" id="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="<?=GetMessage('LAST_NAME')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="NAME"><?=GetMessage('NAME')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="NAME" id="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" placeholder="<?=GetMessage('NAME')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="SECOND_NAME"><?=GetMessage('SECOND_NAME')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="SECOND_NAME" id="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" placeholder="<?=GetMessage('SECOND_NAME')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 required" for="EMAIL"><?=GetMessage('EMAIL')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="EMAIL" id="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" placeholder="<?=GetMessage('EMAIL')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 required" for="LOGIN"><?=GetMessage('LOGIN')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="LOGIN" id="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" placeholder="<?=GetMessage('LOGIN')?>" />
                        </div>
                    </div>

                    <?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="NEW_PASSWORD"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
                            <div class="col-md-9">
                                <?if($arResult["SECURE_AUTH"]):?>
                                    <div class="input-group">
                                        <input type="password" name="NEW_PASSWORD" id="NEW_PASSWORD" class="form-control" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_REQ')?>" />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>"></i></span>
                                    </div>
                                <?else:?>
                                    <input type="password" name="NEW_PASSWORD" id="NEW_PASSWORD" class="form-control" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_REQ')?>" />
                                <?endif;?>
                                <span class="help-block"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="NEW_PASSWORD_CONFIRM"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
                            <div class="col-md-9">
                                <input type="password" name="NEW_PASSWORD_CONFIRM" class="form-control" id="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>" />
                            </div>
                        </div>
                    <?endif;?>

                    <?if($arResult["TIME_ZONE_ENABLED"] == true):?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="AUTO_TIME_ZONE"><?=GetMessage("main_profile_time_zones_auto")?></label>
                            <div class="col-md-9">
                                <select name="AUTO_TIME_ZONE" id="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')" class="form-control">
                                    <option value=""><?=GetMessage("main_profile_time_zones_auto_def")?></option>
                                    <option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
                                    <option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="TIME_ZONE"><?=GetMessage("main_profile_time_zones_zones")?></label>
                            <div class="col-md-9">
                                <select name="TIME_ZONE" id="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?> class="form-control">
                                    <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
                                        <option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
                                    <?endforeach?>
                                </select>
                            </div>
                        </div>
                    <?endif;?>
                </div>

                <div class="tab-pane" id="tab-personal">
                    <?=$arResult["BX_SESSION_CHECK"]?>
                    <input type="hidden" name="lang" value="<?=LANG?>" />
                    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_PROFESSION"><?=GetMessage('USER_PROFESSION')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_PROFESSION" id="PERSONAL_PROFESSION" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PROFESSION"]?>" placeholder="<?=GetMessage('USER_PROFESSION')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_WWW"><?=GetMessage('USER_WWW')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_WWW" id="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" placeholder="<?=GetMessage('USER_WWW')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_ICQ"><?=GetMessage('USER_ICQ')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_ICQ" id="PERSONAL_ICQ" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ICQ"]?>" placeholder="<?=GetMessage('USER_ICQ')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_GENDER"><?=GetMessage('USER_GENDER')?></label>
                        <div class="col-md-9">
                            <select name="PERSONAL_GENDER" id="PERSONAL_GENDER" class="form-control">
                                <option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
                                <option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
                                <option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_BIRTHDAY"><?=GetMessage("USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>)</label>
                        <div class="col-md-9">
                            <?$APPLICATION->IncludeComponent(
                                'bitrix:main.calendar',
                                '',
                                array(
                                    'SHOW_INPUT' => 'Y',
                                    'FORM_NAME' => 'profileform',
                                    'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
                                    'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
                                    'SHOW_TIME' => 'N',
                                    '~INPUT_ADDITIONAL_ATTR' => "placeholder='".GetMessage("USER_BIRTHDAY_DT")."'"
                                ),
                                null,
                                array('HIDE_ICONS' => 'Y')
                            );?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_PHOTO_INPUT"><?=GetMessage("USER_PHOTO")?></label>
                        <div class="col-md-9">
                            <?=$arResult["arUser"]["PERSONAL_PHOTO_CONTROL"]?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_PHONE"><?=GetMessage('USER_PHONE')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_PHONE" id="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" placeholder="<?=GetMessage('USER_PHONE')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_FAX"><?=GetMessage('USER_FAX')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_FAX" id="PERSONAL_FAX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_FAX"]?>" placeholder="<?=GetMessage('USER_FAX')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_MOBILE"><?=GetMessage('USER_MOBILE')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_MOBILE" id="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" placeholder="<?=GetMessage('USER_MOBILE')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_PAGER"><?=GetMessage('USER_PAGER')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_PAGER" id="PERSONAL_PAGER" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PAGER"]?>" placeholder="<?=GetMessage('USER_PAGER')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_COUNTRY"><?=GetMessage('USER_COUNTRY')?></label>
                        <div class="col-md-9">
                            <?=str_replace("class='typeselect'", "class='typeselect form-control'", $arResult["COUNTRY_SELECT"])?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_STATE"><?=GetMessage('USER_STATE')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_STATE" id="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" placeholder="<?=GetMessage('USER_STATE')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_CITY"><?=GetMessage('USER_CITY')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_CITY" id="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" placeholder="<?=GetMessage('USER_CITY')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_ZIP"><?=GetMessage('USER_ZIP')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_ZIP" id="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" placeholder="<?=GetMessage('USER_ZIP')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_STREET"><?=GetMessage("USER_STREET")?></label>
                        <div class="col-md-9">
                            <textarea cols="30" rows="5" name="PERSONAL_STREET" id="PERSONAL_STREET" class="form-control"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_MAILBOX"><?=GetMessage('USER_MAILBOX')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="PERSONAL_MAILBOX" id="PERSONAL_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MAILBOX"]?>" placeholder="<?=GetMessage('USER_MAILBOX')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="PERSONAL_NOTES"><?=GetMessage("USER_NOTES")?></label>
                        <div class="col-md-9">
                            <textarea cols="30" rows="5" name="PERSONAL_NOTES" id="PERSONAL_NOTES" class="form-control"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab-work">
                    <?=$arResult["BX_SESSION_CHECK"]?>
                    <input type="hidden" name="lang" value="<?=LANG?>" />
                    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_COMPANY"><?=GetMessage('USER_COMPANY')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_COMPANY" id="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" placeholder="<?=GetMessage('USER_COMPANY')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_WWW"><?=GetMessage('USER_WWW')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_WWW" id="WORK_WWW" maxlength="255" value="<?=$arResult["arUser"]["WORK_WWW"]?>" placeholder="<?=GetMessage('USER_WWW')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_DEPARTMENT"><?=GetMessage('USER_DEPARTMENT')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_DEPARTMENT" id="WORK_DEPARTMENT" maxlength="255" value="<?=$arResult["arUser"]["WORK_DEPARTMENT"]?>" placeholder="<?=GetMessage('USER_DEPARTMENT')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_POSITION"><?=GetMessage('USER_POSITION')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_POSITION" id="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" placeholder="<?=GetMessage('USER_POSITION')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_PROFILE"><?=GetMessage("USER_WORK_PROFILE")?></label>
                        <div class="col-md-9">
                            <textarea cols="30" rows="5" name="WORK_PROFILE" id="WORK_PROFILE" class="form-control"><?=$arResult["arUser"]["WORK_PROFILE"]?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_LOGO_INPUT"><?=GetMessage("USER_LOGO")?></label>
                        <div class="col-md-9">
                            <?=$arResult["arUser"]["WORK_LOGO_CONTROL"]?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_PHONE"><?=GetMessage('USER_PHONE')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_PHONE" id="WORK_PHONE" maxlength="255" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" placeholder="<?=GetMessage('USER_PHONE')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_FAX"><?=GetMessage('USER_FAX')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_FAX" id="WORK_FAX" maxlength="255" value="<?=$arResult["arUser"]["WORK_FAX"]?>" placeholder="<?=GetMessage('USER_FAX')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_PAGER"><?=GetMessage('USER_PAGER')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_PAGER" id="WORK_PAGER" maxlength="255" value="<?=$arResult["arUser"]["WORK_PAGER"]?>" placeholder="<?=GetMessage('USER_PAGER')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_COUNTRY"><?=GetMessage('USER_COUNTRY')?></label>
                        <div class="col-md-9">
                            <?=str_replace("class='typeselect'", "class='typeselect form-control'", $arResult["COUNTRY_SELECT_WORK"])?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_STATE"><?=GetMessage('USER_STATE')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_STATE" id="WORK_STATE" maxlength="255" value="<?=$arResult["arUser"]["WORK_STATE"]?>" placeholder="<?=GetMessage('USER_STATE')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_CITY"><?=GetMessage('USER_CITY')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_CITY" id="WORK_CITY" maxlength="255" value="<?=$arResult["arUser"]["WORK_CITY"]?>" placeholder="<?=GetMessage('USER_CITY')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_ZIP"><?=GetMessage('USER_ZIP')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_ZIP" id="WORK_ZIP" maxlength="255" value="<?=$arResult["arUser"]["WORK_ZIP"]?>" placeholder="<?=GetMessage('USER_ZIP')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_STREET"><?=GetMessage("USER_STREET")?></label>
                        <div class="col-md-9">
                            <textarea cols="30" rows="5" name="WORK_STREET" id="WORK_STREET" class="form-control"><?=$arResult["arUser"]["WORK_STREET"]?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_MAILBOX"><?=GetMessage('USER_MAILBOX')?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="WORK_MAILBOX" id="WORK_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["WORK_MAILBOX"]?>" placeholder="<?=GetMessage('USER_MAILBOX')?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="WORK_NOTES"><?=GetMessage("USER_NOTES")?></label>
                        <div class="col-md-9">
                            <textarea cols="30" rows="5" name="WORK_NOTES" id="WORK_NOTES" class="form-control"><?=$arResult["arUser"]["WORK_NOTES"]?></textarea>
                        </div>
                    </div>
                </div>

                <?if($arResult["INCLUDE_FORUM"] == "Y"):?>
                    <div class="tab-pane" id="tab-forum">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="checkbox">
                                    <input type="checkbox" name="forum_SHOW_NAME" value="Y"
                                        <?if($arResult["arForumUser"]["SHOW_NAME"]=="Y"):?> checked="checked"<?endif;?>
                                    /> <?=GetMessage("forum_SHOW_NAME")?>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="forum_DESCRIPTION"><?=GetMessage('forum_DESCRIPTION')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="forum_DESCRIPTION" id="forum_DESCRIPTION" maxlength="255" value="<?=$arResult["arForumUser"]["DESCRIPTION"]?>" placeholder="<?=GetMessage('forum_DESCRIPTION')?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="forum_INTERESTS"><?=GetMessage('forum_INTERESTS')?></label>
                            <div class="col-md-9">
                                <textarea cols="30" rows="5" name="forum_INTERESTS" id="forum_INTERESTS" class="form-control"><?=$arResult["arForumUser"]["INTERESTS"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="forum_SIGNATURE"><?=GetMessage("forum_SIGNATURE")?></label>
                            <div class="col-md-9">
                                <textarea cols="30" rows="5" name="forum_SIGNATURE" id="forum_SIGNATURE" class="form-control"><?=$arResult["arForumUser"]["SIGNATURE"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="AVATAR_INPUT"><?=GetMessage("forum_AVATAR")?></label>
                            <div class="col-md-9">
                                <?=$arResult["arForumUser"]["AVATAR_CONTROL"]?>
                            </div>
                        </div>
                    </div>
                <?endif?>

                <?if ($arResult["INCLUDE_BLOG"] == "Y"):?>
                    <div class="tab-pane" id="tab-blog">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                        <div class="form-group">
                            <label class="control-label col-md-3" for="blog_ALIAS"><?=GetMessage('blog_ALIAS')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="blog_ALIAS" id="blog_ALIAS" maxlength="255" value="<?=$arResult["arBlogUser"]["ALIAS"]?>" placeholder="<?=GetMessage('blog_ALIAS')?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="blog_DESCRIPTION"><?=GetMessage('blog_DESCRIPTION')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="blog_DESCRIPTION" id="blog_DESCRIPTION" maxlength="255" value="<?=$arResult["arBlogUser"]["DESCRIPTION"]?>" placeholder="<?=GetMessage('blog_DESCRIPTION')?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="blog_INTERESTS"><?=GetMessage('blog_INTERESTS')?></label>
                            <div class="col-md-9">
                                <textarea cols="30" rows="5" name="blog_INTERESTS" id="blog_INTERESTS" class="form-control"><?echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="AVATAR_INPUT"><?=GetMessage("blog_AVATAR")?></label>
                            <div class="col-md-9">
                                <?=$arResult["arBlogUser"]["AVATAR_CONTROL"]?>
                            </div>
                        </div>
                    </div>
                <?endif?>


                <?if ($arResult["INCLUDE_LEARNING"] == "Y"):?>
                    <div class="tab-pane" id="tab-learning">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="checkbox">
                                    <input type="checkbox" name="student_PUBLIC_PROFILE" value="Y"
                                        <?if($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y"):?> checked="checked"<?endif;?>
                                    > <?=GetMessage("learning_PUBLIC_PROFILE");?>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="learningNotes"><?=GetMessage("learning_RESUME");?></label>
                            <div class="col-md-9">
                                <textarea id="learningNotes" cols="30" rows="5" name="student_RESUME" class="form-control"><?=$arResult["arStudent"]["RESUME"]; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?endif;?>

                <?if($arResult["IS_ADMIN"]):?>
                    <div class="tab-pane" id="tab-notes">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                        <div class="form-group">
                            <label class="control-label col-md-3" for="adminNotes"><?=GetMessage("USER_ADMIN_NOTES")?></label>
                            <div class="col-md-9">
                                <textarea id="adminNotes" cols="30" rows="5" name="ADMIN_NOTES" class="form-control"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea>
                            </div>
                        </div>
                    </div>
                <?endif;?>

                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                    <div class="tab-pane" id="tab-properties">
                        <?=$arResult["BX_SESSION_CHECK"]?>
                        <input type="hidden" name="lang" value="<?=LANG?>" />
                        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                        <?// ********************* User properties ***************************************************?>
                        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
                            $APPLICATION->IncludeComponent(
                                "bitrix:system.field.edit",
                                $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"),
                                null, array("HIDE_ICONS"=>"Y")
                            );
                        endforeach;?>
                        <?// ********************* User properties ***************************************************?>
                    </div>
                <?endif;?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary pull-right" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>"><?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?></button>
            </div>
        </div>

    </form>

<?if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}?>
</div>