<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function index(){

        $numberRange = range(1,100);
        $dataSet = [];
        foreach($numberRange as $k => $v){
            
            if($v % 3 == 0 && $v % 5 == 0){
                $dataSet[] = 'ThreeFive'; 
            }else if($v % 3 == 0){
                $dataSet[] = 'Three';
            }else if($v % 5 == 0){
                $dataSet[] = 'Five';
            }else{
                $dataSet[] = $v;
            }          
        }       

        return view('welcome',compact('dataSet'));
    }

    function calculateArray(Request $request){
        $input = $request->all();
        $arr = [];
        if(isset($input['nums'])){
            $arr = explode(',',$input['nums']);

            $sum = 0;
            $indexLabel = [];
           
            $IndexValue = false;
            for($i = 0; $i < count($arr); $i++){               
                for($j = $i + 1; $j < count($arr); $j++ ){
                    $sum = $arr[$i] + $arr[$j];

                    if($sum == $input['sum'] ){  
                        $IndexValue = true;                     
                        $indexLabel = $i.','.$j;                     
                    }           
                         
                }
            } 

            if($IndexValue){
                $html = '
                    <h2>Output : '.$indexLabel.'</h2>
                ';  
            }else{
                $html = '
                    <h2>Output : no output</h2>
                ';
            }

            return json_encode(['success' => true, 'result' => $html ]);  
        }else{
            return json_encode(['success' => false,'result' => 'กรุณากรอกข้อมูลให้ถูกต้อง' ]);  
        }

    }
}
