<?php
namespace App\Http\Controllers;
use App\Services\ExportUserService;
use Illuminate\Support\Facades\Auth;
class ExportUserController extends Controller
{
    private $exportUserService;
   
    public function __construct(ExportUserService $exportUserService)
    {
        $this->exportUserService = $exportUserService;
    }
    
    public function exportUsers()
    {
        $this->exportUserService->processUserExport();
        return redirect('/home')->with('successMessage',
            __('frontendMessages.SUCCESS_MESSAGES.USERS_EXPORTED'));
    }
   
    public function showUsersDownload()
    {
        $pathToFile = storage_path(config('constants.USER_EXPORTED_FILE_PATH'). '/' .
            Auth::id() . '.' . config('constants.USER_EXPORTED_FILE_TYPE'));
        return view('export.userFileDownload', ['pathToFile' => $pathToFile]);
    }
   
    public function usersDownload()
    {
        $pathToFile = storage_path(config('constants.USER_EXPORTED_FILE_PATH'). '/' .
            Auth::id() . '.' . config('constants.USER_EXPORTED_FILE_TYPE'));
        return response()->download($pathToFile, now() . '.' . config('constants.USER_EXPORTED_FILE_TYPE'));
    }
}