<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== TRUE) die() ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<? if (Csubscription::IsAuthorized($arResult["ID"])): ?>
				<?= GetMessage("SUBSCR_TITLE_EDIT") ?>
			<? else: ?>
				<?= GetMessage("SUBSCR_TITLE") ?>
			<?endif; ?>
		</h3>
	</div>
	<div class="panel-body">
		<form action="<?= $arResult["FORM_ACTION"] ?>" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<? if (!$arResult["ID"]): ?>
					<div class="help-block col-md-offset-3 col-md-9">
						<?= GetMessage("SUBSCR_SETTINGS_NOTE1") ?> <?= GetMessage("SUBSCR_SETTINGS_NOTE2") ?>
					</div>
				<? endif; ?>
				<label for="subscribe_email"
				       class="col-md-3 control-label required"><?= GetMessage("SUBSCR_EMAIL") ?></label>

				<div class="col-md-9">
					<input type="email" name="EMAIL" id="subscribe_email" class="form-control"
					       placeholder="<?= GetMessage("SUBSCR_EMAIL") ?>"
					       value="<?= urldecode($arResult["SUBSCRIPTION"]["EMAIL"]) != "" ? urldecode($arResult["SUBSCRIPTION"]["EMAIL"]) : urldecode($arResult["REQUEST"]["EMAIL"]) ?>"
					       maxlength="255">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label required"><?= GetMessage("SUBSCR_RUB") ?></label>
				<div class="col-md-9">
					<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue): ?>
						<div class="checkbox">
							<label>
								<input id="RUB_ID" type="checkbox" name="RUB_ID[]"
								       value="<?= $itemValue["ID"] ?>"<? if ($itemValue["CHECKED"]) echo " checked" ?>><?= $itemValue["NAME"] ?>
							</label>
						</div>
					<? endforeach; ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"><?= GetMessage("SUBSCR_FMT") ?></label>
				<div class="col-md-9">
					<div class="radio">
						<label>
							<input type="radio" name="FORMAT"
							       value="html"<? if ($arResult["SUBSCRIPTION"]["FORMAT"] == "html" || !isset($arResult["SUBSCRIPTION"]["FORMAT"])) echo " checked" ?>><?= GetMessage("SUBSCR_HTML") ?>
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="FORMAT"
							       value="text"<? if ($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked" ?>><?= GetMessage("SUBSCR_TEXT") ?>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					<button type="submit" class="btn btn-primary pull-right" name="Save"
					        value="<?= ($arResult["ID"] > 0 ? GetMessage("SUBSCR_UPD") : GetMessage("SUBSCR_ADD")) ?>"><?= ($arResult["ID"] > 0 ? GetMessage("SUBSCR_UPD") : GetMessage("SUBSCR_ADD")) ?></button>
					<button type="reset" class="btn btn-default pull-right" value="<?= GetMessage("SUBSCR_RESET") ?>"
					        name="reset"><?= GetMessage("SUBSCR_RESET") ?></button>
				</div>
			</div>
			<input type="hidden" name="PostAction" value="<? echo($arResult["ID"] > 0 ? "Update" : "Add") ?>">
			<input type="hidden" name="ID" value="<?= $arResult["SUBSCRIPTION"]["ID"] ?>">
			<? if ($_REQUEST["register"] == "YES"): ?>
				<input type="hidden" name="register" value="YES">
			<? endif ?>
			<? if ($_REQUEST["authorize"] == "YES"): ?>
				<input type="hidden" name="authorize" value="YES">
			<? endif ?>
			<?= bitrix_sessid_post() ?>
		</form>
	</div>
</div>