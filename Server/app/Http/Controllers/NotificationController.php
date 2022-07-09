<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

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
        $data = [
            'title' => 'Quản lý thông báo',
            
        ];
        return view('pages.message', $data);
    }
    public function sendMessage(Request $request)
    {
        //
        $url = 'https://fcm.googleapis.com/v1/projects/tmdt-84915/messages:send';
        $data = [
            // 'to' => '/topics/' . $topicName,
            'message' => [
                // 'topic' => $topicName,
                'notification' => [
                    'title' => $request['title'] ?? 'Thông báo',
                    'body' => $request['body'] ?? 'Nội dung',
                    'image' => $request['image'] ?? '',
                ],
                'data' => [
                    'title' => $request['title'] ?? 'Thông báo',
                    'body' => $request['body'] ?? 'Nội dung',
                    'sound' => 'default',
                    'badge' => '1'
                ],
                'token' => $request['token'] ?? 'dcse8rVNSm-bVbcmZLj9jj:APA91bFl-qwUAzI5_cJzStfVRQosr5MM9UrWZFPkPb-pZ1FKY1ECTFIoxTmnnh233sHmgg01X-PBH4hWmJ96hwCi28MJ9axmcbjXK-JBPGTrXL-J0uF3L9rbBl5zPWezNpBSwV0SgFQ0',
            ]

        ];
        // dd($data);
        $this->execute($url, $data);

        return response()->json(['message' => 'success'], 200);

    }

    private function execute($url, $dataPost = [], $method = 'POST')
    {
        $result = false;
        try {
            $client = new Client();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '. env('FCM_SERVER_KEY'),
                ],
                'json' => $dataPost,
                'timeout' => 300,
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;
        } catch (Exception $e) {
            Log::debug($e);
            error_log($e);
            error_log('Bearer '. env('FCM_SERVER_KEY'));
        }
        return $result;
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

        $url = 'https://fcm.googleapis.com/v1/projects/tmdt-84915/messages:send';
        $data = [
            // 'to' => '/topics/' . $topicName,
            'message' => [
                // 'topic' => $topicName,
                'notification' => [
                    'title' => $request['title'] ?? 'Thông báo',
                    'body' => $request['body'] ?? 'Nội dung',
                    'image' => $request['image'] ?? '',
                ],
                'data' => [
                    'title' => $request['title'] ?? 'Thông báo',
                    'body' => $request['body'] ?? 'Nội dung',
                    'sound' => 'default',
                    'badge' => '1'
                ],
                'token' => $request['token'] ?? 'dcse8rVNSm-bVbcmZLj9jj:APA91bFl-qwUAzI5_cJzStfVRQosr5MM9UrWZFPkPb-pZ1FKY1ECTFIoxTmnnh233sHmgg01X-PBH4hWmJ96hwCi28MJ9axmcbjXK-JBPGTrXL-J0uF3L9rbBl5zPWezNpBSwV0SgFQ0',
            ]

        ];
        // dd($data);
        if( $this->execute($url, $data)){
            return back()->with('success', 'Thông báo đã được gửi đi');
        }else{
            return back()->with('error', 'Thông báo không được gửi đi');
        }

       
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
