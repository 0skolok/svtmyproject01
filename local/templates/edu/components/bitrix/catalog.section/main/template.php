<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * $arParams['TITLE'] заголовок
 */
$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
?>

<!-- Portfolio Section -->
<? if ($arResult['ITEMS']): ?>
	<? if (strlen($arParams['TITLE']) > 3):?>
		<h2 class="my-4"><?=$arParams['TITLE']?></h2>
	<? endif; ?>
	<div class="row">
		<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
			<?
			$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
			$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
			$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

			$uniqueId = $arItem['ID'].'_'.md5($this->randString().$component->getAction());
			$areaId = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
			?>
			<div class="col-lg-4 col-sm-6 portfolio-item" id="<?=$areaId?>">
				<div class="card h-100">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
						<img class="card-img-top" src="<?=$arItem['RESIZE_PICTURE']['src']?>" alt="<?=$arItem['NAME']?>">
					</a>
					<div class="card-body">
						<h4 class="card-title">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
								<?=$arItem['NAME']?>
							</a>
						</h4>
						<p class="card-text">
							<?=TruncateText($arItem['PREVIEW_TEXT'], 150)?>
						</p>
					</div>
				</div>
			</div>
		<? endforeach; ?>
	</div>
	<!-- pagination-container -->
	<? if ($showBottomPager): ?>
		<?=$arResult['NAV_STRING']?>
	<? endif; ?>
	<!-- pagination-container -->
<? endif; ?>
<!-- /.row -->