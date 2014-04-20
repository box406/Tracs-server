<?php

class MemberController extends BaseController {

    public function getIndex() {

        // init
        $original_members_list = [];
        $members_list = [];

        // get the members
        $original_members_list = DB::table('members')->get();

        // shaping
        foreach($original_members_list as $suffix => $value) {
            $members_list[$value->id] = $value->section . " " . $value->name;
        }

        header("Access-Control-Allow-Origin: *");
        return Response::json($members_list);
    }
}
