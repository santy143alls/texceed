<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Exception;
use Illuminate\Http\Request;
use DB;
use Log;

class AdmissionController extends Controller
{
    //
    public function index(){
        
        return view('Admissions.index');
    }

    public function create(Request $request){
        try{
            DB::beginTransaction();
            $return = [
                'status' => 'fail',
                'msg' => 'Unable to create admission'
            ];
            $data = $request->all();
            unset($data['_token']);
            $admission = new Admission();
            $admission->fill($data);
            if(!$admission->save()){
                return $return;
            }
            $return = [
                'status' => 'success',
                'msg' => 'Admission created successfully.'
            ];
            DB::commit();
            return $return;
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
            Log::error('create : '.$e->getMessage());
            return $return;
        }
    }

    public function allAdmissions(Request $request){
        try{
            $req = $request->all();
            $return = [
                'status' => 'fail',
                'msg' => 'Unable to create admission'
            ];
            $admissions = Admission::select('*')->addSelect(DB::raw('Concat(fname, " ",mname, " ", lname ) as student_name'));
 
            $return['recordsTotal'] = $admissions->count();
            $return['recordsFiltered'] = $return['recordsTotal'];

            if( isset($req["search"]["value"]) && $search_key = trim($req["search"]["value"]) ) {
                $whereStr = sprintf('(fname like "%%%1$s%%" or email like "%%%1$s%%" or phone like "%%%1$s%%" or course like "%%%1$s%%" )', $search_key);
                $admissions->whereRaw($whereStr);
                $return['recordsFiltered'] = $admissions->count();
            }
            $page = 1;
            $skip = 0;
            $take = 10;
            if( isset($req["start"]) && isset($req["length"]) ) {
                $skip = (int) $req["start"];
                $take = (int) $req["length"];
            }

            $admissions->skip($skip);
            $admissions->take($take);
            $data = $admissions->get();

            $return['status'] = 'success';
            $return['msg'] = 'Admissions fetched successfully';
            $return['data'] = $data;
            return $return;
        }catch(Exception $e){
            dd($e);
            Log::error('allAdmission() : '.$e->getMessage());
            return $return;
        }
    }
}
