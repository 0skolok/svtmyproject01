<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<? if (strlen($arParams['TITLE']) > 3): ?>
		<!-- Portfolio Section -->
		<h2 class="my-4"><?=$arParams['TITLE']?></h2>
	<? endif; ?>

	<div class="row">
		<? foreach ($arResult['ITEMS'] as $arItemsId => $arItems): ?>
			<!-- Marketing Icons Section -->
			<div class="col-lg-4 mb-4">
				<div class="card h-100">
					<h4 class="card-header"><?=$arItems['NAME']?></h4>
					<div class="card-body">
						<p class="card-text">
							<?=TruncateText($arItems['PREVIEW_TEXT'], 230)?>
						</p>
					</div>
					<div class="card-footer">
						<a href="<?=$arItems['DETAIL_PAGE_URL']?>" class="btn btn-primary">Читать далее</a>
					</div>
				</div>
			</div>
			<!-- /.row -->
		<? endforeach; ?>
	</div>
<? endif; ?>