<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
		<?
		$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
		$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
		$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

		$uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
		$areaId = $this->GetEditAreaId($uniqueId);
		$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
		$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
		?>
		<div class="col-lg-4 col-md-6 mb-4" id="<?=$areaId?>">
			<div class="card h-100">
				<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
					<img class="card-img-top" src="<?=$arItem['RESIZE_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
				</a>
				<div class="card-body">
					<h5 class="card-title">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
					</h5>
					<?
					$price = ($arItem['MIN_PRICE']['VALUE'] == 0) ? 'Бесплатно' :
						$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
					?>
					<? if ($price): ?>
						<h6><?=$price?></h6>
					<? endif; ?>
					<p class="card-text">
						<?=TruncateText($arItem['PREVIEW_TEXT'], 100)?>
					</p>
				</div>
				<div class="card-footer">
					<small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
				</div>
			</div>
		</div>
	<? endforeach; ?>
<? endif; ?>