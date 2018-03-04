<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(strlen($arResult["ERROR_MESSAGE"])<=0):?>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" role="form" class="form-horizontal">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
        <?$warn = str_replace("#ID#", $arResult["ACCOUNT_NUMBER"], GetMessage("SALE_CANCEL_ORDER"));
        echo ShowNote($warn);?>

		<input type="hidden" name="CANCEL" value="Y">



        <div class="form-group">
            <label for="REASON_CANCELED" class="col-md-3 control-label"><?=GetMessage("SALE_CANCEL_ORDER4")?></label>
            <div class="col-md-9">
                <textarea class="form-control" name="REASON_CANCELED" id="REASON_CANCELED" placeholder="<?=GetMessage("SALE_CANCEL_ORDER4") ?>"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3 col-sm-6 col-xs-6 text-right">
                <a class="btn btn-default" href="<?=$arResult["URL_TO_LIST"]?>"><?=GetMessage("SALE_RECORDS_LIST")?></a>
            </div>
            <div class="col-md-9 col-sm-6 col-xs-6">
                <button type="submit" name="action" class="btn btn-primary pull-right" value="<?=GetMessage("SALE_CANCEL_ORDER_BTN")?>"><?=GetMessage("SALE_CANCEL_ORDER_BTN")?></button>
            </div>
        </div>
    </form>
<?else:
	echo ShowError($arResult["ERROR_MESSAGE"]);
endif;?>