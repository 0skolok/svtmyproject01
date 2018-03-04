<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-personal-order-detail">

	<?if(strlen($arResult["ERROR_MESSAGE"])<=0):?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?=GetMessage("SPOD_ORDER_NO")?>&nbsp;<?=$arResult["ACCOUNT_NUMBER"]?>&nbsp;<?=GetMessage("SPOD_FROM")?> <?=$arResult["DATE_INSERT"] ?></h3>
			</div>

			<div class="panel-body">
				<div class="row order-prop">
					<div class="col-sm-5"><strong><?=GetMessage("SPOD_ORDER_STATUS")?></strong></div>
					<div class="col-sm-7"><?=$arResult["STATUS"]["NAME"]?> (<?=$arResult["DATE_STATUS"]?>)</div>
				</div>

				<div class="row order-prop">
					<div class="col-sm-5"><strong><?=GetMessage("P_ORDER_PRICE")?>:</strong></div>
					<div class="col-sm-7">
						<strong><?=$arResult["PRICE_FORMATED"] ?></strong>
						<?if (doubleval($arResult["SUM_PAID"]) > 0):?>
							<span>(<?=GetMessage("SPOD_ALREADY_PAID") ?>&nbsp;<strong><?=$arResult["SUM_PAID_FORMATED"] ?></strong>)</span>
						<?endif;?>
					</div>
				</div>

				<div class="row order-prop order-prop-last">
					<div class="col-sm-5"><strong><?=GetMessage("P_ORDER_CANCELED") ?>:</strong></div>
					<div class="col-sm-7">
						<?if ($arResult["CANCELED"] != "Y"):?>
							<?=GetMessage("SALE_NO")?>
							<?if ($arResult["CAN_CANCEL"]=="Y"):?>
								<a class="btn btn-danger" href="<?=$arResult["URL_TO_CANCEL"]?>"><?=GetMessage
									("SALE_CANCEL_ORDER")?></a>
							<?endif;?>
						<?else:?>
							<?=GetMessage("SALE_YES")." (".GetMessage("SPOD_ORDER_FROM").$arResult["DATE_CANCELED"].")".$arResult["REASON_CANCELED"]?>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>

		<?if (intval($arResult["USER_ID"])>0):?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?=GetMessage("SPOD_ACCOUNT_DATA")?></h3>
				</div>

				<div class="panel-body">
					<?if(strlen($arResult["USER_NAME"]) > 0):?>
						<div class="row order-prop">
							<div class="col-sm-5"><strong><?=GetMessage("SPOD_ACCOUNT") ?>:</strong></div>
							<div class="col-sm-7"><?=$arResult["USER_NAME"]?></div>
						</div>
					<?endif;?>

					<?if ($arResult["USER"]["LOGIN"] !== $arResult["USER"]["EMAIL"]):?>
						<div class="row order-prop">
							<div class="col-sm-5"><strong><?= GetMessage("SPOD_LOGIN") ?></strong></div>
							<div class="col-sm-7"><?=$arResult["USER"]["LOGIN"]?></div>
						</div>
					<?endif;?>

					<div class="row order-prop order-prop-last">
						<div class="col-sm-5"><strong><?echo GetMessage("SPOD_EMAIL")?></strong></div>
						<div class="col-sm-7"><a href="mailto:<?=$arResult["USER"]["EMAIL"]?>"><?=$arResult["USER"]["EMAIL"]?></a></div>
					</div>
				</div>
			</div>
		<?endif;?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?=GetMessage("P_ORDER_PAYMENT")?></h3>
			</div>

			<div class="panel-body">
				<div class="row order-prop">
					<div class="col-sm-5"><strong><?=GetMessage("P_ORDER_PAY_SYSTEM")?>:</strong></div>
					<div class="col-sm-7">
						<?if (IntVal($arResult["PAY_SYSTEM_ID"]) > 0)
							echo $arResult["PAY_SYSTEM"]["NAME"];
						else
							echo GetMessage("SPOD_NONE");
						?>
					</div>
				</div>
				<div class="row order-prop">
					<div class="col-sm-5"><strong><?echo GetMessage("P_ORDER_PAYED") ?>:</strong></div>
					<div class="col-sm-7">
						<?if ($arResult["PAYED"] == "Y"):?>
							<?=GetMessage("SALE_YES").'&nbsp;'.GetMessage("SPOD_ORDER_FROM").$arResult["DATE_PAYED"].")";?>
						<?else:?>
							<?=GetMessage("SALE_NO")?>
							<?if ($arResult["CANCELED"]!="Y" && $arResult["CAN_REPAY"]=="Y"):?>
								<?if($arResult["PAY_SYSTEM"]["PSA_NEW_WINDOW"] == "Y"):?>
									<a class="btn btn-primary" target="_blank" href="<?=$arResult["PAY_SYSTEM"]["PSA_ACTION_FILE"]?>"><?=GetMessage("SALE_REPEAT_PAY")?></a>
								<?else:
									include($arResult["PAY_SYSTEM"]["PSA_ACTION_FILE"]);
								endif?>
							<?endif;?>
						<?endif;?>
					</div>
				</div>

				<?if($arResult["TRACKING_NUMBER"]):?>
					<div class="row order-prop">
						<div class="col-sm-5"><strong><?=GetMessage('P_ORDER_TRACKING_NUMBER')?>:</strong></div>
						<div class="col-sm-7">
							<?=$arResult["TRACKING_NUMBER"]?>
						</div>
					</div>
				<?endif?>

				<div class="row order-prop order-prop-last">
					<div class="col-sm-5"><strong><?=GetMessage("P_ORDER_DELIVERY")?>:</strong></div>
					<div class="col-sm-7">
						<?if(strpos($arResult["DELIVERY_ID"], ":") !== false || intval($arResult["DELIVERY_ID"])):?>
							<?=$arResult["DELIVERY"]["NAME"]?>

							<?if(intval($arResult['STORE_ID']) && !empty($arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']])):?>

								<?$store = $arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']];?>
								 / <?=GetMessage('SPOD_TAKE_FROM_STORE')?> "<?=$store['TITLE']?>"

								<?if(!empty($store['DESCRIPTION'])):?>
									<div><?=$store['DESCRIPTION']?></div>
								<?endif?>

								<?if(!empty($store['ADDRESS'])):?>
									<div><?=GetMessage('SPOD_STORE_ADDRESS')?>: <?=$store['ADDRESS']?></div>
								<?endif?>

								<?if(!empty($store['SCHEDULE'])):?>
									<div><?=GetMessage('SPOD_STORE_WORKTIME')?>: <?=$store['SCHEDULE']?></div>
								<?endif?>

								<?if(!empty($store['PHONE'])):?>
									<div><?=GetMessage('SPOD_STORE_PHONE')?>: <?=$store['PHONE']?></div>
								<?endif?>

								<?if(!empty($store['EMAIL'])):?>
									<div><?=GetMessage('SPOD_STORE_EMAIL')?>: <a href="mailto:<?=$store['EMAIL']?>"><?=$store['EMAIL']?></a></div>
								<?endif?>

								<?if(($store['GPS_N'] = floatval($store['GPS_N'])) && ($store['GPS_S'] = floatval($store['GPS_S']))):?>
									<div>

										<?ob_start();?>
										<div><?$mg = $arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE'];?>
											<?if(!empty($mg['SRC'])):?><img src="<?=$mg['SRC']?>" width="<?=$mg['WIDTH']?>" height="<?=$mg['HEIGHT']?>"><br /><br /><?endif?>
											<?=$store['TITLE']?></div>
										<?$ballon = ob_get_contents();?>
										<?ob_end_clean();?>

										<?
										$mapParams = array(
											'yandex_lat' => $store['GPS_N'],
											'yandex_lon' => $store['GPS_S'],
											'yandex_scale' => 16,
											'PLACEMARKS' => array(
												array(
													'LON' => $store['GPS_S'],
													'LAT' => $store['GPS_N'],
													'TEXT' => $ballon
												)
											));
										?>

										<?$APPLICATION->IncludeComponent("bitrix:map.yandex.view", ".default", array(
												"INIT_MAP_TYPE" => "MAP",
												"MAP_DATA" => serialize($mapParams),
												"MAP_WIDTH" => "100%",
												"MAP_HEIGHT" => "200",
												"CONTROLS" => array(
													0 => "SMALLZOOM",
												),
												"OPTIONS" => array(
													0 => "ENABLE_SCROLL_ZOOM",
													1 => "ENABLE_DBLCLICK_ZOOM",
													2 => "ENABLE_DRAGGING",
												),
												"MAP_ID" => 'store-map'
											),
											$this->__component
										);?>
									</div>
								<?endif?>

							<?endif?>

						<?else:?>
							<?=GetMessage("SPOD_NONE")?>
						<?endif?>
					</div>
				</div>
			</div>
		</div>

		<?foreach($arResult['ORDER_PROPS_GROUPS'] as $groupName => $groupProps):?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?=$groupName?></h3>
				</div>

				<div class="panel-body">
					<?foreach($groupProps as $propId):
						$prop = $arResult["ORDER_PROPS"][$propId];?>
						<div class="row order-prop<?=($prop['LAST_IN_GROUP']=='Y' ? ' order-prop-last': '')?>">
							<div class="col-sm-5"><strong><?=$prop["NAME"]?>:</strong></div>
							<div class="col-sm-7">
								<?if ($prop["TYPE"] == "CHECKBOX") {
									if ($prop["VALUE"] == "Y") {
										echo GetMessage("SALE_YES");
									} else {
										echo GetMessage("SALE_NO");
									}
								} else {
									echo $prop["VALUE"];
								}?>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		<?endforeach;?>

		<?if (strlen($arResult["USER_DESCRIPTION"])>0):?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?=GetMessage("P_ORDER_USER_COMMENT")?></h3>
				</div>

				<div class="panel-body">
					<?=$arResult["USER_DESCRIPTION"]?>
				</div>
			</div>
		<?endif;?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?=GetMessage("P_ORDER_BASKET")?></h3>
			</div>

			<div class="panel-body">
				<table class="table footable">
					<thead>
						<tr>
							<th class="footable-first-column"></th><!--DO NOT REMOVE-->
							<th data-hide="hidepicture,hideprice" data-name="<?=GetMessage("SPOD_IMAGE") ?>"></th>
							<th><?=GetMessage("SPOD_NAME") ?></th>
							<?if($arResult['HAS_DISCOUNT']):?>
								<th data-hide="hidediscount,hidepicture,hideprice"><?=GetMessage("SPOD_DISCOUNT") ?></th>
							<?endif?>
							<th data-hide="hideprice" class="right-over-xs"><?=GetMessage("SPOD_PRICE")?></th>
							<th data-hide="hideprice" data-name="<?=GetMessage("SPOD_QUANTITY") ?>"></th>
						</tr>
					</thead>

					<tbody>
						<?foreach($arResult["BASKET"] as $prod):?>
							<tr>
								<td class="footable-first-column"></td><!--DO NOT REMOVE-->
								<td>
									<img src="<?=$prod["PICTURE"]['SRC']?>" alt="<?=$prod['NAME']?>" class="img-responsive"
										 width="<?=$prod["PICTURE"]['WIDTH']?>" height="<?=$prod["PICTURE"]['HEIGHT']?>" />
								</td>

								<td>
									<div>
										<?if (strlen($prod["DETAIL_PAGE_URL"])>0):?>
											<a href="<?=$prod["DETAIL_PAGE_URL"]?>"><?=$prod["NAME"]?></a>
										<?else:?>
											<?=$prod["NAME"]?>
										<?endif;?>
									</div>

									<?if(is_array($prod["PROPS"]) && !empty($prod["PROPS"])):?>
										<table class="sku-props">
											<?foreach($prod["PROPS"] as $prop):?>
												<tr>
													<td>
														<div class="sku-prop-name"><?=$prop["NAME"]?></div>
													</td>
													<td>
														<div class="sku-prop-value">
															<?if(!empty($prop['SKU_VALUE']) && $prop['SKU_TYPE'] == 'image'):?>
																<div class="radio-thumbnail">
																	<label>
																		<input type="radio" disabled="disabled">
																		<span class="item-thumbnail image">
																			<img src="<?=$prop['SKU_VALUE']['PICT']['SRC']?>"
																			     class="img-responsive"
																			     width="<?=$prop['SKU_VALUE']['PICT']['WIDTH']?>"
																			     height="<?=$prop['SKU_VALUE']['PICT']['HEIGHT']?>"
																			     title="<?=$prop['SKU_VALUE']['NAME']?>"
																			     alt="<?=$prop['SKU_VALUE']['NAME']?>">
																		</span>
																	</label>
																</div>
															<?else:?>
																<div class="radio-thumbnail">
																	<label>
																		<input type="radio" disabled="disabled">
																		<span class="item-thumbnail text"><?=$prop["VALUE"]?></span>
																	</label>
																</div>
															<?endif?>
														</div>
													</td>
												</tr>
											<?endforeach?>
										</table>
									<?endif;?>

								</td>

								<?if($arResult['HAS_DISCOUNT']):?>
									<td><?=$prod["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
								<?endif?>


								<td class="right-over-xs">
									<div class="price price-default"><?=$prod["PRICE_FORMATED"]?></div>
									<div><small><?=$prod["NOTES"]?></small></div>
								</td>

								<td>
									<?=GetMessage("SPOD_QUANTITY_BEFORE");?><?=$prod["QUANTITY"]?>
								</td>
							</tr>
						<? endforeach;?>
					</tbody>

					<tfoot>
						<tr>
							<td <?if($arResult['HAS_DISCOUNT']):?>colspan="6"<?else:?>colspan="5"<?endif;?>>
								<div class="row">
									<?if(floatval($arResult["ORDER_WEIGHT"])):?>
										<div class="col-sm-8 col-xs-6  right-over-xs"><strong><?=GetMessage("SPOD_WEIGHT_ALL").":";?></strong></div>
										<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["ORDER_WEIGHT_FORMATED"];?></div>
									<?endif;?>

									<? ///// PRICE SUM ?>
									<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SPOD_PRODUCT_SUM").":";?></div>
									<div class="col-sm-4 col-xs-6 right-over-xs"><?=$arResult['PRODUCT_SUM_FORMATTED']?></div>

									<? ///// DELIVERY PRICE: print even equals 2 zero ?>
									<?if(strlen($arResult["PRICE_DELIVERY_FORMATED"])):?>
										<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SPOD_DELIVERY").":";?></div>
										<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["PRICE_DELIVERY_FORMATED"];?></div>
									<?endif;?>

									<? ///// TAXES DETAIL ?>
									<?foreach($arResult["TAX_LIST"] as $tax):?>
										<div class="col-sm-8 col-xs-6 right-over-xs"><?=$tax["TAX_NAME"].":";?></div>
										<div class="col-sm-4 col-xs-6  right-over-xs"><?=$tax["VALUE_MONEY_FORMATED"];?></div>
									<?endforeach?>

									<?if(floatval($arResult["TAX_VALUE"])):?>
										<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SPOD_TAX").":";?></div>
										<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["TAX_VALUE_FORMATED"];?></div>
									<?endif;?>

									<?if(floatval($arResult["DISCOUNT_VALUE"])):?>
										<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SPOD_DISCOUNT").":";?></div>
										<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["DISCOUNT_VALUE_FORMATED"];?></div>
									<?endif;?>

									<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SPOD_ITOG")?>:</div>
									<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["PRICE_FORMATED"]?></div>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	<?else:?>
		<?=ShowError($arResult["ERROR_MESSAGE"]);?>
	<?endif;?>

</div>
