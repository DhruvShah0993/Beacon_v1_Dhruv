<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trigger;
use App\Models\Beacon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class TriggerController extends Controller
{
    
    public function index(Request $request)
    {
    
        if ($request->ajax()) {
            $params = $columns = $totalRecords = $data = array();
            $params = $_REQUEST;
            $columns = array(
                0 => 'id',
                1 => 'beacon_id',
                2 => 'title',
                3 => 'body',
            );
            $sqlTot = $sqlRec = "";
            $where = ' WHERE 1 ';
            $v = $params['search']['value'];
            $scount = Trigger::where('triggers.id', '!=', '0');
            $sql = Trigger::join('beacons', 'beacons.id', 'triggers.beacon_id')->select('beacons.name', 'triggers.id', 'triggers.title', 'triggers.body');
            
            if (!empty($params['search']['value'])) {
                $scount->where('beacon_id', 'like', '%' . $params['search']['value'] . '%');
                $sql->where('beacon_id', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('title', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('title', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('body', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('body', 'like', '%' . $params['search']['value'] . '%'); 
            }   
            //dd($params['order'][0]['column']);
            /*  if($columns[$params['order'][0]['column']]=='id')
              $sql->orderBy('id','desc');
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
                $rowData['beacon_id'] = $row->name;
                $rowData['title'] = $row->title;
                $rowData['body'] = $row->body;
                $amsg = "<a href= 'javascript:;' id='showUser' data-id='" . be64($row->id) . "' class='btn btn-view btn-xs' title='view' data-toggle='modal' data-target='#modal-default'><i class='fa fa-eye'></i></a>&nbsp;<a href= 'trigger/" . ($row->id) . "/edit' class='btn btn-primary btn-xs' title='edit'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' data-id='" . ($row->id) . "' class='btn btn-danger btn-xs delete_card' title='delete'><i class='fa fa-trash'></i></a>";
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

        return view('backend.trigger.index');
      
    }
    public function create() {
        
        $beacons = Beacon::all();
        return view('backend.trigger.create',compact('beacons'));
    }
               
    
    public function store(Request $request)
    {
        
        $input = $request->all();
        $messages = [];
        $rules = array(
 
            'beacon_id' => "required",
            'title' => "required",
            'body' => "required",   
        );
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors()->first());
        } else {
        
            if (isset($input['beacon_id'])) {
                $card = Trigger::find(($input['id']));
            }
            
            if (isset($card)) {
                $card->fill($input)->save();
                return redirect()->route('trigger.index')->with('success', 'Trigger updated successfully');
            } else {
                Trigger::create($input);
        
                return redirect()->route('trigger.index')->with('success', 'Trigger created successfully');
            }
        }
      
    }
    public function show($id) {
        
        $card = Trigger::join('beacons','beacons.id','triggers.beacon_id')->where('triggers.id',$id)->get();
        return response()->json(['status' => '200', 'message' => "Beacon fetch successfully", 'data' => ["trigger" => $card]]);
    }


    public function edit($id) {

        $triggers = Trigger::join('beacons','beacons.id','triggers.beacon_id')->select('triggers.id','triggers.body','triggers.title','triggers.beacon_id')->where('triggers.id',$id)->get();
        $beacons = Beacon::all();

        foreach($triggers as $card)
         {
            $trigger = $card;
         }
        
        return view('backend.trigger.create', compact('beacons','trigger'));
    }

    public function update(request $request){
            //
        
    }

    public function destroy($id) {

        $card = Trigger::where('id', $id)->delete();
        return response()->json(['status' => '200', 'message' => "Beacon deleted successfully", 'data' => (object) []]);
    }

}
