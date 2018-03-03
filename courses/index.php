<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курсы");
LocalRedirect('/courses/catalog/', true);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>