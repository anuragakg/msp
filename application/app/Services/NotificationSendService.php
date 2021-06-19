<?php

namespace App\Services;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class NotificationSendService extends Service
{   

    public function fetchNotifications()
    {
        $user  = Auth::user();
        return $user->unreadNotifications;
    }

    public function getNotificationCount()
    {
        $user  = Auth::user();
        return $user->unreadNotifications()->groupBy('notifiable_type')->count();
    }

    public function markReadNotification($notificationId)
    {
        $user  = Auth::user();
        $user->unreadNotifications->where('id', $notificationId)->markAsRead();
        return TRUE;
    }

    public function markAllReadNotification()
    {
        $user  = Auth::user();
        $user->unreadNotifications->markAsRead();
        return TRUE;
    }

    public function deleteAllNotification()
    {
        $user  = Auth::user();
        $user->notifications()->delete();
        return TRUE;
    }
}