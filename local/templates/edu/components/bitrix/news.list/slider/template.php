<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult['ITEMS']): ?>
	<header>
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
					<li data-target="#carouselExampleIndicators"
					    data-slide-to="<?=$arItemId?>" <? if ($arItemId === 0): ?>class="active"<? endif; ?>></li>
				<? endforeach; ?>
			</ol>
			<div class="carousel-inner" role="listbox">
				<!-- Slide One - Set the background image for this slide in the line below -->
				<? foreach ($arResult['ITEMS'] as $arItemId => $arItem): ?>
					<div class="carousel-item<? if ($arItemId === 0): ?> active<? endif; ?>"
					     style="background-image: url('<?=$arItem['RESIZE_PICTURE']['src']?>')">
						<div class="carousel-caption d-none d-md-block">
							<h3><?=$arItem['NAME']?></h3>
							<p><?=$arItem['PREVIEW_TEXT']?></p>
						</div>
					</div>
				<? endforeach; ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</header>
<? endif; ?>