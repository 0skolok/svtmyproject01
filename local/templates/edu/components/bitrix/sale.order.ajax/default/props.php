<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");?>

<div class="sale-order-ajax-props">

	<?if($arParams["ALLOW_NEW_PROFILE"] == "Y" || count($arResult["ORDER_PROP"]["USER_PROFILES"])>1):?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_PROP_INFO")?></h4>
			</div>
			<div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="ID_PROFILE_ID" class="col-md-3 control-label"><?=GetMessage("SOA_TEMPL_PROP_CHOOSE")?></label>
						<div class="col-md-9">
							<? if ($arParams["ALLOW_NEW_PROFILE"] == "Y"): ?>
								<div class="radio">
									<label>
										<?$newProfile = true;

										if (count($arResult["ORDER_PROP"]["USER_PROFILES"])>1)
											foreach ($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles){
												if ($arUserProfiles["CHECKED"]=="Y") {
													$newProfile = false;
												}
											}?>
										<input type="radio" name="PROFILE_ID" value="0" onChange="SetContact(this.value)" <?if ($newProfile) echo "checked";?>>
										<?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?>
									</label>
								</div>
							<? endif; ?>

							<?if (count($arResult["ORDER_PROP"]["USER_PROFILES"])>1)
								foreach ($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles):?>
									<div class="radio">
										<label>
											<input type="radio" name="PROFILE_ID" value="<?=$arUserProfiles["ID"] ?>" onChange="SetContact(this.value)" <?if ($arUserProfiles["CHECKED"]=="Y") echo "checked";?>>
											<?=$arUserProfiles["NAME"]?>
										</label>
									</div>
								<?endforeach?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?elseif (count($arResult["ORDER_PROP"]["USER_PROFILES"]) == 1):
		//profiles not allowed but 1 profile exist from previous order
		foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles)
		{?>
			<span class="hidden">
				<input type="hidden" name="PROFILE_ID" id="ID_PROFILE_ID" value="<?=$arUserProfiles["ID"]?>" />
			</span>
		<?}
	endif?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_BUYER_INFO")?></h4>
		</div>
		<div class="panel-body" id="buyer-info-body">
			<div class="form-horizontal">
				<?
				PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
				PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
				?>
			</div>
		</div>
	</div>

	<div class="hidden">
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.ajax.locations",
			$arParams["TEMPLATE_LOCATION"],
			array(
				"AJAX_CALL" => "N",
				"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
				"REGION_INPUT_NAME" => "REGION_tmp",
				"CITY_INPUT_NAME" => "tmp",
				"CITY_OUT_LOCATION" => "Y",
				"LOCATION_VALUE" => "",
				"ONCITYCHANGE" => "submitForm()",
			),
			null,
			array('HIDE_ICONS' => 'Y')
		);?>
	</div>

</div>