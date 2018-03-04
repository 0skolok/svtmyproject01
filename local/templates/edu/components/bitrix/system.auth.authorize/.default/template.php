<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bx-system-auth-authorize">

<?echo ShowMessage($arParams["~AUTH_RESULT"]);
  echo ShowMessage($arResult['ERROR_MESSAGE']);?>

<div class="row">
    <div class="col-md-<?if($arResult["AUTH_SERVICES"]):?>5<?else:?>12<?endif;?>">
        <form class="form-horizontal" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <fieldset>
                <?if($arResult["AUTH_SERVICES"]):?>
                    <legend><?=GetMessage("AUTH_TITLE")?></legend>
                <?endif;?>

                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <?if (strlen($arResult["BACKURL"]) > 0):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>

                <div class="form-group">
                    <label class="control-label col-md-3" for="inputLogin"><?=GetMessage("AUTH_LOGIN")?></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" id="inputLogin" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
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
                        <button type="submit" name="Login" class="btn btn-primary pull-right"><?=GetMessage("AUTH_AUTHORIZE")?></button>
                    </div>
                </div>
                <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                    <div class="form-group">
                        <div class="col-md-<?if($arResult["AUTH_SERVICES"]):?>6<?else:?>3<?endif;?> text-right">
                            <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
                                <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
                            <?endif?>
                        </div>
                        <div class="col-md-<?if($arResult["AUTH_SERVICES"]):?>6<?else:?>9<?endif;?>">
                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                        </div>
                    </div>
                <?endif?>
            </fieldset>
        </form>

        <script type="text/javascript">
            <?if (strlen($arResult["LAST_LOGIN"])>0):?>
                try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
            <?else:?>
                try{document.form_auth.USER_LOGIN.focus();}catch(e){}
            <?endif?>
        </script>
    </div>
    <?if($arResult["AUTH_SERVICES"]):?>
        <div class="col-md-5 col-md-offset-2">
            <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                array(
                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                    "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                    "AUTH_URL" => $arResult["AUTH_URL"],
                    "POST" => $arResult["POST"],
                    "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                    "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                    "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );?>
        </div>
    <?endif?>
</div>

</div>
