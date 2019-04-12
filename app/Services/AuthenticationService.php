<?php

namespace App\Services;

use App\Repositories\AuthenticationLogRepository;
use App\User;
use Illuminate\Http\Request;

class AuthenticationService
{
    private $authenticationLogRepository;

    public function __construct(AuthenticationLogRepository $authenticationLogRepository)
    {
        $this->authenticationLogRepository = $authenticationLogRepository;
    }

    public function storeLoginActivityOfUser(Request $request, User $user){
  
        $logDetails = [
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'browse_agent'=>$request->server('HTTP_USER_AGENT'),
            'login_time'=>$request->Carbon::now()->toDateTimeString(),
            'logout_time'=>$request->Carbon::now()->toDateTimeString(),
        ];
        dd($logDetails);
        $this->authenticationLogRepository->create($logDetails);
    }
    
}
