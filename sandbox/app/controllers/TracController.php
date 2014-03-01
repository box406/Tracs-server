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

        // get database from tracs
        $original_trac_info = DB::table('tracs')->join('members', 'tracs.member_id', '=', 'members.id')
                                                ->join('accuracys', 'tracs.accuracy_id', '=', 'accuracys.id')
                                                ->join('trac_areas', 'tracs.status', '=', 'trac_areas.id')
                                                ->get(); 
        
        // get database from accuracys & shaping 
        $original_accuracy_list = DB::table('accuracys')->get();
        
        foreach ($original_accuracy_list as $suffix => $value) {
            $accuracy_list["accuracy"][$value->id] = $value->accuracy;
        }

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

        DB::table('tracs')->insert(
            array( 
                "trac_id" => Input::json("trac_id"),
                "status" => 1,
                "trac_name" => Input::json("trac_name"),
                "member_id" => Input::json("member_id"),
                "accuracy_id" => Input::json("accuracy_id"),
                "client_id" => Input::json("client_id")      
            )
        );

        header("Access-Control-Allow-Origin: *");
        return Response::json("respons ok"); 
    }
}
