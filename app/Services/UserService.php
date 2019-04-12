<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserActivityRepository;
use App\Models\UserActivity;
use Carbon\Carbon;
class UserService
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @var UserActivityRepository $userActivityRepository
     */
    private $userActivityRepository;


    public function __construct(UserRepository $userRepository, UserActivityRepository $userActivityRepository)
    {
        $this->userRepository = $userRepository;
        $this->userActivityRepository = $userActivityRepository;
    }
     
    public function store($userData)
    {
          $userDetails = [
            'username' => $userData['username'],
            'firstname' => $userData['firstname'],
            'lastname' => $userData['lastname'],
            'email' => $userData['email'],
            'password' => $userData['username'],
            'confmpassword' => $userData['confmpassword'],
            'address' => $userData['address'],
            'contact_number' => $userData['contact_number'],
            'house_number' => $userData['house_number'],
            'postal_code' => $userData['postal_code'],
            'city' => $userData['city'],
            
          ];
            $this->userRepository->create($userDetails);
       
    }

    public function deleteUser($id)
    {  
        return $this->userRepository->delete($id);
       
    }

    public function getUser($id)
    {
        return $this->userRepository->getUser($id);
    }

    public function update($userInfo, $id)
    {
        $userDetails = [
            'username' => $userInfo['username'],
            'firstname' => $userInfo['firstname'],
            'lastname' => $userInfo['lastname'],
            'email' => $userInfo['email'],
            'password' => $userInfo['username'],
            'confmpassword' => $userInfo['confmpassword'],
            'address' => $userInfo['address'],
            'contact_number' => $userInfo['contact_number'],
            'house_number' => $userInfo['house_number'],
            'postal_code' => $userInfo['postal_code'],
            'city' => $userInfo['city'],
            
          ];
             $user = $this->userRepository->update($id, $userDetails);
          
    }
    public function getProfile()
    { 
        return $this->userRepository->authProfile();
    }
    public function searchUser($user)
    {
        return $this->userRepository->user($user);
    }


    public function trackUserActivity($modifiedBy, $class, $trackableFields, $dataBeforeUpdated, $dataAfterUpdated) : bool
        {
            $dataAfterUpdated = $dataAfterUpdated->toArray();
            $dataBeforeUpdated = $dataBeforeUpdated->toArray();
           // dd($dataAfterUpdated);
            $updatedData = array_diff($dataAfterUpdated, $dataBeforeUpdated);

            if (empty($updatedData)) 
            {
             return true;
            }

            $trackableData = array_only($updatedData, $trackableFields);

            if (empty($trackableData))
            {
              return true;
            }

            $trackableDataToInsert = [];
            foreach ($trackableFields as $field) 
            {
              if (isset($trackableData[$field]) && !empty($trackableData[$field]))
               {
                    $information['entity_type'] = $class;
                    $information['entity_id'] = $dataBeforeUpdated['id'];
                    $information['column_name'] = $field;
                    $information['old_value'] = $dataBeforeUpdated[$field];
                    $information['modified_value'] = $dataAfterUpdated[$field];
                    $information['modified_by'] = $modifiedBy;
                    $information['created_at'] = Carbon::now()->toDateTimeString();
                    $information['updated_at'] = Carbon::now()->toDateTimeString();

                    $trackableDataToInsert[] = $information;
                }
            }

            $this->userActivityRepository->insertMultipleRows($trackableDataToInsert);

        return true;
        }
}