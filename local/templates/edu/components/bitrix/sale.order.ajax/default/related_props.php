<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");?>

<?if(is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])):?>
<div class="sale-order-ajax-props">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><?=GetMessage("SOA_TEMPL_RELATED_PROPS")?></h4>
		</div>
		<div class="panel-body">
			<div class="form-horizontal">
				<?PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"])?>
			</div>
		</div>
	</div>
</div>
<?endif?>
