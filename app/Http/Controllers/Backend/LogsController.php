<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $params = $columns = $totalRecords = $data = array();
            $params = $_REQUEST;

            $columns = array(
                0 => 'id',
                1 => 'beacon_id',
                2 => 'device_id',
                3 => 'geolocation',
            );
            $sqlTot = $sqlRec = "";
            $where = ' WHERE 1 ';
            $v = $params['search']['value'];
            $scount = Logs::query();
            $sql = Logs::join('beacons', 'beacons.id', 'logs.beacon_id')->join('devices', 'devices.id', 'logs.device_id')->select('beacons.name', 'devices.device_details', 'logs.geolocation',  'logs.id');
            if (!empty($params['search']['value'])) {
                $scount->where('beacon_id', 'like', '%' . $params['search']['value'] . '%');
                $sql->where('beacon_id', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('device_id', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('device_id', 'like', '%' . $params['search']['value'] . '%');
                $scount->orWhere('geolocation', 'like', '%' . $params['search']['value'] . '%');
                $sql->orWhere('geolocation', 'like', '%' . $params['search']['value'] . '%');
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
                $rowData['device_id'] = $row->device_details;
                $rowData['geolocation'] = $row->geolocation;
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

        return view('backend.logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function show(Logs $logs)
    {
        //
        $card = Logs::find(bd64($id));
        // dd($card);
        //return view('admin.sub_admin.show',['user'=>$user]);
        return response()->json(['status' => '200', 'message' => "Logs fetch successfully", 'data' => ["logs" => $card]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function edit(Logs $logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logs $logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logs $logs)
    {
        //
    }
}
