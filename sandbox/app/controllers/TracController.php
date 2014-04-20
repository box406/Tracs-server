<?php

class TracController extends BaseController {

    public function getIndex() {

        // init
        $trac_info = [];
        $trac_list = [];

        // get trac list
        $trac_list = DB::table('trac_areas')->select('trac_area')->get();
        foreach ($trac_list as $suffix => $value) {
            $trac_info[$value->trac_area] = [];
        } 

        // get database from accuracys & shaping 
        $original_accuracy_list = DB::table('accuracys')->get();
        foreach ($original_accuracy_list as $suffix => $value) {
            $accuracy_list["accuracy"][$value->id] = $value->accuracy;
        }

        // get database from tracs
        $original_trac_info = DB::table('tracs')->join('members', 'tracs.member_id', '=', 'members.id')
                                                ->join('accuracys', 'tracs.accuracy_id', '=', 'accuracys.id')
                                                ->join('trac_areas', 'tracs.status', '=', 'trac_areas.id')
                                                ->orderBy('tracs.number')
                                                ->orderBy('tracs.updated', 'desc')
                                                ->get();
 
        // shaping $trac_info
        foreach($original_trac_info as $suffix => $value) {
            $trac_info[$value->trac_area][] = [
                "trac_id" => $value->trac_id,
                "charge_member" => $value->section . " " . $value->name,
                "trac_name" => $value->trac_name,
                "accuracys" => $accuracy_list["accuracy"],
                "accuracyDefault" => $value->accuracy
            ];
        }

        // json return
        header("Access-Control-Allow-Origin: *");
        return Response::json($trac_info);
    }

    public function postAddTrac() {

        // get the next number
        $number = DB::table('tracs')->where('status', '=', 1)->max('number');
        if (is_null($number) === true) {
            $number = 1;
        } else {
            $number++;
        }

        DB::table('tracs')->insert(
            array( 
                "trac_id" => Input::json("trac_id"),
                "status" => 1,
                "trac_name" => Input::json("trac_name"),
                "number" => $number,
                "member_id" => Input::json("member_id"),
                "accuracy_id" => Input::json("accuracy_id"),
                "client_id" => Input::json("client_id"),
                "created" => date("Y-m-d H:i:s"),
                "updated" => date("Y-m-d H:i:s")      
            )
        );

        header("Access-Control-Allow-Origin: *");
        return Response::json("respons ok"); 
    }

    public function postMove() {

        if (Input::json("receive")) {
            $trac_area = Input::json("receive");
        } else {
            $trac_area = Input::json("start");
        }
        
        // get trac_areas id
        $trac_area = DB::table('trac_areas')->select('id')->where("trac_area", "=", $trac_area)->first();

        // get the trac max number
        $max_number = DB::table('tracs')->where("status", "=", $trac_area->id)->max('number');
        $number = Input::json("index");
        if ($max_number == $number) {
            $number++;
        }

        DB::table('tracs')
          ->where("trac_id", "=", Input::json("trac_id"))
          ->update(
            array(
              "status" => $trac_area->id,
              "number" => $number,
              "updated" => date("Y-m-d H:i:s")
            )
          );

        header("Access-Control-Allow-Origin: *");
        return Response::json("respons ok"); 
    }
}
