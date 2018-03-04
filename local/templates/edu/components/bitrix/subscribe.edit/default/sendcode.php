<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= GetMessage("SUBSCR_CONF_TITLE") ?></h3>
	</div>
	<div class="panel-body">
		<form action="<?= $arResult["FORM_ACTION"] ?>" method="post" class="form-horizontal" role="form">
			<?= bitrix_sessid_post(); ?>
			<input type="hidden" name="action" value="sendcode">

			<div class="help-block col-md-offset-3 col-md-9">
				<?= GetMessage("CT_BSE_SEND_NOTE") ?>
			</div>
			<div class="form-group">
				<label for="sf_EMAIL" class="col-md-3 control-label"><?= GetMessage("CT_BSE_EMAIL_LABEL") ?></label>

				<div class="col-md-9">
					<input type="text" name="sf_EMAIL" class="form-control" id="sf_EMAIL"
					       placeholder="<?= GetMessage("CT_BSE_EMAIL") ?>" value=""
					       onblur="if (this.value=='')this.value='<?= GetMessage("CT_BSE_EMAIL") ?>'"
					       onclick="if (this.value=='<?= GetMessage("CT_BSE_EMAIL") ?>')this.value=''">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn btn-primary pull-right"
					        name="confirm"><?= GetMessage("CT_BSE_BTN_SEND") ?></button>
				</div>
			</div>
		</form>
	</div>
</div>