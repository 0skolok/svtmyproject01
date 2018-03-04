<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search-form">
    <form action="<?=$arResult["FORM_ACTION"]?>">
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="q" value="" size="15" maxlength="50" class="form-control" />
                <span class="input-group-btn">
                    <button type="submit" name="s" class="btn btn-default pull-right"><?=GetMessage("BSF_T_SEARCH_BUTTON");?></button>
                </span>
            </div>
        </div>
    </form>
</div>