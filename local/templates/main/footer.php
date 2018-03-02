<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
	</div>
</div>
<!-- Footer -->
<footer id="footer" class="container">
	<div class="row 200%">
		<div class="12u">

			<!-- About -->
			<section>
				<h2 class="major"><span>О сервисе</span></h2>
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
			</section>

		</div>
	</div>

	<!-- Copyright -->
	<div id="copyright">
		<ul class="menu">
			<li>&copy; Untitled. All rights reserved</li>
		</ul>
	</div>

</footer>

</div>
</body>
</html>
