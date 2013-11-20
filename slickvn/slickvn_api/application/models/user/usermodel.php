<?php

/**
 * 
 * This class connect and hands collection User, Role, Funcion
 * 
 */
class UserModel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        
        //  Load model COMMON
        $this->load->model('common/commonenum');
        $this->load->model('common/commonmodel');
        
        //  Load model USER
        $this->load->model('user/roleenum');
        $this->load->model('user/functionenum');
        $this->load->model('user/userlogenum');
        
    }
    
    /**
     * 
     * Get Error
     * 
     * @return String $error
     */
    public function getError() {
        return $this->Commonmodel->getError();
    }
    
    /**
     * 
     * Set Error
     * 
     * @return String $error
     * 
     */
    public function setError($e) {
        return $this->Commonmodel->setError($e);
    }
    
    //----------------------------------------------------------------------//
    //                                                                      //
    //                  FUNCTION FOR COLLECTION USER LOG                    //
    //                                                                      //
    //----------------------------------------------------------------------//
    
    //
    //  update 
    //
    
    //
    //  Count login
    //
    
    //
    //  Get list restaurant are visited
    //  
    //
    
    /**
     * 
     * Count User Log by Action of User: LOGIN | VISIT RESTAURANT | ASSESSMENT | COMMENT | LIKE | SHARE
     * 
     * @param String $id_restaurant
     * 
     * @return int
     * 
     */
    public function countUserLogByAction(array $where) {
        return (sizeof( $this->Commonmodel->searchCollection(Userlogenum::COLLECTION_USER_LOG, $where) ));
    }
    
    //----------------------------------------------------------------------//
    //                                                                      //
    //                  FUNCTION FOR COLLECTION USER                        //
    //                                                                      //
    //----------------------------------------------------------------------//
    
    /**
     * 
     * Get Collectin User
     * 
     * Return: Array Collection User
     * 
     */
    public function getAllUser() {

        return $this->Commonmodel->getCollection(Userenum::COLLECTION_USER);
        
    }
    
    /**
     * 
     * Get Collectin User by Id
     * 
     * @param String $id
     * 
     * Return: Collection User
     * 
     */
    public function getUserById($id) {
        
        return $this->Commonmodel->getCollectionById(Userenum::COLLECTION_USER, $id);
        
    }
    
    /**
     * 
     * Update Collection User
     * 
     * @param String $id
     * @param Array $array_value
     * 
     * @param String $action:  insert | edit | delete
     * 
     **/
    public function updateUser($action, $id, array $array_value) {
        
        try{
            
            if($action == null){ 
                $this->setError('Action is null'); return;
            }
            
            else{
                // Connect collection User
                $collection = Userenum::COLLECTION_USER;
                $this->collection = $this->Commonmodel->getConnectDataBase()->$collection;
                
                //  Action insert
                if( strcmp( strtolower($action), Commonenum::INSERT ) == 0 ) {
                    
                    //  Check email
                    $check_email = $this->Commonmodel->checkExistValue(Userenum::COLLECTION_USER, array(Userenum::EMAIL => $array_value[Userenum::EMAIL]) );
                    
                    if(sizeof($check_email) > 0){
                        $this->setError('Existing email'); return;
                    }

                    $this->collection ->insert( $array_value );
                    
                }

                //  Action edit
                else if( strcmp( strtolower($action), Commonenum::EDIT ) == 0 ){

                    if($id == null){$this->setError('Is is null'); return;}
                    $array_value[Commonenum::_ID] = new MongoId($id);
                    
                    $this->collection ->save( $array_value );
                }

                //  Action delete
                else if( strcmp( strtolower($action), Commonenum::DELETE ) == 0 ){

                    if($id == null){$this->setError('Id is null'); return;}
                    $where = array(
                                    Commonenum::_ID => new MongoId($id)
                                );
                    
                    $this->collection ->remove( $where );
                }
                else{
                    $this->setError('Action '.$action.' NOT support');
                }
                
            }
        }catch ( MongoConnectionException $e ){
                $this->setError($e->getMessage());
        }catch ( MongoException $e ){
                $this->setError($e->getMessage());
        }
        
    }
    
    /**
     * 
     * Get User Role List
     * 
     * @param String $user_id
     * 
     * @return Array id_role_list
     * 
     **/
    public function getUserRoleList($user_id) {
        
        $role_list = $this->getUserById($user_id);
        
        foreach ($role_list as $value){
            return $value['role_list'];
        }
    }
    
    /**
     * 
     * Login
     * 
     * @param String $email
     * @param MD5 $pass
     * 
     * @return Array Collection User
     */
    public function login($email, $pass) {
        
        $collection     = Userenum::COLLECTION_USER;
        
        $array_value = array(
                                Userenum::EMAIL => $email,
                                Userenum::PASSWORD => $pass,
                            );
        
        $user = $this->Commonmodel->checkExistValue($collection, $array_value);
        
        return $user;
        
    }
    
    //----------------------------------------------------------------------//
    //                                                                      //
    //                  FUNCTION FOR COLLECTION ROLE                        //
    //                                                                      //
    //----------------------------------------------------------------------//
    
    /**
     * 
     * Get Collectin Role
     * 
     * Return: Array Collection User
     * 
     */
    public function getAllRole() {

        return $this->Commonmodel->getCollection(Roleenum::COLLECTION_ROLE);
        
    }
    
    /**
     * 
     * Get Collectin Role by Id
     * 
     * @param String $id
     * 
     * Return: Array Collection User
     * 
     */
    public function getRoleById($id) {

        return $this->Commonmodel->getCollectionById(Roleenum::COLLECTION_ROLE, $id);
        
    }
    
    /**
     * 
     * Update Collection Role
     * 
     * @param String $id
     * @param Array $array_value
     * 
     * @param String $action:  insert | edit | delete
     * 
     **/
    public function updateRole($action, $id, array $array_value) {
        
        try{
            if($action == null){ 
                $this->setError('Action is null'); return;
            }
            
            else{
                // Connect collection User
                $collection = Roleenum::COLLECTION_ROLE;
                $this->collection = $this->Commonmodel->getConnectDataBase()->$collection;
                
                //  Action insert
                if( strcmp( strtolower($action), Commonenum::INSERT ) == 0 ) {
                    
                    $this->collection ->insert( $array_value );
                    
                }

                //  Action edit
                else if( strcmp( strtolower($action), Commonenum::EDIT ) == 0 ){

                    if($id == null){$this->setError('Is is null'); return;}
                    
                    $where = array(
                                    Commonenum::_ID => new MongoId($id)
                                );
                    
                    $this->collection ->update($where, array('$set' => $array_value) );
                }

                //  Action delete
                else if( strcmp( strtolower($action), Commonenum::DELETE ) == 0 ){
                    
                    if($id == null){$this->setError('Is is null'); return;}
                    
                    
                    
                    $where = array(
                                    Commonenum::_ID => new MongoId($id)
                                );
                    
                    $this->collection ->remove( $where );
                }
                else{
                    $this->setError('Action '.$action.' NOT support');
                }
                
            }
        }catch ( MongoConnectionException $e ){
                $this->setError($e->getMessage());
        }catch ( MongoException $e ){
                $this->setError($e->getMessage());
        }
    }
    
    //----------------------------------------------------------------------//
    //                                                                      //
    //                  FUNCTION FOR COLLECTION FUNCTION                        //
    //                                                                      //
    //----------------------------------------------------------------------//
    
    /**
     * 
     * Get Collectin Function
     * 
     * Return: Array Collection Function
     * 
     */
    public function getAllFunction() {

        return $this->Commonmodel->getCollection(Functionenum::COLLECTION_FUNCTION);
        
    }
    
    /**
     * 
     * Get Collectin Function by Id
     * 
     * @param String $id
     * 
     * Return: Array Collection Function
     * 
     */
    public function getFunctionById($id) {

        return $this->Commonmodel->getCollectionById(Functionenum::COLLECTION_FUNCTION, $id);
        
    }
    
    /**
     * 
     * Update Collection Function
     * 
     * @param String $id
     * @param Array $array_value
     * 
     * @param String $action:  insert | edit | delete
     * 
     **/
    public function updateFunction($action, $id, array $array_value) {
        
        try{
            if($action == null){ 
                $this->setError('Action is null'); return;
            }
            
            else{
                // Connect collection Function
                $collection = Functionenum::COLLECTION_FUNCTION;
                $this->collection = $this->Commonmodel->getConnectDataBase()->$collection;
                
                //  Action insert
                if( strcmp( strtolower($action), Commonenum::INSERT ) == 0 ) {
                    
                    $this->collection ->insert( $array_value );
                    
                }

                //  Action edit
                else if( strcmp( strtolower($action), Commonenum::EDIT ) == 0 ){

                    if($id == null){$this->setError('Is is null'); return;}
                    
                    $where = array(
                                    Commonenum::_ID => new MongoId($id)
                                );
                    
                    $this->collection ->update($where, array('$set' => $array_value) );
                }

                //  Action delete
                else if( strcmp( strtolower($action), Commonenum::DELETE ) == 0 ){
                    
                    if($id == null){$this->setError('Is is null'); return;}
                    
                    
                    
                    $where = array(
                                    Commonenum::_ID => new MongoId($id)
                                );
                    
                    $this->collection ->remove( $where );
                }
                else{
                    $this->setError('Action '.$action.' NOT support');
                }
                
            }
        }catch ( MongoConnectionException $e ){
                $this->setError($e->getMessage());
        }catch ( MongoException $e ){
                $this->setError($e->getMessage());
        }
    }
    
}

?>
