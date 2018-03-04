<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require_once "classes.php";
?>
<div class="row">
	<div class="col-md-12">
		<form
			name="<? echo $arResult["FILTER_NAME"] . "_form" ?>"
			action="<? echo $arResult["FORM_ACTION"] ?>"
			method="get"
			class="smartfilter-bootstrap"
			role="form"
			data-ajax-url="<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>"
			>
			<? foreach ($arResult["HIDDEN"] as $arItem): ?>
				<input
					type="hidden"
					name="<? echo $arItem["CONTROL_NAME"] ?>"
					value="<? echo $arItem["HTML_VALUE"] ?>"
					id="<? echo $arItem["CONTROL_ID"] ?>"
					/>
			<? endforeach ?>
			<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
				<? if (isset($arItem["PRICE"])): ?>
					<? CSmartFilterRangeItem::Show($arItem, $arParams) ?>
				<? endif ?>
			<? endforeach ?>

			<? if ($arResult["APPLIED_FILTERS"]): ?>
				<div class="form-group">
					<label class="control-label"><?= GetMessage("SMART_FILTER_APPLIED_FILTERS") ?></label>
					<? foreach ($arResult["APPLIED_FILTERS"] as $appliedFilterGroupName => $arAppliedFilterGroup): ?>
						<p class="form-control-static">

							<b><?= $appliedFilterGroupName ?>:</b>
						<ul class="list-unstyled">
							<? foreach ($arAppliedFilterGroup as $arAppliedFilter): ?>
								<li>
									<a href="<?= $arAppliedFilter["DELETE_URL"] ?>"
									   title="<?= GetMessage("SMART_FILTER_DROP_FILTER") ?>"><i
											class="glyphicon glyphicon-remove fa fa-remove text-danger"></i></a>
									<? if (is_array($arAppliedFilter["VALUE"])): ?>
										<? if (strlen($arAppliedFilter["VALUE"]["MIN"])): ?>
											<?= GetMessage("CT_BCSF_FILTER_FROM") ?> <?= $arAppliedFilter["VALUE"]["MIN"] ?>
										<? endif ?>
										<? if (strlen($arAppliedFilter["VALUE"]["MAX"])): ?>
											<?= GetMessage("CT_BCSF_FILTER_TO") ?> <?= $arAppliedFilter["VALUE"]["MAX"] ?>
										<? endif ?>
									<? else: ?>
										<?= $arAppliedFilter["LABEL"] ?>
									<?endif ?>
								</li>
							<? endforeach ?>
						</ul>
						</p>
					<? endforeach ?>
					<!--noindex-->
					<p class="form-control-static"><a class="text-danger" href="<?= $arResult["CLEAN_URL"] ?>"
					                                  rel="nofollow"><?= GetMessage("SMART_FILTER_DROP_ALL_FILTERS") ?></a>
					</p>
					<!--/noindex-->
				</div>
			<? endif ?>

			<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
				<? if ($arItem["PROPERTY_TYPE"] == "N"): ?>
					<? CSmartFilterRangeItem::Show($arItem, $arParams) ?>
				<? elseif (!empty($arItem["VALUES"]) && !isset($arItem["PRICE"])): ?>
					<? CSmartFilterCheckboxesItem::Show($arItem, $arParams) ?>
				<?endif ?>
			<? endforeach ?>
			<? if ($arParams["SHOW_SUBMIT_BUTTONS"] == "Y"): ?>
				<!--noindex-->
				<div class="form-group">
					<button class="bx_filter_search_button btn btn-primary btn-block" type="submit" id="set_filter"
					        name="set_filter" value="y">
						<i class="glyphicon glyphicon-search fa fa-search"></i> <?= GetMessage("CT_BCSF_SET_FILTER") ?>
					</button>
				</div>
				<div class="form-group">
					<a href="<?= $arResult["CLEAN_URL"] ?>" class="bx_filter_search_button btn btn-primary btn-block"
					   rel="nofollow"><i
							class="glyphicon glyphicon-remove fa fa-remove"></i> <?= GetMessage("CT_BCSF_DEL_FILTER") ?>
					</a>
				</div>
				<!--/noindex-->
			<? endif ?>
			<!--noindex-->
			<div class="popup_result">
				<nobr>
					<? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span class="count">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
					<a href="<? echo $arResult["FILTER_URL"] ?>"
					   rel="nofollow"><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
				</nobr>
			</div>
			<!--/noindex-->
		</form>
	</div>
</div>