<?php

class AccuracyController extends BaseController {

    public function getIndex() {

        // init
        $original_accuracy_list = [];
        $accuracy_list = [];

        // get thi accuracy list
        $original_accuracy_list = DB::table('accuracys')->get();
        foreach ($original_accuracy_list as $suffix => $value) {
            $accuracy_list[$value->id] = $value->accuracy;
        }

        header("Access-Control-Allow-Origin: *");
        return Response::json($accuracy_list);
        //echo json_encode($accuracy_list);
    }
}
