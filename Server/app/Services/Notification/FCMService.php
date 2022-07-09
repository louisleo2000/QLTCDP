<?php

namespace App\Services\Notification;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class FcmService implements NotificationService
{
    /**
     * @param $deviceTokens
     * @param $data
     * @throws GuzzleException
     */
    public function sendBatchNotification($deviceTokens, $data = [])
    {
        $data['topicName'] = 'all';
        self::subscribeTopic($deviceTokens, $data['topicName']);
        self::sendNotification($data, $data['topicName']);
        self::unsubscribeTopic($deviceTokens, $data['topicName']);
    }

    /**
     * @param $data
     * @param $topicName
     * @throws GuzzleException
     */
    public function sendNotification($data, $topicName = null)
    {
        $url = 'POST https://fcm.googleapis.com/v1/projects/tmdt-84915/messages:send';
        $data = [
            // 'to' => '/topics/' . $topicName,
            'message' => [
                'topic' => $topicName,
                'notification' => [
                    'title' => $data['title'] ?? 'Thông báo',
                    'body' => $data['body'] ?? 'Nội dung',
                    'sound' => 'default',
                    'badge' => '1'
                ],
                'data' => [
                    'title' => $data['title'] ?? 'Thông báo',
                    'body' => $data['body'] ?? 'Nội dung',
                    'sound' => 'default',
                    'badge' => '1'
                ],
                'token' => $data['token'] ?? ' dcse8rVNSm-bVbcmZLj9jj:APA91bFl-qwUAzI5_cJzStfVRQosr5MM9UrWZFPkPb-pZ1FKY1ECTFIoxTmnnh233sHmgg01X-PBH4hWmJ96hwCi28MJ9axmcbjXK-JBPGTrXL-J0uF3L9rbBl5zPWezNpBSwV0SgFQ0',
            ]

        ];
        // dd($data);
        $this->execute($url, $data);
    }

    /**
     * @param $deviceToken
     * @param $topicName
     * @throws GuzzleException
     */
    public function subscribeTopic($deviceTokens, $topicName = null)
    {
        $url = 'https://iid.googleapis.com/iid/v1:batchAdd';
        $data = [
            // 'to' => '/topics/' . $topicName,
            'registration_tokens' => $deviceTokens,
        ];

        $this->execute($url, $data);
    }

    /**
     * @param $deviceToken
     * @param $topicName
     * @throws GuzzleException
     */
    public function unsubscribeTopic($deviceTokens, $topicName = null)
    {
        $url = 'https://iid.googleapis.com/iid/v1:batchRemove';
        $data = [
            // 'to' => '/topics/' . $topicName,
            'registration_tokens' => $deviceTokens,
        ];

        $this->execute($url, $data);
    }

    /**
     * @param $url
     * @param array $dataPost
     * @param string $method
     * @return bool
     * @throws GuzzleException
     */
    private function execute($url, $dataPost = [], $method = 'POST')
    {
        $result = false;
        try {
            $client = new Client();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('FCM_SERVER_KEY'),
                ],
                'json' => $dataPost,
                'timeout' => 300,
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;
        } catch (Exception $e) {
            Log::debug($e);
            dd($e);
        }
        dd('Bearer ' . env('FCM_SERVER_KEY'));
        return $result;
    }
}
