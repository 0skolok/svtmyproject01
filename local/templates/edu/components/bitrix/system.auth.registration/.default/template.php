<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx-auth-reg">
    <?=ShowMessage($arParams["~AUTH_RESULT"]);?>
    <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
        <?=ShowNote(GetMessage("AUTH_EMAIL_SENT"), "success");?>
    <?else:?>
        <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y") {
            echo ShowNote(GetMessage("AUTH_EMAIL_WILL_BE_SENT"));
        }?>
        <!--noindex-->
            <form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" class="form-horizontal">
                <?if (strlen($arResult["BACKURL"]) > 0):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif;?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="REGISTRATION" />

                <div class="form-group">
                    <label class="control-label col-md-3 required" for="inputLogin"><?=GetMessage("AUTH_LOGIN_MIN")?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" id="inputLogin" placeholder="<?=GetMessage("AUTH_LOGIN_MIN")?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 required" for="inputEmail"><?=GetMessage("AUTH_EMAIL")?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" id="inputEmail" placeholder="<?=GetMessage("AUTH_EMAIL")?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 required" for="inputPassword"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
                    <div class="col-md-9">
                        <?if($arResult["SECURE_AUTH"]):?>
                            <div class="input-group">
                                <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" id="inputPassword" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>"></i></span>
                            </div>
                        <?else:?>
                            <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" id="inputPassword" placeholder="<?=GetMessage("AUTH_PASSWORD_REQ")?>">
                        <?endif;?>
                        <span class="help-block"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 required" for="inputConfirm"><?=GetMessage("AUTH_CONFIRM")?></label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" id="inputConfirm" placeholder="<?=GetMessage("AUTH_CONFIRM")?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="inputLastName"><?=GetMessage("AUTH_LAST_NAME")?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" id="inputLastName" placeholder="<?=GetMessage("AUTH_LAST_NAME")?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="inputName"><?=GetMessage("AUTH_NAME")?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" id="inputName" placeholder="<?=GetMessage("AUTH_NAME")?>">
                    </div>
                </div>

                <?// ********************* User properties ***************************************************?>
                <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                    <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:system.field.edit",
                            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                            array("bVarsFromForm" => $arResult["bVarsFromForm"],
                                "arUserField" => $arUserField,
                                "form_name" => "bform"),
                            null, array("HIDE_ICONS"=>"Y")
                        );?>
                    <?endforeach;?>
                <?endif;?>

                <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
                    <div class="form-group">
                        <label class="control-label col-md-3 required" for="inputCaptcha"><?echo GetMessage("CAPTCHA_REGF_PROMT")?></label>
                        <div class="col-md-9">
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                            <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                            <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" id="inputCaptcha" placeholder="<?echo GetMessage("CAPTCHA_REGF_PROMT")?>">
                        </div>
                    </div>
                <?endif?>

                <div class="form-group">
                    <div class="control-label col-md-3">
                        <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>
                    </div>
                    <div class="col-md-9">
                        <button type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" class="btn btn-primary pull-right"><?=GetMessage("AUTH_REGISTER")?></button>
                    </div>
                </div>
            </form>
        <!--/noindex-->
        <script type="text/javascript">document.bform.USER_NAME.focus();</script>
    <?endif?>
</div>