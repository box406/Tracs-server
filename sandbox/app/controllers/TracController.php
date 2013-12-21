<?php

class TracController extends BaseController {
    public function getIndex() {

        $tracList = [
            "showBox" => [
                [
                    "trac_id" => "1111111",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],
                [
                    "trac_id" => "22222222",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],
            ],
            "nonCostomersBox" => [
                [
                    "trac_id" => "3333333",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],   
            ],
            "salesBox" => [
                [
                    "trac_id" => "4444444",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],   
            ],
            "orderBox" => [
                [
                    "trac_id" => "555555",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],   
            ],
            "lostBox" => [
                [
                    "trac_id" => "6666666",
                    "charge_parson" => "osaka taro",
                    "trac_name" => "vickey",
                    "accuracys" => ["1" => "A", 
                                    "2" => "B", 
                                    "3" => "C", 
                                    "4" => "D", 
                                    "5" => "E", 
                                    "6" => "F"],
                    "accuracyDefault" => "A"
                ],   
            ],
        ];
        header("Access-Control-Allow-Origin: *");
        echo json_encode($tracList);      
    }

    public function getAddTrac($id) {
        echo "test-" . $id;
    }
}
