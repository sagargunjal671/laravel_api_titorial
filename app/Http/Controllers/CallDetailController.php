<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\CallDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallDetailController extends Controller
{
    //
    public function index()
    {
        $callDetails = CallDetail::paginate(2);
        // You can return paginated data as is, and it will include pagination metadata by default
        
        return response()->json($callDetails);
    }

    public function show($call_id)
    {   
        $callDetails = CallDetail::where('call_id',$call_id)->first();
        if(!$callDetails)
        {
            return response()->json(['error'=>"call Not Found"],404);
        }
        return response()->json($callDetails);

    }

    public function update(Request $request,$id)
    {
        $callDetail = CallDetail::find($id);
        if(!$callDetail)
        {
            return response()->json(['error'=>'Call Not Found'],404);

        }
        $validator = Validator::make($request->all(),[
          'call_id'    => 'sometimes|required|string|unique:call_details,call_id,' . $id,
            'duration'   => 'sometimes|required|integer',
            'call_time'  => 'sometimes|required|date',
            'caller'     => 'sometimes|required|string',
            'receiver'   => 'sometimes|required|string',
            'status'     => 'sometimes|required|in:completed,missed,ongoing',  
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $callDetail->update($request->all());

        return response()->json($callDetail);
    }
    public function destroy($id)
    {
        $callDetail = CallDetail::find($id);
        if(!$callDetail)
        {
            return response()->json(['error' => "Call Not Found"],404);
        }
        $callDetail->delete();
        return response()->json(['message' => 'Call details deleted successfully']);
    }
    
}
