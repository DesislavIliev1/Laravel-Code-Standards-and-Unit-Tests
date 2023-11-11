<?php
use Illuminate\Support\Facades\Validator;


function carValidation(Request $request){
    $validator = Validator::make($request->all(), [
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|string|max:255'
    ]);


}