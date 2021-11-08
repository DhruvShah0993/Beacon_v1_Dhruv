<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beacon;
use Illuminate\Support\Facades\Validator;

class BeaconController extends Controller {

    protected $api_key;

    public function __construct() {
        $this->api_key = 'dXNlcm5hbWU6MTIzNDU2Nzg5MDEyMzQ1Njc4OTAxMjM0NTY3ODkwMTIzNDU2Nzg5MA==';
    }

    public function getBeacons(Request $request) {
        if($_SERVER['HTTP_APIKEY'] == $this->api_key) {
            $result = [];
            $total_page = 0;
            $total_record = 0;
            $input = $request->all();
            $return_data = Beacon::orderBy('id', 'desc')->paginate(10)->toArray();
            if (!empty($return_data['data'])) {
                $result = replace_null_with_empty_string($return_data['data']);
                $total_page = $return_data['last_page'];
                $total_record = $return_data['total'];
            }
            $result = array(
                "total_page" => $total_page,
                "total_record" => $total_record,
                "data" => replace_null_with_empty_string($result),
            );
            return response()->json(['status' => 200, 'message' => 'Beacon fetch successfully', 'data' => replace_null_with_empty_string($result)]);
        } else {
            return response()->json(['status' => 405, 'message' => 'Unauthorized Access', 'data' => (object) []]);
        }
    }

    public function addBeacon(Request $request) {
        if($_SERVER['HTTP_APIKEY'] == $this->api_key) {
            $input = $request->all();
            $rules = [
                'name' => ['required', 'max:180'],
                'major' => ['required', 'max:180'],
                'minor' => ['required', 'max:180'],
                'uid' => ['required', 'max:180']
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return response()->json(['status' => 400, 'message' => $validator->errors()->first(), 'data' => (object) []]);
            } else {
                $bid = Beacon::create($request->all());
                $result = Beacon::find($bid->id);
                return response()->json(['status' => 200, 'message' => 'Beacon added successfully', 'data' => replace_null_with_empty_string($result)]);
            }
        } else {
            return response()->json(['status' => 405, 'message' => 'Unauthorized Access', 'data' => (object) []]);
        }
    }

}
