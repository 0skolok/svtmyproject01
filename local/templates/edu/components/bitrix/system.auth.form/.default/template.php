<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bx-system-auth-form">

<?if($arResult["FORM_TYPE"] == "login"):?>
    <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) echo ShowMessage($arResult['ERROR_MESSAGE']);?>

    <div class="row">
        <div class="col-md-<?if($arResult["AUTH_SERVICES"]):?>6<?else:?>12<?endif;?>">
            <form class="form-horizontal" name="system_auth_form<?=$arResult["RND"]?>" target="_top" method="post" action="<?=$arResult["AUTH_URL"]?>">
                <fieldset>
                    <?if($arResult["AUTH_SERVICES"]):?>
                        <legend><?=GetMessage("AUTH_LOGIN_PASSWORD")?></legend>
                    <?endif;?>
                    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                        <p><?=GetMessage("AUTH_LOGIN_AFTER_REGISTER")?></p>
                    <?else:?>
                        <p><?=GetMessage("AUTH_LOGIN_AFTER_GETPASS")?></p>
                    <?endif;?>

                    <?if($arResult["BACKURL"] <> ''):?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <?endif?>
                    <?foreach ($arResult["POST"] as $key => $value):?>
                        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                    <?endforeach?>
                    <input type="hidden" name="AUTH_FORM" value="Y" />
                    <input type="hidden" name="TYPE" value="AUTH" />

                    <div class="form-group">
                        <label class="control-label col-md-3" for="inputLogin"><?=GetMessage("AUTH_LOGIN")?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" id="inputLogin" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="inputPassword"><?=GetMessage("AUTH_PASSWORD")?></label>
                        <div class="col-md-9">
                            <?if($arResult["SECURE_AUTH"]):?>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" id="inputPassword" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>"></i></span>
                                </div>
                            <?else:?>
                                <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" id="inputPassword" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
                            <?endif;?>
                        </div>
                    </div>
                    <?if ($arResult["CAPTCHA_CODE"]):?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="inputCaptcha"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
                            <div class="col-md-9">
                                <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                                <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                                <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" id="inputCaptcha" placeholder="<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>">
                            </div>
                        </div>
                    <?endif?>
                    <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <label class="checkbox">
                                    <input type="checkbox" name="USER_REMEMBER" value="Y"> <?echo GetMessage("AUTH_REMEMBER_ME")?>
                                </label>
                            </div>
                        </div>
                    <?endif?>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="btn btn-primary pull-right"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 text-right">
                            <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                                <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
                            <?endif?>
                        </div>
                        <div class="col-md-9">
                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <?if($arResult["AUTH_SERVICES"]):?>
            <div class="col-md-6">
                <?
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                    array(
                        "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                        "SUFFIX"=>"form",
                    ),
                    $component,
                    array("HIDE_ICONS"=>"Y")
                );
                ?>
            </div>
        <?endif?>
    </div>

    <?if($arResult["AUTH_SERVICES"]):?>
        <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
            array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "AUTH_URL"=>$arResult["AUTH_URL"],
                "POST"=>$arResult["POST"],
                "POPUP"=>"Y",
                "SUFFIX"=>"form",
            ),
            $component,
            array("HIDE_ICONS"=>"Y")
        );?>
    <?endif?>

<?else://if($arResult["FORM_TYPE"] != "login")
    echo ShowNote(GetMessage("AUTH_LOGIN_SUCCESS"), "info");
endif?>

</div>


