<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<?
if(count($arResult["ERROR_MESSAGE"]) > 0){
    echo ShowError(implode("\n", $arResult["ERROR_MESSAGE"]));
}

if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	echo ShowMessage(Array("TYPE"=>"OK", "MESSAGE"=>$arResult["OK_MESSAGE"]));
}

?>

<form action="<?=$APPLICATION->GetCurPage()?>" method="POST" class="form-horizontal">
    <?=bitrix_sessid_post()?>

    <div class="form-group">
        <label class="control-label col-md-3 <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" for="inputName">
            <?=GetMessage("MFT_NAME")?>
        </label>
        <div class="col-md-9">
            <input type="text" id="inputName" class="form-control" placeholder="<?=GetMessage("MFT_NAME")?>" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" for="inputEmail">
            <?=GetMessage("MFT_EMAIL")?>
        </label>
        <div class="col-md-9">
            <input type="text" id="inputEmail" class="form-control" placeholder="<?=GetMessage("MFT_EMAIL")?>" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>required<?endif?>" for="inputMessage">
            <?=GetMessage("MFT_MESSAGE")?>
        </label>
        <div class="col-md-9">
            <textarea name="MESSAGE"  id="inputMessage" class="form-control" placeholder="<?=GetMessage("MFT_MESSAGE")?>"  rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
        </div>
    </div>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="form-group">
            <label class="control-label col-md-3 required" for="inputCaptcha">
                <?=GetMessage("MFT_CAPTCHA_CODE")?>
            </label>
            <div class="col-md-9">
                <p><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA"></p>
                <input type="text" id="inputCaptcha" class="form-control" placeholder="<?=GetMessage("MFT_CAPTCHA_CODE")?>" name="captcha_word" size="30" maxlength="50" value="">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            </div>
        </div>

        <div class="mf-captcha">
        </div>
	<?endif;?>

	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><?=GetMessage("MFT_SUBMIT")?></button>
        </div>
    </div>
</form>