<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-order-ajax-confirm">

    <?if ($arResult["ORDER"]):?>
        <?=ShowNote(GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"])), 'success')?>
        <p><?=GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"]))?></p>
        <p><?=GetMessage("SOA_TEMPL_ORDER_SUC_PASS", Array("#forgot_url#" => $arParams["PATH_TO_AUTH"].'?forgot_password=yes'))?></p>
        <? if ($arResult["PAY_SYSTEM"]): ?>
            <h2><?=GetMessage("SOA_TEMPL_PAY")?></h2>
            <p><?=GetMessage("SOA_PAY_TYPE")?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?></p>
        <? endif ?>
        <? if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0): ?>
            <? if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y"): ?>
                <script language="JavaScript">
                    window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
                </script>
                <p><?= GetMessage("SOA_TEMPL_PAY_LINK")?></p>
                <div class="row">
                    <div class="col-md-2">
                        <? if ($arResult["PAY_SYSTEM"]["LOGOTIP"]): ?>
                            <img src="<?=$arResult["PAY_SYSTEM"]["LOGOTIP"]["SRC"]?>" title="<?=$arResult["PAY_SYSTEM"]["NAME"]?>"/>
                        <? else: ?>
                            <img src="<?=$templateFolder?>/images/logo-default-ps.gif" title="<?=$arResult["PAY_SYSTEM"]["NAME"]?>"/>
                        <?endif ?>
                    </div>
                    <div class="col-md-10">
                        <a href="<?=$arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>" target="_blank" class="btn btn-primary btn-lg"><?=GetMessage("SOA_TEMPL_PAY_ACTION")?></a>
                    </div>
                </div>
            <? else: ?>
                <? if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0): ?>
                    <?include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])?>
                <? endif ?>
            <?endif ?>
        <? endif ?>
    <?else:?>
        <?echo ShowError(GetMessage("SOA_TEMPL_ERROR_ORDER"));
        $orderID = $arResult["ORDER_ID"];
        if (!$orderID) {
            $orderID = $_REQUEST["ORDER_ID"];
        }

        $message = GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $orderID)).GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1");
        echo ShowNote( $message );?>
    <?endif ?>

</div>