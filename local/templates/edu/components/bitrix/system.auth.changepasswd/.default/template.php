<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bx-system-auth-changepasswd">

<?echo ShowMessage($arParams["~AUTH_RESULT"], "info");?>

<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform" target="_top" class="form-horizontal">
	<?if (strlen($arResult["BACKURL"]) > 0):?>
	    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif;?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">

    <div class="form-group">
        <label class="control-label col-md-3 required" for="inputLogin"><?=GetMessage("AUTH_LOGIN")?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="inputLogin" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 required" for="inputCheckword"><?=GetMessage("AUTH_CHECKWORD")?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" id="inputCheckword" placeholder="<?=GetMessage("AUTH_CHECKWORD")?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 required" for="inputPassword"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></label>
        <div class="col-md-9">
            <?if($arResult["SECURE_AUTH"]):?>
                <div class="input-group">
                    <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" id="inputPassword" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock fa fa-lock" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>"></i></span>
                </div>
            <?else:?>
                <input type="password" class="form-control" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" id="inputPassword" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>">
            <?endif;?>
            <span class="help-block"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></span>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 required" for="inputPasswordConfirm"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></label>
        <div class="col-md-9">
            <input type="password" class="form-control" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" id="inputPasswordConfirm" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3"><a href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a></label>
        <div class="col-md-9">
            <button type="submit" name="change_pwd" class="btn btn-primary pull-right"><?=GetMessage("AUTH_CHANGE")?></button>
        </div>
    </div>
</form>

</div>
