<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-summary">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_SUM_TITLE")?></h4>
		</div>
		<div class="panel-body">
			<table class="table footable">
				<thead>
				<tr>
					<th class="footable-first-column"></th><!--DO NOT REMOVE-->
					<th data-hide="hidepicture,hideprice" data-name="<?=GetMessage("SOA_TEMPL_SUM_PICTURE") ?>"></th>
					<th><?=GetMessage("SOA_TEMPL_NAME") ?></th>
					<?if($arResult['HAS_DISCOUNT']):?>
						<th data-hide="hidediscount,hidepicture,hideprice"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT") ?></th>
					<?endif?>
					<th data-hide="hideprice" class="right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></th>
					<th data-hide="hideprice" data-name="<?=GetMessage("SOA_TEMPL_SUM_QUANTITY") ?>"></th>
				</tr>
				</thead>

				<tbody>
				<?foreach ($arResult["GRID"]["ROWS"] as $k => $arData):?>
					<tr>
						<td class="footable-first-column"></td><!--DO NOT REMOVE-->
						<td>
							<img src="<?=$arData["data"]["PICTURE"]['SRC']?>" alt="<?=$arData["data"]['NAME']?>" class="img-responsive"
							     width="<?=$arData["data"]["PICTURE"]['WIDTH']?>" height="<?=$arData["data"]["PICTURE"]['HEIGHT']?>" />
						</td>

						<td>
							<div>
								<?if (strlen($arData["data"]["DETAIL_PAGE_URL"])>0):?>
									<a href="<?=$arData["data"]["DETAIL_PAGE_URL"]?>"><?=$arData["data"]["NAME"]?></a>
								<?else:?>
									<?=$arData["data"]["NAME"]?>
								<?endif;?>
							</div>

							<?if(is_array($arData["data"]["PROPS"]) && !empty($arData["data"]["PROPS"])):?>
								<table class="sku-props">
									<?foreach($arData["data"]["PROPS"] as $prop):?>
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
																			<span class="item-thumbnail">
																				<img src="<?=$prop['SKU_VALUE']['PICT']['SRC']?>" height="<?=$prop['SKU_VALUE']['PICT']['HEIGHT']?>" title="<?=$prop['SKU_VALUE']['NAME']?>" alt="<?=$prop['SKU_VALUE']['NAME']?>">
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
							<td><?=$arData["data"]["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
						<?endif?>


						<td class="right-over-xs">
							<?if (doubleval($arData["data"]["DISCOUNT_PRICE"]) > 0):?>
								<div class="price price-new"><?=$arData["data"]["PRICE_FORMATED"]?></div>
								<div class="price price-old"><?=SaleFormatCurrency($arData["data"]["PRICE"] + $arData["data"]["DISCOUNT_PRICE"], $arData["data"]["CURRENCY"])?></div>
							<?else:?>
								<div class="price price-default"><?=$arData["data"]["PRICE_FORMATED"]?></div>
							<?endif;?>
							<div><small><?=$arData["data"]["NOTES"]?></small></div>
						</td>

						<td>
							<?=GetMessage("SPOD_QUANTITY_BEFORE");?><?=$arData["data"]["QUANTITY"]?>
						</td>
					</tr>
				<? endforeach;?>
				</tbody>

				<tfoot>
				<tr>
					<td <?if($arResult['HAS_DISCOUNT']):?>colspan="6"<?else:?>colspan="5"<?endif;?>>
						<div class="row">
							<?if(floatval($arResult["ORDER_WEIGHT"]) > 0):?>
								<div class="col-sm-8 col-xs-6  right-over-xs"><strong><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM");?></strong></div>
								<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["ORDER_WEIGHT_FORMATED"];?></div>
							<?endif;?>

							<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY");?></div>
							<div class="col-sm-4 col-xs-6 right-over-xs"><?=$arResult['ORDER_PRICE_FORMATED']?></div>

							<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0):?>
								<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT");?></div>
								<div class="col-sm-4 col-xs-6 right-over-xs"><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></div>
							<?endif;?>

							<?if (count($arResult["TAX_LIST"]) > 0) foreach($arResult["TAX_LIST"] as $tax):?>
								<div class="col-sm-8 col-xs-6 right-over-xs"><?=$tax["TAX_NAME"]." ".$tax["VALUE_FORMATED"]. ":";?></div>
								<div class="col-sm-4 col-xs-6  right-over-xs"><?=$tax["VALUE_MONEY_FORMATED"];?></div>
							<?endforeach?>

							<?if(strlen($arResult["DELIVERY_PRICE_FORMATED"])):?>
								<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_DELIVERY");?></div>
								<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["DELIVERY_PRICE_FORMATED"];?></div>
							<?endif;?>

							<? if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0):?>
								<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_PAYED");?></div>
								<div class="col-sm-4 col-xs-6  right-over-xs"><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"];?></div>
							<?endif;?>

							<div class="col-sm-8 col-xs-6 right-over-xs"><?=GetMessage("SOA_TEMPL_SUM_IT");?></div>
							<div class="col-sm-4 col-xs-6  right-over-xs">
								<?if ($arResult['HAS_DISCOUNT']):?>
									<div class="price price-new"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></div>
									<div class="price price-old"><?=$arResult["PRICE_WITHOUT_DISCOUNT"]?></div>
								<?else:?>
									<div class="price price-default"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></div>
								<?endif;?>
							</div>
						</div>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></h4>
		</div>
		<div class="panel-body">
			<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" class="form-control" placeholder="<?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?>"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
		</div>
	</div>

</div>