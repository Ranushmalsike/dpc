<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\chat_of_summery;
use App\Models\User;
use App\Utilities\checkRoleType;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
      
    }



public function boot(): void
{
    View::composer('*', function ($view) {
        
         $checkRoleType = new checkRoleType();
         $userRoleType = $checkRoleType->checkType();

        if (auth()->check()) {
            $notification = new Notification();
            $userRoleType = $checkRoleType->checkType(auth()->user()->id);

            if ($userRoleType->roleType == "admin" || $userRoleType->roleType == "staff") {
                $summery_new_notification_count = $notification->total_new_notification_of_staff();
                $summery_new_notification = $notification->get_no_view_notication_of_summery();
            } elseif ($userRoleType->roleType == "teacher") {
                $summery_new_notification_count = $notification->total_new_notification_of_teacher();
                $summery_new_notification = $notification->get_no_view_notication_of_summery_teacher();
            } else {
                $summery_new_notification_count = 0;
                $summery_new_notification = "none";
                $userRoleType = "none";
            }

            $view->with('summery_new_notification_count', $summery_new_notification_count)
                 ->with('summery_new_notification', $summery_new_notification)
                 ->with('userRoleType', $userRoleType);
        }
        else{
            return redirect('login.login');
        }
    });
}

}

class notification{
/**
 * get what are the notification of summery - staff
 */
public function get_no_view_notication_of_summery() {
return chat_of_summery::select(
        'chat_of_summeries.id',
        'chat_of_summeries.chat_time',
        'chat_of_summeries.summery_id',
        'chat_of_summeries.Column_id',
        DB::raw("CASE
                    WHEN chat_of_summeries.chat_staff IS NOT NULL THEN chat_of_summeries.chat_staff
                    WHEN chat_of_summeries.chat_teacher IS NOT NULL THEN chat_of_summeries.chat_teacher
                    ELSE 'Default Value'
                END AS chat_person")
    )
    ->where('chat_of_summeries.staff_id_view', '0')
    ->get();
}
/**
 * get what are the notification of summery - Teacher
 */
public function get_no_view_notication_of_summery_teacher() {
    $getSessionID = auth()->user()->id;
return chat_of_summery::select(
        'chat_of_summeries.id',
        'chat_of_summeries.summery_id',
        'chat_of_summeries.chat_time',
        'chat_of_summeries.Column_id',
        DB::raw("CASE
                    WHEN chat_of_summeries.chat_staff IS NOT NULL THEN chat_of_summeries.chat_staff
                    WHEN chat_of_summeries.chat_teacher IS NOT NULL THEN chat_of_summeries.chat_teacher
                    ELSE 'Default Value'
                END AS chat_person")
    )
    ->where('chat_of_summeries.teacher_id_view', '0')
    ->where('teacher_id', $getSessionID)
    ->get();
}
/**
 * Total new Notification of summery - staff
 */
public function total_new_notification_of_staff() {
return chat_of_summery::where('chat_of_summeries.staff_id_view', '0')
    ->count();
}
/**
 * Total new Notification of summery - teacher
 */
public function total_new_notification_of_teacher() {
    $getSessionID = auth()->user()->id;
return chat_of_summery::where('chat_of_summeries.teacher_id_view', '0')
     ->where('teacher_id', $getSessionID)
     ->count();
}
}

