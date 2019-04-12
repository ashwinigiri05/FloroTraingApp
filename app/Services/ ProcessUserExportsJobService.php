<?php
namespace App\Services;
use App\Mail\UsersExportedEmail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\UserActivity;

class ProcessUserExportsJobService
{
    
    public function processUserExports(User $user)
    {
        $this->user = $user;
        $this->unlinkExportFileIfExist();
        Excel::create($user->id, function($excel) {
            $excel->sheet('user-sheet', function($sheet) {
             
                $users = [];
                foreach (User::with('userHistory')->cursor() as $user ) {
                    $user->user_activity = $user->userHistory->toArray();
                    $user->user_last_login = $user->userLastLoginDetails->toArray();
                    $users[] = $user->toArray();
                }
                $sheet->loadView('export.userExport', ['users' => $users]);
                
            });
        })->store(config('constants.USER_EXPORTED_FILE_TYPE'),
            storage_path(config('constants.USER_EXPORTED_FILE_PATH')));
        $this->notifyUserViaEmail();
    }
   
    public function unlinkExportFileIfExist() : bool
    {
        $file = storage_path(config('constants.USER_EXPORTED_FILE_PATH'). '/' .
            $this->user->id . '.' . config('constants.USER_EXPORTED_FILE_TYPE'));
        if (file_exists($file)) {
            unlink($file);
        }
        return true;
    }
    
    public function notifyUserViaEmail()
    {
        return Mail::to($this->user->email)->send(new UsersExportedEmail());
    }
}