<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<? if ($isMainPage): ?>
	<!-- Features Section -->
	<div class="row">
		<div class="col-lg-6">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/include/pages/main/before-footer-text.php"
				)
			); ?>
		</div>
		<div class="col-lg-6">
			<? $APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/include/pages/main/before-footer-image.php"
				)
			); ?>
		</div>
	</div>
	<!-- /.row -->

	<hr>

	<!-- Call to Action Section -->
	<div class="row mb-4">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/pages/main/before-footer-subscribe.php"
			)
		); ?>
	</div>
<? endif; ?>
</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/text-footer.php"
			)
		); ?>
	</div>
	<!-- /.container -->
</footer>

</body>

</html>