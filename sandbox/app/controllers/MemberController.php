<?php

class MemberController extends BaseController {

    public function getIndex() {
        $parson_list = [
            "1" => "営業1課 小田 和久",
            "2" => "営業1課 横尾 結子",
            "3" => "営業1課 小笠原 沙知絵",
            "4" => "営業1課 平田 米蔵",
            "5" => "営業2課 国分 春樹",
            "6" => "営業2課 立川 花緑",
            "7" => "営業2課 宮川 光洋",
            "8" => "営業2課 浜田 明宏"
        ];

        header("Access-Control-Allow-Origin: *");
        echo json_encode($parson_list);
    }
}
