<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    public function create(User $user)
    {
        // السماح فقط للمشرفين والمدراء بإنشاء فعاليات
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function update(User $user, Event $event)
    {
        // السماح للمدير العام، أو المشرف إذا كان هو صاحب الفعالية
        return $user->isSuperAdmin() || ($user->isAdmin() && $event->user_id === $user->id);
    }

    public function delete(User $user, Event $event)
    {
        return $user->isSuperAdmin() || ($user->isAdmin() && $event->user_id === $user->id);
    }
}
