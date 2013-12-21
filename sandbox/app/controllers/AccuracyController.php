<?php

class AccuracyController extends BaseController {

    public function getIndex() {
        $accuracy_info = [
          "1" => "A",
          "2" => "B",
          "3" => "C",
          "4" => "D",
          "5" => "E",
          "6" => "F"];
    
        header("Access-Control-Allow-Origin: *");
        echo json_encode($accuracy_info);
    }
}
