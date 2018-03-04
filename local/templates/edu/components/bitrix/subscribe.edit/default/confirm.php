<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= GetMessage("SUBSCR_TITLE_CONFIRM") ?></h3>
	</div>
	<div class="panel-body">
		<form action="<?= $arResult["FORM_ACTION"] ?>" class="form-horizontal" method="get" role="form">
			<div class="form-group">
				<label for="CONFIRM_CODE"
				       class="col-md-3 control-label required"><?= GetMessage("SUBSCR_CONF_CODE") ?></label>

				<div class="col-md-9">
					<input type="text" class="form-control" id="CONFIRM_CODE" name="CONFIRM_CODE"
					       value="<?= $arResult["REQUEST"]["CONFIRM_CODE"]; ?>"
					       placeholder="<?= GetMessage("SUBSCR_CONF_CODE_PLC") ?>">
				</div>

				<div class="help-block col-md-offset-3 col-md-9">
					<?= GetMessage("SUBSCR_CONF_NOTE1") ?>
					<a title="<?= GetMessage("ADM_SEND_CODE") ?>"
					   href="<?= $arResult["FORM_ACTION"] ?>?ID=<?= $arResult["ID"] ?>&amp;action=sendcode&amp;<?= bitrix_sessid_get() ?>"><?= GetMessage("SUBSCR_CONF_NOTE2") ?></a>.
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" name="confirm"
					        class="btn btn-default pull-right"><?= GetMessage("SUBSCR_CONF_BUTTON") ?></button>
				</div>
			</div>
			<input type="hidden" name="ID" value="<?= $arResult["ID"]; ?>">
			<?= bitrix_sessid_post(); ?>
		</form>
	</div>
</div>