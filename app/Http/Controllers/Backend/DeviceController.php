<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $params = $columns = $totalRecords = $data = array();
            $params = $_REQUEST;

            $columns = array(
                0 => 'id',
                1 => 'device_details',
            );
            $sqlTot = $sqlRec = "";
            $where = ' WHERE 1 ';
            $v = $params['search']['value'];
            $scount = Device::query();
            $sql = Device::query();
            if (!empty($params['search']['value'])) {
                $scount->where('device_details', 'like', '%' . $params['search']['value'] . '%');
                $sql->where('device_details', 'like', '%' . $params['search']['value'] . '%');
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
                $rowData['device_details'] = $row->device_details;
                $amsg = "<a href= 'javascript:;' id='showUser' data-id='" . be64($row->id) . "' class='btn btn-view btn-xs' title='view' data-toggle='modal' data-target='#modal-default'><i class='fa fa-eye'></i></a>&nbsp;";
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

        return view('backend.device.index');
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
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }
}
