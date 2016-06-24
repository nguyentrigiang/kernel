<?php

namespace Orchestra\Notifications\Channels;

use Illuminate\Support\Arr;
use Orchestra\Notifier\Message;
use Orchestra\Notifier\Notifiable;
use Illuminate\Notifications\Channels\Notification;

class MailChannel
{
    use Notifiable;

    /**
     * Send the given notification.
     *
     * @param  \Orchestra\Notifications\Channels\Notification  $notification
     *
     * @return void
     */
    public function send(Notification $notification)
    {
        $users = $notification->notifiables->filter()->all();

        if (empty($users)) {
            return;
        }

        $message = Message::create(
            data_get($notification, 'payload.view', 'orchestra/foundation::emails.notification'),
            $this->prepareNotificationData($notification),
            $notification->subject
        );

        foreach($users as $user) {
            $this->sendNotification($user, $message);
        }
    }

    /**
     * Prepare the data from the given notification.
     *
     * @param  \Illuminate\Notifications\Channels\Notification  $notification
     * @return void
     */
    protected function prepareNotificationData($notification)
    {
        $data = $notification->toArray();

        return Arr::set($data, 'actionColor', $this->actionColorForLevel($data['level']));
    }

    /**
     * Get the action color for the given notification "level".
     *
     * @param  string  $level
     *
     * @return string
     */
    protected function actionColorForLevel($level)
    {
        return $level;
    }
}
