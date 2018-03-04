<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!function_exists("PrintPropsForm"))
{
	function PrintPropsForm($arSource = Array(), $locationTemplate = "default")
	{
		if ($arSource):
			foreach ($arSource as $arProperties):
				$bRequired = $arProperties["REQUIED_FORMATED"]=="Y";?>
				<div class="form-group">
					<label for="<?=$arProperties["FIELD_NAME"]?>" class="col-md-3 control-label <?=$bRequired ? "required" : ""?>"><?=$arProperties["NAME"]?></label>
					<div class="col-md-9">

						<? if ($arProperties["TYPE"] == "CHECKBOX"): ?>

							<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
									<?=GetMessage('SOA_ORDER_PROP_YES')?>
									<?if (strlen($arProperties['DESCRIPTION']) > 0):?>
										<small>(<?=$arProperties['DESCRIPTION']?>)</small>
									<?endif;?>
								</label>
							</div>

						<?elseif($arProperties["TYPE"] == "RADIO"):

							$bIsFirst = TRUE;

							foreach ($arProperties["VARIANTS"] as $arVariants):
								$id = $arProperties["FIELD_NAME"] . "_" . $arVariants["VALUE"];
								if ($bIsFirst) {
									$id = $arProperties["FIELD_NAME"];
								}?>
								<div class="radio">
									<label>
										<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$id?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>>
										<?=$arVariants["NAME"]?>
										<?if (strlen($arVariants['DESCRIPTION']) > 0):?>
											<small>(<?=$arVariants['DESCRIPTION']?>)</small>
										<?endif;?>
									</label>
								</div>
								<?$bIsFirst = FALSE;
							endforeach;

						elseif($arProperties["TYPE"] == "TEXT"):?>

							<input type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form-control" placeholder="<?=$arProperties["NAME"]?>">

						<?elseif($arProperties["TYPE"] == "SELECT"):?>

							<select class="form-control" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
								<? foreach ($arProperties["VARIANTS"] as $arVariants):?>
									<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<? endforeach ?>
							</select>

						<? elseif($arProperties["TYPE"] == "MULTISELECT"): ?>

							<select class="form-control" multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
								<? foreach ($arProperties["VARIANTS"] as $arVariants):?>
									<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<? endforeach ?>
							</select>

						<? elseif($arProperties["TYPE"] == "TEXTAREA"): ?>

							<textarea class="form-control" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="<?=$arProperties["NAME"]?>"><?=$arProperties["VALUE"]?></textarea>

						<? elseif($arProperties["TYPE"] == "LOCATION"):

							$value = 0;
							if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0) {
								foreach ($arProperties["VARIANTS"] as $arVariant) {
									if ($arVariant["SELECTED"] == "Y") {
										$value = $arVariant["ID"];
										break;
									}
								}
							}

							$GLOBALS["APPLICATION"]->IncludeComponent(
								"bitrix:sale.ajax.locations",
								$locationTemplate,
								array(
									"AJAX_CALL" => "N",
									"COUNTRY_INPUT_NAME" => "COUNTRY",
									"REGION_INPUT_NAME" => "REGION",
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"LOCATION_VALUE" => $value,
									"ORDER_PROPS_ID" => $arProperties["ID"],
									"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
									"SIZE1" => $arProperties["SIZE1"],
								),
								null,
								array('HIDE_ICONS' => 'Y')
							);

						elseif ($arProperties["TYPE"] == "FILE") :
							$count = 1;
							if ($arProperties["MULTIPLE"] == "Y") {
								$count = intval($arProperties["SIZE1"]);
								$count = max($count, 2); //multiple should be 2 at least
							}

							if (strlen($arProperties['DESCRIPTION']) > 0):?>
								<span class="help-block"><small><?=$arProperties['DESCRIPTION']?></small></span>
							<?endif;

							for ($i = 0; $i < $count; $i++):?>
								<div <?if ($arProperties["MULTIPLE"] == "Y"):?>class="multiple-choose-file"<?endif;?>>
									<span class="btn btn-default">
										<span data-default="<?=GetMessage('CHOOSE_FILE')?>"><?=GetMessage('CHOOSE_FILE')?></span>
										<input type="file" class="choose-file"
										       value="<?=$arProperties["VALUE"]?>"
										       name="ORDER_PROP_<?=$arProperties["ID"]?>[<?=$i?>]"
										       id="ORDER_PROP_<?=$arProperties["ID"]?>[<?=$i?>]">
									</span>
								</div>
							<?endfor;

						endif;

						if ($arProperties["TYPE"] != "RADIO" && $arProperties["TYPE"] != "CHECKBOX" &&
							$arProperties["TYPE"] != "FILE" && strlen($arProperties["DESCRIPTION"]) > 0):?>
							<span class="help-block"><small><?echo $arProperties["DESCRIPTION"] ?></small></span>
						<?endif?>
					</div>
				</div>

			<?endforeach;

			return true;
		endif;

		return false;
	}
}
?>