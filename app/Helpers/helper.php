<?php

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


function paginate(object $getData, $page_no, $no_of_data = 10){
    $status = 1;
    $message = 'success';
    $response_code = 200;
    $data = [];
    $response = [];

    if(!empty($page_no)){
        $order_total = $getData->count();
        $offset = ($page_no * $no_of_data) - $no_of_data;
        $getData = $getData->offset($offset)->limit($no_of_data)->get();
        $page_limit = ceil($order_total / $no_of_data);

        $data  = $getData;
        $response = [
            'status'    => $status,
            'message'   => $message,
            'data'      => $data,
            'total_data' => $order_total,
            'total_page'=>  $page_limit,
            'per_page'  =>  $no_of_data
        ];
    }else{
        $getData = $getData->get();
        $data  = $getData;
        $response = [
            'status'    => $status,
            'message'   => $message,
            'data'      => $data,
        ];
    }
    if(count($getData) != 0){
        return $response;
    }else{
        $status = 0;
        $message = 'No Data Found';
        $response_code = 200;
        $response = [
            'status' => $status,
            'message' => $message,
        ];
        return $response;
    }
}

function ApiResponse($response, $response_code = 200){
    if(empty($response['data'])){
    }
    return response()->json($response, $response_code);
}

function error_msg($ex=''){
    $response = [
        'status' => 0,
        'message' => ($ex == "" ? trans('data not found') : $ex)
    ];
    return $response;
}
