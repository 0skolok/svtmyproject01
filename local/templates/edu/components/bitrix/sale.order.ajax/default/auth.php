<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-auth">

    <div class="row">
        <div class="col-md-12">
            <div class="super-class">
                <div class="row">
                    <div class="<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>col-sm-6 col-xs-12<?else:?>col-sm-12 col-xs-12<?endif;?>">
                        <?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
                            <h3><?=GetMessage("STOF_2REG")?></h3>
                        <?endif;?>
                        <form class="form-horizontal" role="form" method="post" action="" name="order_auth_form">
                            <?=bitrix_sessid_post()?>
                            <?foreach ($arResult["POST"] as $key => $value):?>
                                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                            <?endforeach;?>

                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label required"><?=GetMessage("STOF_LOGIN")?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="USER_LOGIN" id="login" placeholder="<?=GetMessage("STOF_LOGIN")?>" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label required"><?=GetMessage("STOF_PASSWORD")?></label>
                                <div class="col-sm-9">
                                    <input type="password" name="USER_PASSWORD" class="form-control" id="password" placeholder="<?=GetMessage("STOF_PASSWORD")?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input class="btn btn-primary pull-right" type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
                                    <input type="hidden" name="do_authorize" value="Y">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <a href="<?=$arParams["PATH_TO_AUTH"]?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>"><?echo GetMessage("STOF_FORGET_PASSWORD")?></a>
                                </div>
                            </div>
                            </form>
                    </div>
                    <?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
                        <div class="col-sm-6 col-xs-12">
                            <script>
                                function ChangeGenerate(val) {
                                    if(val) {
                                        document.getElementById("sof_choose_login").style.display='none';
                                    } else {
                                        document.getElementById("sof_choose_login").style.display='block';
                                        document.getElementById("NEW_GENERATE_N").checked = true;
                                    }
                                    try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
                                }
                            </script>

                            <h3><?=GetMessage("STOF_2NEW")?></h3>
                            <?if($arResult["AUTH"]["new_user_registration_email_confirmation"] == "Y"):?>
                                <?=ShowNote(GetMessage("STOF_EMAIL_NOTE"))?>
                            <?endif;?>
                            <form method="post" action="" name="order_reg_form" class="form-horizontal" role="form" onsubmit="document.getElementById('login_2').value = document.getElementById('E-Mail').value;">
                                <?=bitrix_sessid_post()?>
                                <?foreach ($arResult["POST"] as $key => $value):?>
                                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                                <?endforeach;?>

                                <div class="form-group">
                                    <label for="E-Mail" class="col-lg-3 col-md-4 control-label required">E-Mail</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="NEW_EMAIL" class="form-control" id="E-Mail" placeholder="E-Mail" value="<?=$arResult["AUTH"]["NEW_EMAIL"]?>">
                                        <script>
                                            var email = document.getElementById('E-Mail');

                                            email.oncut = email.onpaste = email.onkeyup = email.oninput = function() {
                                                document.getElementById('login_2').value = document.getElementById('E-Mail').value;
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-lg-3 col-md-4 control-label required"><?=GetMessage("STOF_NAME")?></label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="NEW_NAME" class="form-control" id="name" value="<?=$arResult["AUTH"]["NEW_NAME"]?>" placeholder="<?=GetMessage("STOF_NAME")?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-lg-3 col-md-4 control-label required"><?=GetMessage("STOF_LASTNAME")?></label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" name="NEW_LAST_NAME" class="form-control" id="last_name" placeholder="<?=GetMessage("STOF_LASTNAME")?>" value="<?=$arResult["AUTH"]["NEW_LAST_NAME"]?>">
                                    </div>
                                </div>
                                <?if($arResult["AUTH"]["captcha_registration"] == "Y"): //CAPTCHA ?>
                                    <div class="form-group">
                                        <label class="control-label required col-lg-3 col-md-4" for="inputCaptcha"><?=GetMessage("CAPTCHA_REGF_TITLE")?></label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="hidden" name="captcha_sid" value="<?=$arResult["AUTH"]["capCode"]?>" />
                                            <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["AUTH"]["capCode"]?>" width="180" height="40" alt="CAPTCHA" /></p>
                                            <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" id="inputCaptcha" placeholder="<?=GetMessage("CAPTCHA_REGF_PROMT")?>">
                                        </div>
                                    </div>
                                <?endif;?>
                                <div class="form-group">
                                    <div class="col-lg-9 col-md-8 col-lg-offset-3 col-md-offset-4">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" id="NEW_GENERATE_N" name="NEW_GENERATE" value="N" OnClick="ChangeGenerate(false)"<?if ($_POST["NEW_GENERATE"] == "N") echo " checked";?>>
                                                <?=GetMessage("STOF_MY_PASSWORD")?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" id="NEW_GENERATE_Y" name="NEW_GENERATE" value="Y" OnClick="ChangeGenerate(true)"<?if ($POST["NEW_GENERATE"] != "N") echo " checked";?>>
                                                <?=GetMessage("STOF_SYS_PASSWORD")?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="sof_choose_login">
                                    <div class="form-group hidden">
                                        <label for="login_2" class="col-lg-3 col-md-4 control-label required"><?=GetMessage("STOF_LOGIN")?></label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" class="form-control" name="NEW_LOGIN" id="login_2" placeholder="<?=GetMessage("STOF_LOGIN")?>" value="<?=$arResult["AUTH"]["NEW_EMAIL"]?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_2" class="col-lg-3 col-md-4 control-label required"><?=GetMessage("STOF_PASSWORD")?></label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="password" name="NEW_PASSWORD" class="form-control" id="password_2" placeholder="<?=GetMessage("STOF_PASSWORD")?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_3" class="col-lg-3 col-md-4 control-label required"><?=GetMessage("STOF_RE_PASSWORD")?></label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="password" name="NEW_PASSWORD_CONFIRM" class="form-control" id="password_3" placeholder="<?=GetMessage("STOF_RE_PASSWORD")?>">
                                        </div>
                                    </div>
                                </div>

                                <script language="JavaScript">
                                    <!--
                                    ChangeGenerate(<?= (($_POST["NEW_GENERATE"] != "N") ? "true" : "false") ?>);
                                    //-->
                                </script>
                                <div class="form-group">
                                    <div class="col-lg-9 col-md-8 col-lg-offset-3 col-md-offset-4">
                                        <?if($arResult["AUTH"]["new_user_registration_email_confirmation"] == "Y"):?>
                                            <input class="btn btn-primary pull-right" type="submit" value="<?echo GetMessage("STOF_NEXT_REGISTER")?>">
                                        <?else:?>
                                            <input class="btn btn-primary pull-right" type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
                                        <?endif;?>
                                        <input type="hidden" name="do_register" value="Y">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?=ShowNote(GetMessage("STOF_PRIVATE_NOTES"), 'info')?>
        </div>
    </div>
</div>
