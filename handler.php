<?php
require_once(__DIR__ . '/crest.php');

    $botCode = 'ActivityBot';
    $botResult = CRest::call('imbot.bot.list');
    $botList = array_column($botResult['result'], 'ID', 'CODE');
    $ID = $botList[$botCode];
    $IDArray = explode(",", iconv("utf-8","windows-1251", $_REQUEST['properties']['ID']));
    $dir = __DIR__ . '/chat/';

    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    file_put_contents($dir . 'chatinfo.txt', var_export($_REQUEST, true), true);

    foreach ($IDArray as $value){
        $value = preg_replace("/\s+/", "", $value);
        $result = CRest::call('imbot.message.add', [
            'BOT_ID' => $ID,
            'DIALOG_ID' => $value,
            'MESSAGE' => $_REQUEST['properties']['Message'],
        ]);
    }

//
//    $dir = __DIR__ . '/chat/';
//
//    if (!file_exists($dir)) {
//        mkdir($dir, 0777, true);
//    }
//
//    file_put_contents($dir . 'chatinfo.txt', var_export($_REQUEST, true), true);
//
//    $result = CRest::call('imbot.message.add', [
//        "DIALOG_ID" => 36,
//        "MESSAGE" => 'Христос воскрес!',
//    ]);
//
//    $message = $_REQUEST['properties']['Message'];
//    $id = $_REQUEST['properties']['DialogId'];
//
////    $arr1 = explode("-", $_REQUEST['properties']['Arr1']);
////    $arr2 = explode("-", $_REQUEST['properties']['Arr2']);
////    $arr3 = explode("-", $_REQUEST['properties']['Arr3']);
////    $arr4 = explode("-", $_REQUEST['properties']['Arr4']);
////    $arr5 = explode("-", $_REQUEST['properties']['Arr5']);
////
////    file_put_contents($dir . 'arrs.txt', var_export([$arr1,$arr2, $arr3, $arr4, $arr5], true), true);
//
//    $DealId = $_REQUEST['document_id'][2];
//    $DealInfo = CRest::call('crm.deal.get', [
//        'id' => intval(trim($DealId, 'DEAL_'))
//    ]);
//
//    $DealContactInfo = CRest::call('crm.deal.contact.items.get', [
//        'id' => intval(trim($DealId, 'DEAL_'))
//    ]);
//    $LeadInfo = CRest::call('crm.lead.get', [
//        'id' => $DealInfo['result']['LEAD_ID']
//    ]);
//
//    $ContactArr = [];
//    for ($i = 0; $i < count($DealContactInfo); $i++) {
//        if ($DealContactInfo['result'][$i]['CONTACT_ID'] != NULL) {
//            $ContactArr[] = $DealContactInfo['result'][$i]['CONTACT_ID'];
//        }
//    }
//    $Contact = [];
//    for ($j = 0; $j < count($ContactArr); $j++) {
//        $Contact[] = CRest::call('crm.contact.list', ["filter" => ["ID" => $ContactArr[$j]]]);
//    }
//
//
//    $CompanyInfo = CRest::call('crm.company.get', [
//        'id' => $DealInfo['result']['COMPANY_ID']
//    ]);
//
//    $InvoiceList = CRest::call('crm.item.list', [
//        'entityTypeId' => 31
//    ]);
//    $InvoiceArr = [];
//    for ($i = 0; $i < count($InvoiceList); $i++) {
//        if ($InvoiceList['result']['result']['items'][$i] != NULL) {
//            if ($InvoiceList['result']['items'][$i]['parentId2'] == trim($DealId, 'DEAL_')) {
//                $InvoiceArr[] = $InvoiceList['result']['items'][$i];
//            }
//        }
//    }
//    file_put_contents($dir . 'deal.txt', var_export($DealInfo, true));
//    file_put_contents($dir . 'comp.txt', var_export($CompanyInfo, true));
//    file_put_contents($dir . 'cont.txt', var_export($Contact, true));
//    file_put_contents($dir . 'lead.txt', var_export($LeadInfo, true));
//    file_put_contents($dir . 'invlist.txt', var_export($InvoiceList, true));
//    file_put_contents($dir . 'invarr.txt', var_export($InvoiceArr, true));
////    switch (in_array($arr1)){
////        case "1":
////            $DealMess .= "  Название: ".$DealInfo['result']['TITLE']."\n";
////
////        case "2":
////            $DealMess .= "  Сумма: ".$DealInfo['result']['OPPORTUNITY']."\n";
////
////        case "3":
////            $DealMess .= "  Валюта: ".$DealInfo['result']['CURRENCY_ID']."\n";
////        case "4":
////            $DealMess .= "  Валюта учета: ".$DealInfo['result']['OPPORTUNITY']."\n";
////        case "5":
////            $DealMess .= "  Ответственный: ".$DealInfo['result']['OPPORTUNITY']."\n";
////        case "6":
////            $DealMess .= "  Стадия: ".$DealInfo['result']['STAGE_ID']."\n";
////        case "7":
////            $DealMess .= "  Тип: ".$DealInfo['result']['TYPE_ID']."\n";
////        case "8":
////            $DealMess .= "  Комментарий: ".$DealInfo['result']['COMMENTS']."\n";
////        case "9":
////            $DealMess .= "  Дата начала: ".$DealInfo['result']['BEGINDATE']."\n";
////        case "10":
////            $DealMess .= "  Контакт: ".$DealInfo['result']['OPPORTUNITY']."\n";
////        case "11":
////            $DealMess .= "  Компания: ".$DealInfo['result']['OPPORTUNITY']."\n";
////        case "12":
////            $DealMess .= "  Источник: ".$DealInfo['result']['SOURCE_ID']."\n";
////        case "13":
////            $DealMess .= "  Дополнительно об источнике: ".$DealInfo['result']['SOURCE_DESCRIPTION']."\n";
////        case "14":
////            $DealMess .= "  Источник сквозной аналитики: ".$DealInfo['result']['OPPORTUNITY']."\n";
////
////    }
//
//    $MessageInput = iconv("utf-8","windows-1251", $_REQUEST['properties']['Message']);
//    $regDeal = '/DEAL_/';
//    $MessageOutput = 'Ошибка!';
//    $DealName = '{{Сделка: Название}}';
//    $DealSum = "{{Сделка: Сумма}}";
//    $DealVal = "{{Сделка: Валюта}}";
//    $DealStage = "{{Сделка: Стадия}}";
//    $DealType = "{{Сделка: Тип}}";
//    $DealComm = "{{Сделка: Комменатрий}}";
//    $DealDate = "{{Сделка: Дата начала}}";
//    $DealCont = "{{Сделка: Контакт}}";
//    $DealComp = "{{Сделка: Компания}}";
//    if (preg_match_all($regDeal, $_REQUEST['document_id']['2'])) {
//        if (stripos($DealName, $MessageInput)) {
//            $MessageOutput = str_replace($DealName, $DealInfo['result']['TITLE'], $MessageInput);
//            file_put_contents($dir . 'test1.txt', '1', true);
//        }
//
//    }
//
//
//    file_put_contents($dir . 'FINAL_OUTPUT.txt', $MessageOutput);
