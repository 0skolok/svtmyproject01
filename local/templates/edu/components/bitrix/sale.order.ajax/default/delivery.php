<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-delivery">

	<script type="text/javascript">
		function fShowStore(id, showImages, formWidth, siteId)
		{
			var strUrl = '<?=$templateFolder?>' + '/map.php';
			var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

			var storeForm = new BX.CDialog({
				'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
				head: '',
				'content_url': strUrl,
				'content_post': strUrlPost,
				'width': formWidth,
				'height':450,
				'resizable':false,
				'draggable':false
			});

			var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
			storeForm.ClearButtons();
			storeForm.SetButtons(button);
			storeForm.Show();
		}

		function GetBuyerStore()
		{
			BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
			//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
			BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
			BX.show(BX('select_store'));
		}

		function showExtraParamsDialog(deliveryId)
		{
			var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
			var formName = 'extra_params_form';
			var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

			if(window.BX.SaleDeliveryExtraParams)
			{
				for(var i in window.BX.SaleDeliveryExtraParams)
				{
					strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
				}
			}

			var paramsDialog = new BX.CDialog({
				'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
				head: '',
				'content_url': strUrl,
				'content_post': strUrlPost,
				'width': 500,
				'height':200,
				'resizable':true,
				'draggable':false
			});

			var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'saleDeliveryExtraParamsOk',
					'action': function ()
					{
						insertParamsToForm(deliveryId, formName);
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];

			paramsDialog.ClearButtons();
			paramsDialog.SetButtons(button);
			//paramsDialog.adjustSizeEx();
			paramsDialog.Show();
		}

		function insertParamsToForm(deliveryId, paramsFormName)
		{
			var orderForm = BX("ORDER_FORM"),
				paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

			var wrapDiv = BX(wrapDivId);
			window.BX.SaleDeliveryExtraParams = {};

			if(wrapDiv)
				wrapDiv.parentNode.removeChild(wrapDiv);

			wrapDiv = BX.create('div', {props: { id: wrapDivId}});

			for(var i = paramsForm.elements.length-1; i >= 0; i--)
			{
				var input = BX.create('input', {
						props: {
							type: 'hidden',
							name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
							value: paramsForm.elements[i].value
						}
					}
				);

				window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

				wrapDiv.appendChild(input);
			}

			orderForm.appendChild(wrapDiv);

			BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
		}
	</script>

	<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
	<?if(!empty($arResult["DELIVERY"])):
		$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_DELIVERY")?></h4>
			</div>
			<div class="panel-body delivery">
				<?foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery):?>
					<? if ($delivery_id !== 0 && intval($delivery_id) <= 0): ?>
						<? foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile):?>
							<div class="row delivery-row">
								<?if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
									$extraParams = "showExtraParamsDialog('".$delivery_id.":".$profile_id."');";
								else
									$extraParams = "";?>

								<div class="col-md-2 col-sm-3">
									<div class="radio-thumbnail">
										<label for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
											<input
												type="radio"
												id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
												name="<?=$arProfile["FIELD_NAME"]?>"
												value="<?=$delivery_id.":".$profile_id;?>" <?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?>
												onclick="<?=$extraParams?>submitForm();"
												class="hidden" />
											<span class="item-thumbnail">
												<?if (count($arDelivery["LOGOTIP"]) > 0):?>
													<img src="<?=$arDelivery["LOGOTIP"]["SRC"]?>" title="<?=$arProfile['TITLE']?>" alt="<?=$arProfile['TITLE']?>" class="img-responsive" />
												<?else:?>
													<img src="<?=$templateFolder?>/images/logo-default-d.gif" title="<?=$arProfile['TITLE']?>" alt="<?=$arProfile['TITLE']?>" class="img-responsive" />
												<?endif?>
											</span>
										</label>
									</div>
								</div>
								<div class="col-md-10 col-sm-9">
									<label for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
										<strong><?=$arDelivery["TITLE"]." (".$arProfile["TITLE"].")";?></strong>
									</label>
									<?if($arProfile["CHECKED"] == "Y" && doubleval($arResult["DELIVERY_PRICE"]) > 0):?>
										<span class="help-block">
											<small>
												<?=GetMessage("SALE_DELIV_PRICE_NEAR")?> <?=$arResult["DELIVERY_PRICE_FORMATED"]?>
												<?if ((isset($arResult["PACKS_COUNT"]) && $arResult["PACKS_COUNT"]) > 1):
													echo '<br />'.GetMessage('SALE_PACKS_COUNT').': '.$arResult["PACKS_COUNT"];
												endif;?>
											</small>
										</span>
									<?else:
										$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', 'default', array(
											"NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
											"DELIVERY" => $delivery_id,
											"PROFILE" => $profile_id,
											"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
											"ORDER_PRICE" => $arResult["ORDER_PRICE"],
											"LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
											"LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
											"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
											"ITEMS" => $arResult["BASKET_ITEMS"]
										), null, array('HIDE_ICONS' => 'Y'));
									endif;?>
									<span class="help-block">
										<small>
											<?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
												<?=$arProfile["DESCRIPTION"]?>
											<?elseif (strlen($arDelivery["DESCRIPTION"]) > 0):?>
												<?=$arDelivery["DESCRIPTION"]?>
											<?endif?>
										</small>
									</span>
								</div>
							</div>
						<?endforeach?>

					<? else: // stores and courier ?>

						<?if (count($arDelivery["STORE"]) > 0)
							$clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\"";
						else
							$clickHandler = "";
						?>
						<div class="row delivery-row">
							<div class="col-md-2 col-sm-3">
								<div class="radio-thumbnail">
									<label <?=$clickHandler?>>
										<input
											type="radio"
											id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
											name="<?=$arDelivery["FIELD_NAME"]?>"
											value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
											onclick="submitForm();"
											class="hidden">
										<span class="item-thumbnail">
											<?if (count($arDelivery["LOGOTIP"]) > 0):?>
												<img src="<?=$arDelivery["LOGOTIP"]["SRC"]?>" title="<?=$arDelivery['NAME']?>" alt="<?=$arDelivery['NAME']?>" class="img-responsive" />
											<?else:?>
												<img src="<?=$templateFolder?>/images/logo-default-d.gif" title="<?=$arDelivery['NAME']?>" alt="<?=$arDelivery['NAME']?>" class="img-responsive" />
											<?endif?>
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-10 col-sm-9">
								<label for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" <?=$clickHandler?>>
									<div><strong><?=$arDelivery["NAME"]?></strong></div>
								</label>

								<span class="help-block">
									<small>
										<?if (strlen($arDelivery["PERIOD_TEXT"])>0)
										{
											echo $arDelivery["PERIOD_TEXT"]."<br />";
										}?>
										<?=GetMessage("SALE_DELIV_PRICE")?> <?=$arDelivery["PRICE_FORMATED"]?>
										<? if ($arDelivery["DESCRIPTION"]): ?>
											<br /><?=$arDelivery["DESCRIPTION"]?>
										<? endif ?>
									</small>
								</span>

								<? if (count($arDelivery["STORE"]) > 0): ?>
									<span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
										<span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
										<a class="action" href="#" id="store_desc"
										   onClick = "fShowStore('<?=$arDelivery["ID"]?>',
											   '<?=$arParams["SHOW_STORES_IMAGES"]?>',
											   '<?=$width?>',
											   '<?=SITE_ID?>'); return false">
											<?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?>
										</a>
									</span>
								<? endif ?>
							</div>
						</div>
					<?endif ?>
				<? endforeach ?>
			</div>
		</div>
	<?endif?>
</div>
