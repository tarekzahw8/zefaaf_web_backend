<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAcIYJN8M:APA91bGjz0eKCJbu-x1OvJ-bqVSDYBWBNZkeeeoDqoduReQ2t2DQHfdGVwan1tDGI-hIyaj5RpKVJ3DFrSLM4SMKSC6ugKrQUmn3MB4Mb5gFbsEo9XUBlUNCc61PV8fgRuq1Dvp1FNYJ'),
        'sender_id' => env('FCM_SENDER_ID', '483285088195'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 60.0, // in second
    ],
];
