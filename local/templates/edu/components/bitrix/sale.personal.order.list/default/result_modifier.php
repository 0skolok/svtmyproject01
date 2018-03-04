<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($_REQUEST["filter_canceled"] == "Y" && $_REQUEST["filter_history"] == "Y") {
	$arResult['PAGE'] = "canceled";
} elseif($_REQUEST["filter_status"] == "F" && $_REQUEST["filter_history"] == "Y") {
	$arResult['PAGE'] = "completed";
} elseif($_REQUEST["show_all"] == "Y") {
	$arResult['PAGE'] = "all";
} else {
	$arResult['PAGE'] = "active";
}

//Lets count orders by status to show in tabs
$arStatusCount = array(
    "N" => 0,   //New order
    "P" => 0,   //Order paid, ready to send
    "F" => 0,   //Order success
    "C" => 0,   //Order canceled
    "A" => 0,    //All active orders
    "T" => 0,    //All orders
);

$db_sales = CSaleOrder::GetList(array("ID"=>"DESC"), array("USER_ID" => $USER->GetID(),"LID" => SITE_ID));
while ($arItem = $db_sales->Fetch()) {
    $arStatusCount["T"]++;
    if($arItem["CANCELED"] == "Y") {
        $arStatusCount["C"]++;
    } else if($arItem["STATUS_ID"] == "N") {
        $arStatusCount["N"]++;
    } else if($arItem["STATUS_ID"] == "P") {
        $arStatusCount["P"]++;
    } else if($arItem["STATUS_ID"] == "F") {
        $arStatusCount["F"]++;
    }
}
$arStatusCount["A"] = $arStatusCount["N"]+$arStatusCount["P"];
$arResult["ORDERS_STATUS_COUNT"] = $arStatusCount;



//Colorizing orders
foreach($arResult["ORDERS"] as &$arItem) {
    switch ($arItem["ORDER"]["STATUS_ID"]) {
        case "N":
            $arItem["STATUS_CLASS"] = 'label label-warning order-status';
            break;
        case "P":
            $arItem["STATUS_CLASS"] = 'label label-success order-status';
            break;
        case "F":
            $arItem["STATUS_CLASS"] = 'label label-info order-status';
            break;
        default:
            $arItem["STATUS_CLASS"] = 'label label-default order-status';
    }
    if($arItem["ORDER"]["CANCELED"] == "Y") {
        $arItem["STATUS_CLASS"] = 'label label-danger order-status';
    }
    //dump($arItem);
}
