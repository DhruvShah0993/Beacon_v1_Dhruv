<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beacon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class BeaconController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $params = $columns = $totalRecords = $data = array();
            $params = $_REQUEST;

            $columns = array(
                0 => 'id',
                1 => 'name',
                2 => 'major',
                3 => 'minor',
                4 => 'uid',
                5 => 'description',
                6 => 'address',
            );
            $sqlTot = $sqlRec = "";
            $where = ' WHERE 1 ';
            $v = $params['search']['value'];
            $scount = Beacon::query();
            $sql = Beacon::query();
            if (!empty($params['search']['value'])) {
                $scount->where('name', 'like', '%' . $params['search']['value'] . '%');
                $sql->where('name', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('major', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('major', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('minor', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('minor', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('uid', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('uid', 'like', '%' . $params['search']['value'] . '%');
                // $scount->orWhere('description', 'like', '%' . $params['search']['value'] . '%');
                // $sql->orWhere('description', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('address', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('address', 'like', '%' . $params['search']['value'] . '%');
            }
            //dd($params['order'][0]['column']);
            /*  if($columns[$params['order'][0]['column']]=='id')
              $sql->orderBy('id','description');
              else */
            $sql->orderBy($columns[$params['order'][0]['column']], $params['order'][0]['dir']);
            $sql->offset($params['start'])->limit($params['length']);

            $totalRecords = $scount->count();
            $data = array();
            $queryTot = $sql->get();
            $i = $params['start'] + 1;
            foreach ($queryTot as $row) {
                $rowData = array();
                $rowData['id'] = $row->id;
                $rowData['name'] = $row->name;
                $rowData['major'] = $row->major;
                $rowData['minor'] = $row->minor;
                $rowData['uid'] = $row->uid;
                $rowData['description'] = $row->description;
                $rowData['address'] = $row->address; 
                $amsg = "<a href= 'javascript:;' id='showUser' data-id='" . be64($row->id) . "' class='btn btn-view btn-xs' title='view' data-toggle='modal' data-target='#modal-default'><i class='fa fa-eye'></i></a>&nbsp;<a href= 'beacon/" . be64($row->id) . "/edit' class='btn btn-primary btn-xs' title='edit'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' data-id='" . be64($row->id) . "' class='btn btn-danger btn-xs delete_card' title='delete'><i class='fa fa-trash'></i></a>";
                $rowData['action'] = $amsg;
                $i++;
                $data[] = $rowData;
            }

            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => intval($totalRecords),
                "recordsFiltered" => intval($totalRecords),
                "data" => $data   // total data array
            );
            echo json_encode($json_data);
            exit;
        }

        return view('backend.beacon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backend.beacon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->description);
        $input = $request->all();
        $messages = [];
        $rules = array(
            'name' => "required",
            'uid' => "required",
            'major' => "required",
            'minor' => "required",
            'description' => "required",
            'address' => "required",
        );
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->first());
        } else {
            if (isset($input['beacon_id'])) {
                $card = Beacon::find(bd64($input['beacon_id']));
            }
            $input = Arr::except($input, ['_token', 'beacon_id']);
            if (isset($card)) {
                $card->fill($input)->save();
                return redirect()->route('beacon.index')->with('success', 'Beacon updated successfully');
            } else {
                // dd($input);
                Beacon::create($input);
                return redirect()->route('beacon.index')->with('success', 'Beacon created successfully');
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $card = Beacon::find(bd64($id));
        //return view('admin.sub_admin.show',['user'=>$user]);
        return response()->json(['status' => '200', 'message' => "Beacon fetch successfully", 'data' => ["beacon" => $card]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $card = Beacon::find(bd64($id));
        return view('backend.beacon.create', ['beacon' => $card]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $card = Beacon::where('id', bd64($id))->delete();
        return response()->json(['status' => '200', 'message' => "Beacon deleted successfully", 'data' => (object) []]);
    }

}
