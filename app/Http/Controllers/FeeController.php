<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeShip;
use App\City;
use App\Ward;
use App\Province;

class FeeController extends Controller
{
    public function index() {
        $citys= City::all();
        return view('admin.fee.feeindex', compact('citys'));
    }

    public function loadFee(){
        $loadFeeTable = FeeShip::orderby('fee_id', 'ASC')->get();
        $loadData ='';
        $loadData .='<div class="table-resposive">
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                                <th>Tên thành phố</th>
                                <th>Tên quận huyện</th>
                                <th>Tên xã phường</th>
                                <th>Phí vận chuyển</th>
                            </tr>
                        </thread>
                        <tbody>
                        ';
                        foreach($loadFeeTable as $fee){
                             $loadData .='
                                <tr>
                                    <td>'.$fee->city->name_city.'</td>
                                    <td>'.$fee->province->name_province.'</td>
                                    <td>'.$fee->ward->name_ward.'</td>
                                    <td contenteditable data-fee_id="'.$fee->fee_id.'" class="edit">'.$fee->fee_ship.'</td>
                                </tr>
                             ';
                        }
                        $loadData .='
                        </tbody>
                        </table></div>
                        ';
                       
        return $loadData;
    }

    public function addFee(Request $request) {
        $inputData = $request->all();
        
        $insertFee = FeeShip::create([
            'fee_cityid'=> $inputData['idCity'],
            'fee_provinceid'=> $inputData['idProvince'],
            'fee_wardid'=> $inputData['idWard'],
            'fee_ship'=> $inputData['fee'],
        ]);
    }

    public function updateFee(Request $request){
        $inputData = $request->all();
         \Log::info($inputData);
        $fee = FeeShip::where('fee_id',$inputData['idFee'])->first();

        $updateFee = $fee->update([
            'fee_ship'=> $inputData['feeShip'],
        ]);
    }

    public function ajaxFee(Request $request) {
        $selectData = $request->all();
        \Log::info($selectData['nameSelect']);
        
        if($selectData['nameSelect']){
            $setOpiton='';
            if($selectData['nameSelect']=='city'){
                $selectDataProvinces = Province::where('id_city', $selectData['idOption'])->orderby('id_province','ASC')->get();
               
                $setOpiton ='<option value="" >---- Chọn Quận-Huyện ----</option>';
                foreach($selectDataProvinces as $selectDataProvince){
                    $setOpiton .= '<option value="' .$selectDataProvince->id_province .'">'.$selectDataProvince->name_province.'</option>';
                }
              
            }else {
                $selectDataWards = Ward::where('id_province', $selectData['idOption'])->orderby('id_ward','ASC')->get();
                $setOpiton ='<option value="" >--- Chọn Xã-Phường ---</option>';
                foreach($selectDataWards as $selectDataWard){
                    $setOpiton .= '<option value="' .$selectDataWard->id_ward .'">'.$selectDataWard->name_ward.'</option>';
                }
            }
        };
        echo $setOpiton;
    }
}
