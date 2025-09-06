<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\AndroidConfig;

class BaseFcmNotification extends Notification
{
    protected function getApnsConfig(array $notificationData): ApnsConfig
    {
        return ApnsConfig::new()
            ->withApsField('alert', [
                'title' => $notificationData['title'],
                'body' => $notificationData['message'],
            ])
            ->withSound('default')
            ->withBadge(1)
            ->withHeader('apns-priority', '10');
    }

    protected function getAndroidConfig(): AndroidConfig
    {
        return AndroidConfig::fromArray([
            'priority' => 'high',
            'notification' => [
                'sound' => 'default',
                'channel_id' => 'fcm_default_channel',
                'visibility' => 'public',
            ],
        ]);
    }
}
