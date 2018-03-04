<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<form action="<?echo $arResult["FORM_ACTION"]?>" id="<?echo $CONTAINER_ID?>">
        <div class="input-group">
            <input id="<?echo $INPUT_ID?>" class="form-control" type="text" name="q" value="" maxlength="50" autocomplete="off" placeholder="<?=GetMessage("CT_BST_SEARCH_BUTTON")?>" />
            <span class="input-group-btn">
                <button type="submit" name="s" class="btn btn-default">
                    <i class="glyphicon glyphicon-search fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
<?endif?>
<script type="text/javascript">
    $(function() {
        var jsControl = new JCTitleSearch({
            //'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
            'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
            'INPUT_ID': '<?echo $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    });
</script>
