<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-paysystem">

	<?$accountOnly = ($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y") ? "Y" : "N";

	if ($arResult["PAY_FROM_ACCOUNT"]=="Y"):?>
		<input type="hidden" id="account_only" value="<?=$accountOnly?>" />

		<input type="hidden" name="PAY_CURRENT_ACCOUNT" value="N">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_PAY_ACCOUNT")?></h4>
			</div>
			<div class="panel-body">
				<div class="row paysystem-row">
					<div class="col-md-2 col-sm-3">
						<div class="radio-thumbnail">
							<label for="PAY_CURRENT_ACCOUNT">
								<input
									type="checkbox"
									name="PAY_CURRENT_ACCOUNT"
									id="PAY_CURRENT_ACCOUNT"
									value="Y" <?if($arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y") echo " checked=\"checked\"";?>
									onChange="submitForm()"
									class="hidden">
								<span class="item-thumbnail">
									<img src="<?=$templateFolder?>/images/logo-default-ps.gif" alt=""
										class="img-responsive"	/>
								</span>
							</label>
						</div>
					</div>
					<div class="col-md-10 col-sm-9">
						<label for="PAY_CURRENT_ACCOUNT"><?=GetMessage("SOA_TEMPL_PAY_ACCOUNT1")?> <?=$arResult["CURRENT_BUDGET_FORMATED"]?></label>
						<span class="help-block">
							<small>
								<? if ($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y"): ?>
									<?=GetMessage("SOA_TEMPL_PAY_ACCOUNT3")?>
								<? else: ?>
									<?=GetMessage("SOA_TEMPL_PAY_ACCOUNT2")?>
								<? endif; ?>
							</small>
						</span>
					</div>
				</div>
			</div>
		</div>
	<? endif;

	if ($arResult["PAY_SYSTEM"]): ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></h4>
			</div>
			<div class="panel-body payment">
				<div class="row">
					<?foreach($arResult["PAY_SYSTEM_SPLIT"]["COL"] as $arPaySystem):?>
						<div class="col-md-2 col-sm-3 paysystem-row">
							<div class="radio-thumbnail">
								<label>
									<input type="radio" id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
										   name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>"
										<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
										   onclick="submitForm();" style="display: none"/>

									<span class="item-thumbnail">
										<?if (count($arPaySystem["PSA_LOGOTIP"]) > 0):?>
											<img src="<?=$arPaySystem["PSA_LOGOTIP"]["SRC"]?>" title="<?=$arPaySystem["PSA_NAME"];?>" alt="<?=$arPaySystem["PSA_NAME"];?>" class="img-responsive"/>
										<?else:?>
											<img src="<?=$templateFolder?>/images/logo-default-ps.gif" title="<?=$arPaySystem["PSA_NAME"];?>" alt="<?=$arPaySystem["PSA_NAME"];?>" class="img-responsive"/>
										<?endif?>
									</span>
									<?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
										<div><?=$arPaySystem["PSA_NAME"]?></div>
									<?endif?>
									<span class="help-block">
										<small>
											<?if (intval($arPaySystem["PRICE"]) > 0)
												echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
											else
												echo $arPaySystem["DESCRIPTION"];
											?>
										</small>
									</span>
								</label>
							</div>
						</div>
					<?endforeach;?>
				</div>
				<?foreach($arResult["PAY_SYSTEM_SPLIT"]["ROW"] as $arPaySystem):?>
					<div class="row paysystem-row">
						<div class="col-md-2 col-sm-3">
							<div class="radio-thumbnail">
								<label>
									<input type="radio" id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
									       name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>"
										<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
											onclick="submitForm();" style="display: none"/>

									<span class="item-thumbnail">
										<?if (count($arPaySystem["PSA_LOGOTIP"]) > 0):?>
											<img src="<?=$arPaySystem["PSA_LOGOTIP"]["SRC"]?>" title="<?=$arPaySystem["PSA_NAME"];?>" alt="<?=$arPaySystem["PSA_NAME"];?>" class="img-responsive"/>
										<?else:?>
											<img src="<?=$templateFolder?>/images/logo-default-ps.gif" title="<?=$arPaySystem["PSA_NAME"];?>" alt="<?=$arPaySystem["PSA_NAME"];?>" class="img-responsive"/>
										<?endif?>
									</span>
								</label>
							</div>
						</div>
						<div class="col-md-10 col-sm-9">
							<?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
								<label for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>">
									<?=$arPaySystem["PSA_NAME"]?>
								</label>
							<?endif?>
							<span class="help-block">
								<small>
									<?if (intval($arPaySystem["PRICE"]) > 0)
										echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
									else
										echo $arPaySystem["DESCRIPTION"];
									?>
								</small>
							</span>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	<? endif ?>

</div>