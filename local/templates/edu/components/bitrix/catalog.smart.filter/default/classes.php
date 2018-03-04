<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * Class CSmartFilterItem вывод фильтров по свойствам
 */
abstract class CSmartFilterItem
{
	/**
	 * Проверить доступность фильтра по свойству для вывода.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 *
	 * @return boolean
	 */
	abstract protected static function _CheckVisible($arSmartFilterItem);

	/**
	 * Вывести фильтр по свойству.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 * @param array $arParams параметры компонента
	 *
	 * @return
	 */
	abstract protected static function _Show($arSmartFilterItem, $arParams = array());

	/**
	 * Показать начало фильтра по свойству.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 */
	protected static function _ShowPrologue($arSmartFilterItem)
	{
		?>
		<div class="form-group">
		<label><a href="javascript:void(0)"><?= $arSmartFilterItem["NAME"] ?></a></label>
		<div class="filter-content">
	<?
	}

	/**
	 * Показать конец фильтра по свойству.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 */
	protected static function _ShowEpilogue($arSmartFilterItem)
	{
		?>
		</div>
		</div>
	<?
	}

	/**
	 * Показать, если необходимо, фильтр по свойству.
	 *
	 * @param array $arSmartFilterItem
	 * @param array $arParams параметры компонента
	 */
	public static function Show($arSmartFilterItem, $arParams = array())
	{
		if (static::_CheckVisible($arSmartFilterItem))
		{
			static::_ShowPrologue($arSmartFilterItem);
			static::_Show($arSmartFilterItem, $arParams);
			static::_ShowEpilogue($arSmartFilterItem);
		}
	}
}

/**
 * Class CSmartFilterRangeItem вывод слайдера
 */
class CSmartFilterRangeItem extends CSmartFilterItem
{
	/**
	 * Проверить доступность фильтра по свойству для вывода.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 *
	 * @return boolean
	 */
	protected static function _CheckVisible($arSmartFilterItem)
	{
		$bHasMinValue = strlen($arSmartFilterItem["VALUES"]["MIN"]["VALUE"]) > 0;
		$bHasMaxValue = strlen($arSmartFilterItem["VALUES"]["MAX"]["VALUE"]) > 0;
		$bHasDifferentMinAndMax = $arSmartFilterItem["VALUES"]["MIN"]["VALUE"] != $arSmartFilterItem["VALUES"]["MAX"]["VALUE"];
		return $bHasMinValue && $bHasMaxValue && $bHasDifferentMinAndMax;
	}

	/**
	 * Получить величину шага для диапазона данных при известном количестве шагов.
	 *
	 * @param float $min минимальное значение диапазона
	 * @param float $max максимальное значение диапазона
	 * @param int $steps количество шагов
	 *
	 * @return bool|int количество шагов или FALSE, если разбивка на шаги не требуется
	 */
	protected static function _GetStepSize($min, $max, $steps)
	{
		if (strlen($steps) == 0)
		{
			return 1;
		}
		$delta = ceil($max) - floor($min); // Разбег значений
		if ($delta * 2 < $steps)
		{
			return 1;
		} else
		{
			return ceil($delta / $steps);
		}
	}

	/**
	 * Вывести фильтр по свойству.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 * @param array $arParams параметры компонента
	 */
	protected static function _Show($arSmartFilterItem, $arParams = array())
	{
		?>
		<!--noindex-->
		<div class="row">
			<div class="col-md-6">
				<div class="input-group input-group-sm">
					<span class="input-group-addon"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></span>
					<input
						type="text"
						class="form-control slider-value slider-min-value"
						name="<?= $arSmartFilterItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
						id="<?= $arSmartFilterItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
						value="<?= $arSmartFilterItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
						placeholder="<?= floor($arSmartFilterItem["VALUES"]["MIN"]["VALUE"]) ?>"
						/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group input-group-sm">
					<span class="input-group-addon"><?= GetMessage("CT_BCSF_FILTER_TO") ?></span>
					<input
						type="text"
						class="form-control slider-value slider-max-value pull-right"
						name="<?= $arSmartFilterItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
						id="<?= $arSmartFilterItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
						value="<?= $arSmartFilterItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
						placeholder="<?= ceil($arSmartFilterItem["VALUES"]["MAX"]["VALUE"]) ?>"
						/>
				</div>
			</div>
		</div>
		<div class="slider-price">
			<div
				class="slider-range"
				data-min="<?= floor($arSmartFilterItem["VALUES"]["MIN"]["VALUE"]) ?>"
				data-max="<?= ceil($arSmartFilterItem["VALUES"]["MAX"]["VALUE"]) ?>"
				data-step="<?= static::_GetStepSize($arSmartFilterItem["VALUES"]["MIN"]["VALUE"], $arSmartFilterItem["VALUES"]["MAX"]["VALUE"], $arParams["SLIDER_STEPS"]) ?>"></div>
		</div>
		<!--/noindex-->
	<?
	}
}

/**
 * Class CSmartFilterCheckboxesItem вывод слайдера
 */
class CSmartFilterCheckboxesItem extends CSmartFilterItem
{
	/**
	 * Проверить доступность фильтра по свойству для вывода.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 *
	 * @return boolean
	 */
	protected static function _CheckVisible($arSmartFilterItem)
	{
		return TRUE;
	}

	/**
	 * Вывести фильтр по свойству.
	 *
	 * @param array $arSmartFilterItem элемент массива ITEMS умного фильтра
	 * @param array $arParams параметры компонента
	 */
	protected static function _Show($arSmartFilterItem, $arParams = array())
	{
		?>
		<? foreach ($arSmartFilterItem["VALUES"] as $arValue): ?>
		<div class="checkbox">
			<label>
				<input
					type="checkbox"
					value="<? echo $arValue["HTML_VALUE"] ?>"
					name="<? echo $arValue["CONTROL_NAME"] ?>"
					id="<? echo $arValue["CONTROL_ID"] ?>"
					<? echo $arValue["CHECKED"] ? 'checked="checked"' : '' ?>
					onclick="smartFilterBootstrap.click(this)"
					<? if ($arValue["DISABLED"]): ?>disabled<? endif ?>
					/> <? echo $arValue["VALUE"] ?>
			</label>
		</div>
	<? endforeach ?>
	<?
	}
}