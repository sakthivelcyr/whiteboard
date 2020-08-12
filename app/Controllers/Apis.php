<?php
namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Apis extends BaseController
{

	public function register() {
       
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $db = \Config\Database::connect();

        $validator = array(
            'status' => false,
            'messages' => array()
        );

        $isEmailExist  = false;
        $isMobileExist = false;

        $name = $this
            ->request
            ->getVar('name');
        $role = $this
            ->request
            ->getVar('role');    
        $college = $this
            ->request
            ->getVar('college');    
        $mobile = $this
            ->request
            ->getVar('mobile');        
        $state = $this
            ->request
            ->getVar('state');
        $district = $this
            ->request
            ->getVar('district');        
        $email = $this
            ->request
            ->getVar('email');
        $profileUrl = $this
            ->request
            ->getVar('profileUrl');
        $imei = $this
            ->request
            ->getVar('imei');
        $firebaseToken = $this
            ->request
            ->getVar('firebaseToken');        
        $device_latitude = $this
            ->request
            ->getVar('device_latitude');        
        $device_longitude = $this
            ->request
            ->getVar('device_longitude');                
        
        if (empty($name)) array_push($validator['messages'], "Please enter your name.");
        if (empty($role)) array_push($validator['messages'], "Please enter your role.");
        if (empty($college)) array_push($validator['messages'], "Please enter your college.");
        if (empty($state)) array_push($validator['messages'], "Please enter your state.");
        if (empty($district)) array_push($validator['messages'], "Please enter your district.");
        
        if (empty($profileUrl)) array_push($validator['messages'], "Profile Url has not been provided.");
        if (empty($imei)) array_push($validator['messages'], "IMEI has not been provided.");
        if (empty($firebaseToken)) array_push($validator['messages'], "Firebase token has not been provided.");        
        if (empty($device_longitude)) array_push($validator['messages'], "Device longitude has not been provided.");        
        if (empty($device_latitude)) array_push($validator['messages'], "Device latitude has not been provided.");        

        if (empty($mobile)) array_push($validator['messages'], "Please enter your mobile number.");
        else if (!preg_match('/^[0-9]{10}+$/', $mobile)) {
            array_push($validator['messages'], "Mobile number is not in correct format.");
        } 
        else {           
            $builder = $db->table('customer');
            $query   = $builder->getWhere(['mobile'=>$mobile]);
            $query   = $query->getResult();
            if($query)
            {
                $isMobileExist = true;
            }            
        }

        if (empty($email)) array_push($validator['messages'], "Please enter your email.");
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($validator['messages'], "Email is not in correct format.");
        else {
            $builder = $db->table('customer');
            $query   = $builder->getWhere(['email'=>$email]);
            $query   = $query->getResult();
            if($query)
            {
                $isEmailExist = true;
            }                        
        }
        
        if (empty($validator['messages'])) {
        if ($isEmailExist == true) {
            $data = array(
                'name' => $name,
                'mobile' => $mobile,
                'state' => $state,
                'district' => $district,
                'role' => $role,
                'email' => $email,
                'profileUrl' => $profileUrl,
                'imei' => $imei,
                'firebaseToken' => $firebaseToken,
                'college' => $college,  
                'device_latitude' => $device_latitude,
                'device_longitude' => $device_longitude,
                'updated_at' => new Time('now', 'Asia/Kolkata', 'en_US'),
                'deviceToken' => bin2hex(random_bytes(12))
            );
            $builder = $db->table('customer');
            $builder->where('email',$email);

            if ($builder->update($data)) {
                $validator['status'] = true;
                array_push($validator['messages'], "Successfully Updated");
            } else {
                log_message('debug', 'sql query fail in /register ', false);
                array_push($validator['messages'], "Error while adding the member information");
            }
        } else {
            if (empty($validator['messages'])) {

                $data = array(
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'state' => $state,
                    'role' => $role,
                    'college' => $college,
                    'district' => $district,                    
                    'profileUrl' => $profileUrl,
                    'imei' => $imei,    
                    'device_latitude' => $device_latitude,
                    'device_longitude' => $device_longitude,           
                    'created_at' => new Time('now', 'Asia/Kolkata', 'en_US'),
                    'firebaseToken' => $firebaseToken,                    
                    'deviceToken' => bin2hex(random_bytes(12)),
                    
                );
                $builder = $db->table('customer');
                $builder->where('email',$email);
                if ($builder->insert($data)) {
                    $validator['status'] = true;
                    array_push($validator['messages'], "Successfully Added");
                } else {
                    log_message('debug', 'sql query fail in /register ', false);
                    array_push($validator['messages'], "Error while adding the member information");
                }
            } else {
                log_message('debug', 'sql query fail in /register ', false);
            }
        }
        if ($validator['status']) {
            $validator['deviceToken'] = $data['deviceToken'];
        }
        }
        echo json_encode($validator);        
        
    }  
    
    

}
