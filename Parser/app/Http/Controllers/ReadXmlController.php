<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XmlData;
use Illuminate\Console\Command;

class ReadXmlController extends Controller
{
    static private function foindErrorTipe($item)
    {
        if (Is_array($item['id']))
            return "error id";
        if (Is_array($item['model']))
            return "error model";
        if (Is_array($item['generation']))
            return "error generation";
        if (Is_array($item['year']))
            return "error year";
        if (Is_array($item['run']))
            return "error run";
        if (Is_array($item['color']))
            return "error color";
        if (Is_array($item['body-type']))
            return "error body-type";
        if (Is_array($item['engine-type']))
            return "error engine-type";
        if (Is_array($item['transmission']))
            return "error transmission";
        if (Is_array($item['gear-type']))
            return "error gear-type";
        if (Is_array($item['generation_id']))
            return "error generation_id";

        return 0;
    }

    static private function foindDataBase($item, $dataBas)
    {
        foreach ($dataBas as $index => $itemDataBase) {
            if ((int)$itemDataBase['id'] === (int)$item['id']) {
                unset($item['id']);
                XmlData::where('id', '=', $itemDataBase['id'])->update($item);
                return;
            }
        }
        XmlData::insert($item);
        return;
    }

    static private function deletOldDataBase($phpDataArray, $dataBas)
    {
        foreach ($dataBas as $index => $itemDataBase) {
            $check = true;
            foreach ($phpDataArray['offers'] as $index => $data) {
                foreach ($data as $index => $item) {
                    if ((int)$itemDataBase['id'] === (int)$item['id']) {
                        $check = false;
                        continue;
                    }
                }
            }
            if ($check) {
                XmlData::where('id', '=', $itemDataBase['id'])->delete();
            }
        }
        return;
    }

    static public function index($xmlURL)
    {
        if ($xmlURL == 'Deffolt') {
            $xmlDataString = file_get_contents(public_path('data_light.xml'));
        } else {
            $xmlDataString = file_get_contents($xmlURL);
        }

        $xmlObject = simplexml_load_string($xmlDataString);
        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json, true);

        $dataBase = XmlData::get();

        if (count($phpDataArray['offers']) > 0) {
            foreach ($phpDataArray['offers'] as $index => $data) {
                foreach ($data as $index => $item) {
                    if (ReadXmlController::foindErrorTipe($item) != 0) {
                        echo "ID: " . $item['id'] . "  " . ReadXmlController::foindErrorTipe($item) . "\n";
                        continue;
                    }
                    ReadXmlController::foindDataBase($item, $dataBase);
                }
            }

            ReadXmlController::deletOldDataBase($phpDataArray, $dataBase);
        }
        return;
    }
}
