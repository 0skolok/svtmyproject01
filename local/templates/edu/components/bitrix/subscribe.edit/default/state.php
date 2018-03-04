<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== TRUE) die() ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= GetMessage("SUBSCR_TITLE_STATUS") ?></h3>
	</div>
	<div class="panel-body">
		<form action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="form-horizontal">
			<? if ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"): ?>
				<div class="form-group">
					<div class="help-block col-md-offset-3 col-md-9">
						<? if ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"): ?>
							<?= GetMessage("SUBSCR_STATUS_NOTE3") ?>
						<? else: ?>
							<?= GetMessage("SUBSCR_STATUS_NOTE5") ?>
						<?endif ?>
					</div>
					<div class="col-md-offset-3 col-md-9">
						<? if ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"): ?>
							<button type="submit"
							        class="btn btn-danger pull-right"><?= GetMessage("SUBSCR_UNSUBSCR") ?></button>
							<input type="hidden" name="action" value="unsubscribe">
						<? else: ?>
							<button type="submit"
							        class="btn btn-primary pull-right"><?= GetMessage("SUBSCR_ACTIVATE") ?></button>
							<input type="hidden" name="action" value="activate">
						<?endif ?>
					</div>
				</div>
			<? endif ?>
			<input type="hidden" name="ID" value="<?= $arResult["SUBSCRIPTION"]["ID"] ?>">
			<?= bitrix_sessid_post() ?>
		</form>
	</div>
</div>