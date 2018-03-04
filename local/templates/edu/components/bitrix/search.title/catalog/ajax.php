<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["CATEGORIES"])):?>
    <div class="popover bottom search-title-popover">
        <div class="arrow"></div>
        <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <h3 class="popover-title">
                <?if($category_id === "all"):?>
                    <?$arItem = array_shift($arCategory["ITEMS"]);?>
                    <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                <?else:?>
                    <?=$arCategory["TITLE"]?>
                <?endif;?>
            </h3>

            <?if(count($arCategory["ITEMS"])):?>
                <div class="popover-content">
                    <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                        <div class="media">
                            <?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
                                $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>

                                <?if (is_array($arElement["PICTURE"])):?>
                                <a class="pull-left" href="<?echo $arItem["URL"]?>">
                                    <img class="media-object" src="<?echo $arElement["PICTURE"]["src"]?>" width="<?echo $arElement["PICTURE"]["width"]?>" height="<?echo $arElement["PICTURE"]["height"]?>">
                                </a>
                            <?endif;?>
                                <div class="media-body">
                                    <a class="media-heading" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                                    <span class="title-search-preview"><?echo $arElement["PREVIEW_TEXT"];?></span>
                                    <?foreach($arElement["PRICES"] as $code=>$arPrice):?>
                                        <?if($arPrice["CAN_ACCESS"]):?>
                                            <small class="title-search-price"><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
                                                <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                    <b><?=$arPrice["PRINT_VALUE"]?></b>&nbsp;<b class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></b>
                                                <?else:?>
                                                    <b class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></b>
                                                <?endif;?>
                                            </small>
                                        <?endif;?>
                                    <?endforeach;?>
                                </div>

                            <?elseif(isset($arItem["ICON"])):?>
                                <div class="media-body">
                                    <i class="glyphicon glyphicon-chevron-right fa fa-chevron-right"></i>&nbsp;<a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                                </div>
                            <?else:?>
                                <div class="media-body">
                                    <i class="glyphicon glyphicon-th-list fa fa-th-list"></i>&nbsp;<a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                                </div>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                </div>
            <?endif;?>
        <?endforeach;?>
    </div>
    </div>
<?endif;
//echo "<pre>",htmlspecialcharsbx(print_r($arResult,1)),"</pre>";
?>