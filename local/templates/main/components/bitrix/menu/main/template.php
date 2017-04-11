<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
} ?>

<? if ($arResult): ?>
	<!-- Nav -->
	<nav id="nav">
		<ul>
			<? foreach ($arResult as $arItem):
				if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
				{
					continue;
				}
				?>
				<? if ($arItem["SELECTED"]): ?>
				<li class="current"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<? else: ?>
				<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<? endif ?>

			<? endforeach ?>
		</ul>
	</nav>
<? endif; ?>
