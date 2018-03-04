<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="form-result-new">
	<? if ($arResult["isFormTitle"]): ?>
		<h2><?= $arResult["FORM_TITLE"] ?></h2>
	<? endif; ?>

	<? if ($arResult["isFormErrors"] == "Y"): ?>
		<?= $arResult["FORM_ERRORS_TEXT"]; ?>
	<? elseif ($arResult["isFormNote"] == "Y"): ?>
		<? ShowNote($arResult["FORM_NOTE"], 'success') ?>
	<? endif; ?>

	<div class="row">
		<div class="<?= $arResult['COLUMNS']['LEFT'] ?>">
			<?= $arResult["FORM_HEADER"] ?>

			<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
				if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
				{
					echo $arQuestion["HTML_CODE"];;
					continue;
				}
				?>

				<div class="form-group">
					<? if ($arQuestion["IS_HTML_CAPTION"] == 'N'): ?>
						<label class="control-label <?= $arResult['COLUMNS']['LABELS'] ?> <?= $arQuestion["REQUIRED"] ==
						'Y' ? ' required' : '' ?>" for="<?= $FIELD_SID ?>">
							<?= $arQuestion["CAPTION"] ?><?

							if ($arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y"): ?>
								<img src="<?= $arQuestion["IMAGE"]["URL"] ?>"
								     class="img-responsive" alt="<?= $arQuestion["CAPTION"] ?>"
								     width="<?= $arQuestion["IMAGE"]["WIDTH"] ?>"
								     height="<?= $arQuestion["IMAGE"]["HEIGHT"] ?>"/>
							<? endif; ?></label>
					<? else: ?>
						<div class="<?= $arResult['COLUMNS']['LABELS'] ?> text-right">
							<?= $arQuestion["CAPTION"] ?>

							<? if ($arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y"): ?>
								<img src="<?= $arQuestion["IMAGE"]["URL"] ?>"
								     class="img-responsive"
								     width="<?= $arQuestion["IMAGE"]["WIDTH"] ?>"
								     height="<?= $arQuestion["IMAGE"]["HEIGHT"] ?>"/>
							<? endif; ?>
						</div>
					<? endif; ?>

					<div class="<?= $arResult['COLUMNS']['CONTROLS'] ?>">
						<?= $arQuestion["HTML_CODE"] ?>
					</div>
				</div>
			<? endforeach; ?>


			<? if ($arResult["isUseCaptcha"] == "Y"): ?>
				<div class="form-group">
					<label class="control-label <?= $arResult['COLUMNS']['LABELS'] ?> required"
					       for="inputCaptcha"><?= GetMessage("FORM_CAPTCHA_TABLE_TITLE") ?></label>

					<div class="<?= $arResult['COLUMNS']['CONTROLS'] ?>">
						<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHACode"] ?>"/>

						<p><img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHACode"] ?>" width="180"
						        height="40" alt="CAPTCHA"/></p>
						<input class="form-control" type="text" name="captcha_word" maxlength="50" value=""
						       id="inputCaptcha"
						       placeholder="<? echo GetMessage("FORM_CAPTCHA_FIELD_TITLE") ?>">
					</div>
				</div>
			<? endif ?>

			<div class="form-group">
				<div class="<?= $arResult['COLUMNS']['LABELS'] ?>">&nbsp;</div>
				<div class="<?= $arResult['COLUMNS']['CONTROLS'] ?>">
					<? $buttonValue = htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>
					<button type="submit"
					        class="btn btn-primary pull-right" <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled" : ""); ?>
					        name="web_form_submit"
					        value="<?= $buttonValue ?>"><?= $buttonValue ?></button>
				</div>
			</div>

			<?= $arResult["FORM_FOOTER"] ?>
		</div>

		<div class="<?= $arResult['COLUMNS']['RIGHT'] ?>">
			<? if ($arResult["isFormImage"] == "Y"): ?>
				<img src="<?= $arResult["FORM_IMAGE"]["URL"] ?>"
				     class="img-responsive" alt="<?= $arResult["FORM_TITLE"] ?>"
				     width="<?= $arResult["FORM_IMAGE"]["WIDTH"] ?>"
				     height="<?= $arResult["FORM_IMAGE"]["HEIGHT"] ?>"/>
			<? endif; ?>

			<?= $arResult["FORM_DESCRIPTION"] ?>
		</div>
	</div>
</div>
