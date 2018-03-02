<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult): ?>
	<!-- Post Content Column -->
	<div class="col-lg-8">

		<!-- Preview Image -->
		<img class="img-fluid rounded" src="<?=$arResult['RESIZE_PICTURE']['src']?>" alt="<?=$arResult['NAME']?>">

		<hr>

		<!-- Date/Time -->
		<p>Дата публикации: <?=$arResult["DISPLAY_ACTIVE_FROM"]?></p>

		<hr>

		<!-- Post Content -->
		<?=$arResult['DETAIL_TEXT']?>

		<hr>

	</div>
<? endif; ?>