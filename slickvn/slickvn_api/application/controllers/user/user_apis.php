<?php

require APPPATH.'/libraries/REST_Controller.php';

/**
 * 
 * This class support APIs User for client
 *
 * @author Huynh Xinh
 * Date: 8/11/2013
 * 
 */
class user_apis extends REST_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //  Load model USER
        $this->load->model('user/usermodel');
        $this->load->model('user/userenum');
        
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs User                                         //
    //                                                    //
    //----------------------------------------------------//
    
    /**
     * API All Get User
     * 
     * Menthod: GET
     * 
     * Response: JSONObject
     * 
     */
    public function get_all_user_get() {
        
        //  Get collection 
        $get_collection = $this->Usermodel->getAllUser();
        
        $error = $this->Usermodel->getError();
//        echo $error;
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            Userenum::ID                => $value['_id']->{'$id'},
                            Userenum::FULL_NAME         => $value['full_name'],
                            Userenum::EMAIL             => $value['email'],        
                            Userenum::PHONE_NUMBER      => $value['phone_number'],
                            Userenum::ADDRESS           => $value['address'],
                            Userenum::LOCATION          => $value['location'],
                            Userenum::AVATAR            => CommonEnum::DOMAIN_NAME.CommonEnum::URL_USER_PROFILE.$value['avatar'],
                            Userenum::ROLE_LIST         => $value['role_list'],
                            CommonEnum::CREATED_DATE    => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
        
    }
    
    /**
     * API Get User by Id
     * 
     * Menthod: GET
     * 
     * @param String $id
     * 
     * Response: JSONObject
     * 
     */
    public function get_user_by_id_get() {
        
        //  Get param from client
        $id = $this->get('id');
        
        //  Get collection 
        $get_collection = $this->Usermodel->getUserById($id);
        
        $error = $this->Usermodel->getError();
//        echo $error;
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            Userenum::ID                => $value['_id']->{'$id'},
                            Userenum::FULL_NAME         => $value['full_name'],
                            Userenum::EMAIL             => $value['email'],        
                            Userenum::PHONE_NUMBER      => $value['phone_number'],
                            Userenum::ADDRESS           => $value['address'],
                            Userenum::LOCATION          => $value['location'],
                            Userenum::AVATAR            => CommonEnum::DOMAIN_NAME.CommonEnum::URL_USER_PROFILE.$value['avatar'],
                            Userenum::ROLE_LIST         => $value['role_list'],
                            CommonEnum::CREATED_DATE    => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
        
    }
    
    /**
     * API Update User
     * 
     * Menthod: POST
     * 
     * @param String $action:  insert | edit | delete
     * @param String $full_name
     * @param String $email
     * @param MD5    $password
     * @param String $phone_number
     * @param String $address
     * @param String $location
     * @param String $avatar
     * @param String $created_date
     * @param String $role_list
     * @param String $created_date
     * 
     * Response: JSONObject
     * 
     **/
    public function update_user_post() {
        
        //  Get param from client
        $action         = $this->post('action');

        $id             = $this->post('id');
        
        $full_name      = $this->post('full_name');
        $email          = $this->post('email');
        $password       = $this->post('password');
        $phone_number   = $this->post('phone_number');
        $address        = $this->post('address');
        $location       = $this->post('location');
        $avatar         = $this->post('avatar');
        $created_date   = $this->post('created_date');
        
        $role_list      = $this->post('role_list');// 527b512b3fce119ed62d8599, 527b512b3fce119ed62d8599
        
        (int)$is_insert = strcmp( strtolower($action), CommonEnum::INSERT );
        (int)$is_delete = strcmp( strtolower($action), CommonEnum::DELETE );
        
        $array_value = ($is_delete != 0) ? 
                
                array(
                        Userenum::FULL_NAME         => $full_name,
                        Userenum::EMAIL             => $email,        
                        Userenum::PASSWORD          => $password,
                        Userenum::PHONE_NUMBER      => $phone_number,
                        Userenum::ADDRESS           => $address,
                        Userenum::LOCATION          => $location,
                        Userenum::AVATAR            => $avatar,
                        Userenum::ROLE_LIST         => ( ($is_insert == 0) ) ? array(Userenum::DEFAULT_ROLE_LIST) : explode(CommonEnum::MARK, $role_list),
                        CommonEnum::CREATED_DATE    => $created_date
                
                ) : array();
        
        $this->Usermodel->updateUser($action, $id, $array_value);
        $error = $this->Usermodel->getError();
        
        if($error == null){
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
            );
            $this->response($data);
        }
        else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    /**
     * 
     * Login
     * 
     * @param String $email
     * @param MD5 $password
     * 
     * Response: JSONObject
     * 
     */
    public function login_post() {
        
        //  Get param from client
        $email      = $this->post('email');
        $password   = $this->post('password');
        
        $user = $this->Usermodel->login($email, $password);
        
        $results = array();
        
        foreach ($user as $value) {
            
            $results = array( 

                        CommonEnum::ID              => $value['_id']->{'$id'},
                        Userenum::FULL_NAME         => $value['full_name'],
                        Userenum::EMAIL             => $value['email'],        
                        Userenum::PHONE_NUMBER      => $value['phone_number'],
                        Userenum::ADDRESS           => $value['address'],
                        Userenum::LOCATION          => $value['location'],
                        Userenum::AVATAR            => CommonEnum::DOMAIN_NAME.Userenum::URL_AVATAR.$value['avatar'],
                        Userenum::ROLE_LIST         => $value['role_list'],
                        Userenum::CLOSED_MEMBER     => $value['closed_member'],
            );
                        
        }
        if(sizeof($results) == 0){
            $data =  array(
                   'Status'     =>'FALSE',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs Role                                         //
    //                                                    //
    //----------------------------------------------------//
    
    /**
     * API All Get Role
     * 
     * Menthod: GET
     * 
     * Response: JSONObject
     * 
     */
    public function get_all_role_get() {
        
        //  Get collection 
        $get_collection = $this->Usermodel->getAllRole();
        
        $error = $this->Usermodel->getError();
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            RoleEnum::ID                    => $value['_id']->{'$id'},
                            RoleEnum::NAME                  => $value['name'],
                            RoleEnum::DESC                  => $value['desc'],        
                            RoleEnum::FUNCTION_LIST         => $value['function_list'],
                            CommonEnum::CREATED_DATE        => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    /**
     * API All Get Role
     * 
     * Menthod: GET
     * 
     * @param String $id
     * 
     * Response: JSONObject
     * 
     */
    public function get_role_by_id_get() {
        
        //  Get param from client
        $id = $this->get('id');
        
        //  Get collection 
        $get_collection = $this->Usermodel->getRoleById($id);
        
        $error = $this->Usermodel->getError();
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            RoleEnum::ID                    => $value['_id']->{'$id'},
                            RoleEnum::NAME                  => $value['name'],
                            RoleEnum::DESC                  => $value['desc'],        
                            RoleEnum::FUNCTION_LIST         => $value['function_list'],
                            CommonEnum::CREATED_DATE        => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    /**
     * API Update Role
     * 
     * Menthod: POST
     * 
     * @param String $action
     * @param String $id
     * @param String $name
     * @param String $desc
     * @param String $function_list
     * @param String $created_date
     * 
     * Response: JSONObject
     * 
     **/
    public function update_role_post() {
        
        //  Get param from client
        $action             = $this->post('action');
        
        $id                 = $this->post('id');
        
        $name               = $this->post('name');
        $desc               = $this->post('desc');
        $function_list      = $this->post('function_list');
        $created_date       = $this->post('created_date');
        
        $array_value = array(
                        RoleEnum::NAME              => $name,
                        RoleEnum::DESC              => $desc,        
                        RoleEnum::FUNCTION_LIST     => explode(CommonEnum::MARK, $function_list),
                        CommonEnum::CREATED_DATE    => $created_date
                
                );
        
        $this->Usermodel->updateRole($action, $id, $array_value);
        $error = $this->Usermodel->getError();
        
        if($error == null){
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
            );
            $this->response($data);
        }
        else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs Function                                     //
    //                                                    //
    //----------------------------------------------------//
    
    /**
     * API All Get Function
     * 
     * Menthod: GET
     * 
     * Response: JSONObject
     * 
     */
    public function get_all_function_get() {
        
        //  Get collection 
        $get_collection = $this->Usermodel->getAllFunction();
        
        $error = $this->Usermodel->getError();
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            FunctionEnum::ID                    => $value['_id']->{'$id'},
                            FunctionEnum::NAME                  => $value['name'],
                            FunctionEnum::DESC                  => $value['desc'],        
                            CommonEnum::CREATED_DATE            => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    /**
     * API All Get function
     * 
     * Menthod: GET
     * 
     * @param String $id
     * 
     * Response: JSONObject
     * 
     */
    public function get_function_by_id_get() {
        
        //  Get param from client
        $id = $this->get('id');
        
        //  Get collection 
        $get_collection = $this->Usermodel->getFunctionById($id);
        
        $error = $this->Usermodel->getError();
        if($error == null){
        
            //  Array object
            $results = array();
            //  Count object
            $count = 0;
            foreach ($get_collection as $value){
                $count ++;
                //  Create JSONObject
                $jsonobject = array( 

                            RoleEnum::ID                    => $value['_id']->{'$id'},
                            RoleEnum::NAME                  => $value['name'],
                            RoleEnum::DESC                  => $value['desc'],        
                            CommonEnum::CREATED_DATE        => $value['created_date']

                           );
                $results[] = $jsonobject;
            }
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>$count,
                   'Results'    =>$results
            );
            $this->response($data);
            
        }else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
    /**
     * API Update Function
     * 
     * Menthod: POST
     * 
     * @param String $action
     * @param String $id
     * @param String $name
     * @param String $desc
     * @param String $created_date
     * 
     * Response: JSONObject
     * 
     **/
    public function update_function_post() {
        
        //  Get param from client
        $action             = $this->post('action');
        
        $id                 = $this->post('id');
        
        $name               = $this->post('name');
        $desc               = $this->post('desc');
        $created_date       = $this->post('created_date');
        
        $array_value = array(
                        RoleEnum::NAME              => $name,
                        RoleEnum::DESC              => $desc,        
                        CommonEnum::CREATED_DATE    => $created_date
                
                );
        
        $this->Usermodel->updateFunction($action, $id, $array_value);
        $error = $this->Usermodel->getError();
        
        if($error == null){
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
            );
            $this->response($data);
        }
        else{
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error
            );
            $this->response($data);
        }
    }
    
}
