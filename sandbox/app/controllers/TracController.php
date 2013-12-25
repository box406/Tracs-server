<?php

class TracController extends BaseController {

    public function getIndex() {

        // get database from tracs
        $original_trac_info = DB::table('tracs')->join('members', 'tracs.member_id', '=', 'members.id')
                                                ->join('accuracys', 'tracs.accuracy_id', '=', 'accuracys.id')
                                                ->join('trac_areas', 'tracs.status', '=', 'trac_areas.id')
                                                ->get(); 
        
        // get database from accuracys 
        $original_accuracy_list = DB::table('accuracys')->get();
        $accuracy_list = [];
        foreach ($original_accuracy_list as $suffix => $value) {
            $accuracy_list["accuracy"][$value->id] = $value->accuracy;
        }

        // shaping
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

    public function getAddTrac($id) {
        echo "test-" . $id;
    }
}
