<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="sale-personal-order-list">

	<ul class="nav nav-tabs">
		<li <?if($arResult['PAGE'] == "active") echo 'class="active"'?>><a href="<?=$arResult["CURRENT_PAGE"]."?filter_history=N"?>"><?=GetMessage("STPOL_F_ACTIVE")?> <span class="label label-primary"><?=$arResult["ORDERS_STATUS_COUNT"]["A"] ?></span></a></li>
		<li <?if($arResult['PAGE'] == "all") echo 'class="active"'?>><a href="<?=$arResult["CURRENT_PAGE"]."?show_all=Y"?>"><?=GetMessage("STPOL_F_ALL")?> <span class="label label-default"><?=$arResult["ORDERS_STATUS_COUNT"]["T"] ?></span></a></li>
		<li <?if($arResult['PAGE'] == "completed") echo 'class="active"'?>><a href="<?=$arResult["CURRENT_PAGE"]."?filter_status=F&filter_history=Y"?>"><?=GetMessage("STPOL_F_COMPLETED")?> <span class="label label-default"><?=$arResult["ORDERS_STATUS_COUNT"]["F"] ?></span></a></a></li>
		<li <?if($arResult['PAGE'] == "canceled") echo 'class="active"'?>><a href="<?=$arResult["CURRENT_PAGE"]."?filter_canceled=Y&filter_history=Y"?>"><?=GetMessage("STPOL_F_CANCELED")?> <span class="label label-default"><?=$arResult["ORDERS_STATUS_COUNT"]["C"] ?></span></a></li>
	</ul>

    <?foreach($arResult["ORDERS"] as $order):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12"><h3 class="panel-title"><?=GetMessage("STPOL_ORDER_NO")?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?>&nbsp;<?=GetMessage("STPOL_FROM")?>&nbsp;<?=$order["ORDER"]["DATE_INSERT"]; ?></h3></div>
                    <div class="col-lg-3 col-md-4 col-sm-4 hidden-xs"><a title="<?=GetMessage("STPOL_DETAIL")?>" href="<?=$order["ORDER"]["URL_TO_DETAIL"] ?>"><?=GetMessage("STPOL_DETAIL")?></a></div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row order-info">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                        <strong><?=GetMessage("STPOL_SUM")?></strong>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                        <span><?=$order["ORDER"]["FORMATED_PRICE"]?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="row order-info">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                        <strong><?=GetMessage("STPOL_PAYED")?></strong>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                        <span><?echo (($order["ORDER"]["PAYED"]=="Y") ? GetMessage("STPOL_Y") : GetMessage("STPOL_N"));?></span>
                                    </div>
                                </div>
                            </div>
                            <?if(intval($order["ORDER"]["PAY_SYSTEM_ID"])>0):?>
                                <div class="col-xs-12">
                                    <div class="row order-info">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                            <strong><?=GetMessage("P_PAY_SYS") ?></strong>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                            <span><?=$arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]]["NAME"] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if(intval($order["ORDER"]["DELIVERY_ID"])>0 || (strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false)):?>
                                <div class="col-xs-12">
                                    <div class="row order-info">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                                <strong><?=GetMessage("P_DELIVERY") ?></strong>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                            <span>
                                            <?if(intval($order["ORDER"]["DELIVERY_ID"])>0){
                                                echo($arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]]["NAME"]);
                                            } elseif (strpos($order["ORDER"]["DELIVERY_ID"], ":") !== false) {
                                                $arId = explode(":", $order["ORDER"]["DELIVERY_ID"]);
                                                echo $arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["NAME"]." (".$arResult["INFO"]["DELIVERY_HANDLERS"][$arId[0]]["PROFILES"][$arId[1]]["TITLE"].")";
                                            }?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if(strlen($order["ORDER"]["TRACKING_NUMBER"]) > 0):?>
                                <div class="col-xs-12">
                                    <div class="row order-info">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                            <strong><?=GetMessage("P_ORDER_TRACKING_NUMBER")?></strong>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
                                            <span><?=$order["ORDER"]["TRACKING_NUMBER"] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><?=GetMessage("STPOL_CONTENT")?></strong>
                                        <ul class="mdash order-content">
                                            <?foreach($order["BASKET_ITEMS"] as $OrderItem):?>
                                                <li>
                                                    <?if (strlen($OrderItem["DETAIL_PAGE_URL"]) > 0):?>
                                                        <a href="<?=$OrderItem["DETAIL_PAGE_URL"]?>"><?=$OrderItem["NAME"]?></a>
                                                    <?else:?>
                                                        <?=$OrderItem["NAME"]?>
                                                    <?endif;?>
                                                    &mdash; <?=$OrderItem["QUANTITY"]?> <?=(isset($OrderItem["MEASURE_TEXT"]) ? $OrderItem["MEASURE_TEXT"] : GetMessage("STPOL_SHT"))?>
                                                </li>
                                            <?endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <?if ($order["ORDER"]["CANCELED"] == "Y"):?>
                                    <?=$order["ORDER"]["DATE_CANCELED"]?>
                                <?else:?>
                                    <?=$order["ORDER"]["DATE_STATUS"]?>
                                <?endif;?>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <?if ($order["ORDER"]["CANCELED"] == "Y"):?>
                                    <span class="<?=$order['STATUS_CLASS']?>"><?=GetMessage("STPOL_CANCELED");?></span>
                                <?else:?>
                                    <span class="<?=$order['STATUS_CLASS']?>"><?=$arResult["INFO"]["STATUS"][$order["ORDER"]["STATUS_ID"]]["NAME"]?></span>
                                <?endif;?>
                            </div>
                            <div class="col-xs-12">
                                <div>
                                    <?if ($order["ORDER"]["PAYED"] != "Y" && $order["ORDER"]["CANCELED"]!="Y"):?>
                                        <a class="btn btn-primary order-action" target="_blank" href="<?=$arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$order["ORDER"]["ID"]?>"><?=GetMessage("STPOL_REPAY")?></a>
                                    <?endif;?>
                                    <?if ($order["ORDER"]["CANCELED"] != "Y" && $order["ORDER"]["CAN_CANCEL"] == "Y"):?>
                                        <a class="btn btn-default order-action" title="<?= GetMessage("STPOL_CANCEL") ?>" href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>"><?= GetMessage("STPOL_CANCEL") ?></a>
                                    <?endif;?>
                                    <a class="btn btn-default order-action" title="<?= GetMessage("STPOL_REORDER") ?>" href="<?=$order["ORDER"]["URL_TO_COPY"]?>"><?= GetMessage("STPOL_REORDER1") ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer visible-xs text-center"><a title="<?=GetMessage("STPOL_DETAIL")?>" href="<?=$order["ORDER"]["URL_TO_DETAIL"] ?>"><?=GetMessage("STPOL_DETAIL")?></a></div>
        </div>
    <?endforeach;

    if (count($arResult["ORDERS"]) == 0) {
        echo ShowNote(GetMessage("STPOL_NO_ORDERS_NEW"));
    }

    if(strlen($arResult["NAV_STRING"]) > 0) {
        echo $arResult["NAV_STRING"];
    }?>
</div>