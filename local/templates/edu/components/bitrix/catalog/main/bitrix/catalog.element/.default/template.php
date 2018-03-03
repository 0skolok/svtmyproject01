<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($arResult): ?>
	<div class="col-lg-7">
		<div class="card sb-card mt-2">
			<img class="card-img-top" src="<?=$arResult['RESIZE_PICTURE']['src']?>" alt="<?=$arResult['NAME']?>">
			<div class="my-3 mx-3">
				<div class="mb-3">
					<div>
						<? if ($arResult['CAN_BUY']):?>
							<?
							$price = ($arResult['MIN_PRICE']['VALUE'] == 0) ? 'Бесплатно' :
								$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
							?>
							<i class="fa fa-rub"></i>
							<strong>Стоимость:</strong>&nbsp;<?=$price?>
						<? endif; ?>
					</div>
					<div>
						<? if ($arResult['DISPLAY_PROPERTIES']['COUNT_LESSON']): ?>
							<i class="fa fa-folder-open"></i>
							<strong><?=$arResult['DISPLAY_PROPERTIES']['COUNT_LESSON']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['COUNT_LESSON']['DISPLAY_VALUE']?>
						<? endif; ?>
					</div>
					<div>
						<? if ($arResult['DISPLAY_PROPERTIES']['TIME_EDU']): ?>
							<i class="fa fa-clock-o"></i>
							<strong><?=$arResult['DISPLAY_PROPERTIES']['TIME_EDU']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['TIME_EDU']['DISPLAY_VALUE']?>
						<? endif; ?>
					</div>
				</div>
				<ul class="list-inline m-0">
					<li class="list-inline-item">
						<a href="#"
						   class="btn btn-secondary">
							<i class="fa fa-book"></i> Попробовать
						</a>
					</li>
					<li class="list-inline-item">
						<a href="#"
						   class="btn btn-secondary">
							<i class="fa fa-shopping-cart"></i> В корзину
						</a>
					</li>
					<li class="list-inline-item">
						<a href="#"
						   class="btn btn-secondary">
							<i class="fa fa-star"></i> В избранные
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="card sb-card download-links mt-4">
			<div class="card-body">
				<h4><?=$arResult['NAME']?></h4>
				<? if ($arResult['DISPLAY_PROPERTIES']['LEVEL']): ?>
					<h6><?=$arResult['DISPLAY_PROPERTIES']['LEVEL']['DISPLAY_VALUE']?></h6>
				<? endif; ?>
				<p class="mb-0">
					<?=$arResult['DETAIL_TEXT']?>
				</p>
			</div>
		</div>
		<? if ($arResult['DISPLAY_PROPERTIES']['PROGRAMM']): ?>
			<div class="mt-4 table-responsive">
				<h4>Содержание курса</h4>
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>№</th>
						<th>Наименование курса</th>
					</tr>
					</thead>
					<tbody>
					<? foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAMM']['DISPLAY_VALUE'] as $programId =>
						$program): ?>
						<?
						$id = $programId + 1;
						?>
						<tr>
							<td>
								<div class="text-center detail-block">
									<?=$id?>
								</div>
							</td>
							<td>
								<?=$program?>
								<div class="help-block">
									<?=$arResult['DISPLAY_PROPERTIES']['PROGRAMM']['DESCRIPTION'][$programId]?>
								</div>
							</td>
						</tr>
					<? endforeach; ?>
					</tbody>
				</table>
			</div>
		<? endif; ?>
		<? if ($arResult['DISPLAY_PROPERTIES']['HONORS']): ?>
			<div class="mt-4 table-responsive">
				<h4>Достижения курса</h4>
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>№</th>
						<th>Наименование курса</th>
					</tr>
					</thead>
					<tbody>
					<? foreach ($arResult['DISPLAY_PROPERTIES']['HONORS']['DISPLAY_VALUE'] as $programId =>
						$program): ?>
						<?
						$id = $programId + 1;
						?>
						<tr>
							<td>
								<div class="text-center detail-block">
									<?=$id?>
								</div>
							</td>
							<td>
								<?=$program?>
								<div class="help-block">
									<?=$arResult['DISPLAY_PROPERTIES']['HONORS']['DESCRIPTION'][$programId]?>
								</div>
							</td>
						</tr>
					<? endforeach; ?>
					</tbody>
				</table>
			</div>
		<? endif; ?>
	</div>
	<div class="col-lg-5">
		<? if ($arResult['DISPLAY_PROPERTIES']['DESC_LEARN']): ?>
			<div class="card sb-card mt-2">
				<div class="card-body">
					<h4><?=$arResult['DISPLAY_PROPERTIES']['DESC_LEARN']['NAME']?>:</h4>
					<ul class="mb-0">
						<?=$arResult['DISPLAY_PROPERTIES']['DESC_LEARN']['DISPLAY_VALUE']?>
					</ul>
				</div>
			</div>
		<? endif; ?>
		<div class="card sb-card mt-4">
			<div class="card-body">
				<h4>Прочая информация</h4>
				<div>
					<? if ($arResult['DISPLAY_PROPERTIES']['COUNT_BALL']): ?>
						<i class="fa fa-cubes" aria-hidden="true"></i>
						<strong><?=$arResult['DISPLAY_PROPERTIES']['COUNT_BALL']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['COUNT_BALL']['DISPLAY_VALUE']?>
					<? endif; ?>
				</div>
				<div>
					<? if ($arResult['DISPLAY_PROPERTIES']['COUNT_HONOR']): ?>
						<i class="fa fa-rocket" aria-hidden="true"></i>
						<strong><?=$arResult['DISPLAY_PROPERTIES']['COUNT_HONOR']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['COUNT_HONOR']['DISPLAY_VALUE']?>
					<? endif; ?>
				</div>
				<div>
					<? if ($arResult['DISPLAY_PROPERTIES']['COUNT_PEOPLE']): ?>
						<i class="fa fa-user-plus" aria-hidden="true"></i>
						<strong><?=$arResult['DISPLAY_PROPERTIES']['COUNT_PEOPLE']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['COUNT_PEOPLE']['DISPLAY_VALUE']?>
					<? endif; ?>
				</div>
				<div>
					<? if ($arResult['DISPLAY_PROPERTIES']['COUNT_COMPLETE']): ?>
						<i class="fa fa-users" aria-hidden="true"></i>
						<strong><?=$arResult['DISPLAY_PROPERTIES']['COUNT_COMPLETE']['NAME']?>:</strong>&nbsp;<?=$arResult['DISPLAY_PROPERTIES']['COUNT_COMPLETE']['DISPLAY_VALUE']?>
					<? endif; ?>
				</div>
				<div>
					<? if ($arResult['DATE_CREATE']): ?>
						<i class="fa fa-clipboard" aria-hidden="true"></i>
						<strong>Дата создания:</strong>&nbsp;<?=$arResult['DATE_CREATE']?>
					<? endif; ?>
				</div>
				<div>
					<? if ($arResult['TIMESTAMP_X']): ?>
						<i class="fa fa-floppy-o" aria-hidden="true"></i>
						<strong>Дата обновления:</strong>&nbsp;<?=$arResult['TIMESTAMP_X']?>
					<? endif; ?>
				</div>
			</div>
		</div>
		<? if ($arResult['DISPLAY_PROPERTIES']['TAGS_COURSES']): ?>
			<div class="card sb-card mt-4">
				<div class="card-body">
					<h4>Похожие курсы</h4>
					<p>Предлагаем вашему вниманию похожие курсы по программированию</p>
					<? foreach ($arResult['DISPLAY_PROPERTIES']['TAGS_COURSES']['LINK_ELEMENT_VALUE'] as $tagId => $tag): ?>
						<div class="mt-2">
							<a href="<?=$tag['DETAIL_PAGE_URL']?>"
							   class="btn btn-sm btn-block btn-secondary">
								<i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;<?=$tag['NAME']?>
							</a>
						</div>
					<? endforeach; ?>
				</div>
			</div>
		<? endif; ?>
	</div>
<? endif; ?>