<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * $arParams['TITLE'] - заголовок
 */
?>
<? if ($arResult): ?>
	<!-- Navigation -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="<?=SITE_DIR?>">
				<?=$arParams['TITLE'] ? : $APPLICATION->ShowTitle(false); ?>
			</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">

					<? foreach ($arResult as $arItemId => $arItem): ?>
						<?
						$isItems = $arItem['ITEMS'] ? true : false;
						?>
						<li class="nav-item<? if ($isItems): ?> dropdown<? endif; ?>">
							<a class="nav-link <? if ($isItems): ?> dropdown-toggle<? endif; ?>" href="<?=$arItem['LINK'];?>"<? if ($isItems): ?> id="navbarDropdown-<?=$arItemId?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<? endif; ?>>
								<?=$arItem['TEXT'];?>
							</a>
							<? if ($isItems): ?>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown-<?=$arItemId?>">
									<? foreach ($arItem['ITEMS'] as $itemId => $item): ?>
										<a class="dropdown-item" href="<?=$item['LINK'];?>">
											<?=$item['TEXT'];?>
										</a>
									<? endforeach; ?>
								</div>
							<? endif; ?>
						</li>
					<? endforeach; ?>
				</ul>
			</div>
		</div>
	</nav>
<? endif; ?>
