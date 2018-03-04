<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

?>

<?
ShowError($arResult["strProfileError"]);

if ($arResult['DATA_SAVED'] == 'Y')
{
	ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
}

?>
<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 mb-2">
		<?=$arResult['arUser']['PERSONAL_PHOTO_HTML']?>
	</div>
	<div class="col-xs-12 col-sm-8 col-md-8 pull-right">
		<table class="table table-hover">
			<tr>
				<td>Никнейм:</td>
				<td><?=$arResult["arUser"]["LOGIN"]?></td>
			</tr>
			<tr>
				<td>Звание:</td>
				<td>Новичок</td>
			</tr>
			<tr>
				<td>Группа:</td>
				<td>TEST</td>
			</tr>
			<tr>
				<td>ФИО:</td>
				<td><?=$arResult["arUser"]["NAME"]?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?=$arResult["arUser"]["EMAIL"]?></td>
			</tr>
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="row">
			<div class="col-xs-4 col-sm-2 col-md-2 text-center mb-2">
				<table class="table">
					<img src="<?=SITE_TEMPLATE_PATH?>/images/lvlx.png"
					     class="image img-responsive" alt=""/>
				</table>
			</div>
			<div class="col-xs-8 col-sm-10 col-md-10">
				<table class="table table-hover">
					<tr>
						<td>Ваш уровень:</td>
						<td>25</td>
					</tr>
					<tr>
						<td>Всего баллов:</td>
						<td>285</td>
					</tr>
					<tr>
						<td>До нового уровня:</td>
						<td>80</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-2 col-md-2 text-center mb-2">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/akadem.png" class="image
					img-responsive" alt=""/>
			</div>
			<div class="col-xs-8 col-sm-10 col-md-10">
				<table class="table table-hover">
					<tr>
						<td>Изучено курсов:</td>
						<td>12</td>
					</tr>
					<tr>
						<td>Подписок на курсы:</td>
						<td>2</td>
					</tr>
					<tr>
						<td>Изучено уроков:</td>
						<td>25</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 col-sm-2 col-md-2 text-center mb-2">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/dostx.png"
				     class="image img-responsive"
				     alt=""/>
			</div>
			<div class="col-xs-12 col-sm-10 col-md-10">
				<div class="table-honor">
					<table class="table table-fixed">
						<thead>
						<tr class="header-bold">
							<th class="col-xs-3">#</th>
							<th class="col-xs-6">Наименование</th>
							<th class="col-xs-3">Дата</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="col-xs-3">
								<img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/honor/k1.png"
								     class="image img-fix img-thumbnail img-responsive"
								     alt=""/>
							</td>
							<td class="col-xs-6">Трудолюбивый
								ученик
							</td>
							<td class="col-xs-3">23.05.2016</td>
						</tr>
						<tr>
							<td class="col-xs-3">
								<img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/honor/k1.png"
								     class="image img-fix img-thumbnail img-responsive"
								     alt=""/>
							</td>
							<td class="col-xs-6">Трудолюбивый
								ученик
							</td>
							<td class="col-xs-3">23.05.2016</td>
						</tr>
						<tr>
							<td class="col-xs-3">
								<img width="50" src="<?=SITE_TEMPLATE_PATH?>/images/honor/k1.png"
								     class="image img-fix img-thumbnail img-responsive"
								     alt=""/>
							</td>
							<td class="col-xs-6">Трудолюбивый
								ученик
							</td>
							<td class="col-xs-3">23.05.2016</td>
						</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<h3>More intriguing information</h3>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac quam risus, at tempus
	justo. Sed dictum rutrum massa eu volutpat. Quisque vitae hendrerit sem. Pellentesque lorem felis,
	ultricies a bibendum id, bibendum sit amet nisl. Mauris et lorem quam. Maecenas rutrum imperdiet
	vulputate. Nulla quis nibh ipsum, sed egestas justo. Morbi ut ante mattis orci convallis tempor.
	Etiam a lacus a lacus pharetra porttitor quis accumsan odio. Sed vel euismod nisi. Etiam convallis
	rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien
	vulputate. Nulla quis nibh ipsum, sed egestas justo. Morbi ut ante mattis orci convallis tempor.
	Etiam a lacus a lacus pharetra porttitor quis accumsan odio. Sed vel euismod nisi. Etiam convallis
	rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien.
	Donec sagittis massa et leo semper a scelerisque metus faucibus. Morbi congue mattis mi.
	Phasellus sed nisl vitae risus tristique volutpat. Cras rutrum commodo luctus.
</p>

<h3>So in conclusion ...</h3>
<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac quam risus, at tempus
	justo. Sed dictum rutrum massa eu volutpat. Quisque vitae hendrerit sem. Pellentesque lorem felis,
	ultricies a bibendum id, bibendum sit amet nisl. Mauris et lorem quam. Maecenas rutrum imperdiet
	vulputate. Nulla quis nibh ipsum, sed egestas justo. Morbi ut ante mattis orci convallis tempor.
	Etiam a lacus a lacus pharetra porttitor quis accumsan odio. Sed vel euismod nisi. Etiam convallis
	rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien.
	Donec sagittis massa et leo semper a scelerisque metus faucibus. Morbi congue mattis mi.
	Phasellus sed nisl vitae.
</p>
<p>
	Suspendisse laoreet metus ut metus imperdiet interdum aliquam justo tincidunt. Mauris dolor urna,
	fringilla vel malesuada ac, dignissim eu mi. Praesent mollis massa ac nulla pretium pretium.
	Maecenas tortor mauris, consectetur pellentesque dapibus eget, tincidunt vitae arcu.
</p>
<button type="submit" class="btn btn-primary">
	Редактировать
</button>