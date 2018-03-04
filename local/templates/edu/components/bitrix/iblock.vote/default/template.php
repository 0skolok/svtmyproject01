<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//Let's determine what value to display: rating or average ?
if($arParams["DISPLAY_AS_RATING"] == "vote_avg")
{
	if($arResult["PROPERTIES"]["vote_count"]["VALUE"])
		$DISPLAY_VALUE = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"]/$arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
	else
		$DISPLAY_VALUE = 0;
} else $DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];

$votesCount = intval($arResult["PROPERTIES"]["vote_count"]["VALUE"]);


if(isset($_REQUEST["AJAX_CALL"]) && $_REQUEST["AJAX_CALL"]=="Y")
{
    $APPLICATION->RestartBuffer();

    die(json_encode( array(
            "value" => $DISPLAY_VALUE,
            "votes" => $votesCount,
            "id" => $arResult["ID"]
        )
    ));
}?>

<div class="iblock-vote" id="vote-<?=$arResult["ID"]?>">
    <?if($arResult["VOTED"] || $arParams["READ_ONLY"]==="Y"):
        if($DISPLAY_VALUE):
            foreach($arResult["VOTE_NAMES"] as $i=>$name):
                if(round($DISPLAY_VALUE) > $i):
                    ?><span class="glyphicon glyphicon-star fa fa-star" title="<?=$name?>"></span><?
                else:
                    ?><span class="glyphicon glyphicon-star-empty fa fa-star-o" title="<?=$name?>"></span><?
                endif;
            endforeach;
        else:
            foreach($arResult["VOTE_NAMES"] as $i=>$name):
                ?><span class="glyphicon glyphicon-star-empty fa fa-star-o" title="<?=$name?>"></span><?
            endforeach;
        endif;?>
    <?else:?>
        <div class="rating-enabled">
            <input type="hidden" id="vote-params-<?=$arResult["ID"]?>" value="<?=$arResult["AJAX_PARAMS"]?>">
            <?if($DISPLAY_VALUE):
                foreach($arResult["VOTE_NAMES"] as $i=>$name):
                    if(round($DISPLAY_VALUE) > $i):
                        ?><span data-id="<?=$arResult["ID"]?>" data-rating="<?=$i?>" class="glyphicon glyphicon-star fa fa-star" title="<?=$name?>"></span><?
                    else:
                        ?><span data-id="<?=$arResult["ID"]?>" data-rating="<?=$i?>" class="glyphicon glyphicon-star-empty fa fa-star-o" title="<?=$name?>"></span><?
                    endif;
                endforeach;
            else:
                foreach($arResult["VOTE_NAMES"] as $i=>$name):
                    ?><span data-id="<?=$arResult["ID"]?>" data-rating="<?=$i?>" class="glyphicon glyphicon-star-empty fa fa-star-o" title="<?=$name?>"></span><?
                endforeach;
            endif;?>
        </div>
    <?endif;?>
</div>
