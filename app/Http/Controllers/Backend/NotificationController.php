<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Edujugon\PushNotification\PushNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        $push = new PushNotification('fcm');
        $notification = $push->setMessage([
            'notification' => [
                'title' => 'This is the title',
                'body' => 'This is test message',
                'sound' => 'default'
            ],
        ])
        ->setApiKey('AAAAxhBdXxo:APA91bH69PMwVOdylKxmO9UpVx2Wc86wg1fz-zYLqqsI6V6BvryrwW08ofDCZmBgPbY_nSSstiIAVWoEvljiV7uBjZISqZR8IEHeJxW0nc7dzpW6hUsjiOYo55TpkEUlaqZlOl-BSC0T')
        ->setDevicesToken('c3jyrB6ZgE0xlYmQc3Ycz4:APA91bEy6T0tVDacqAu3ZGnEhIVShv5jQ9htKf2M9YJc0N0HooB4_2YNWJCcc-mqmJrdW15JqMvMoBaLGQ550gcTPMM8_wf1Tu9pUj-r_A0IXgmhfOedAQdT2q9sQcHZ3h9kgFt8nrD7')->send();
        dd($notification);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
