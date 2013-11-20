<?php

require APPPATH.'/libraries/REST_Controller.php';
/**
 * 
 * This class support APIs Restaurant for client
 *
 * @author Huynh Xinh
 * Date: 8/11/2013
 * 
 */
class restaurant_apis extends REST_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //  Load model RESTAURANT
        $this->load->model('restaurant/restaurantmodel');
        $this->load->model('restaurant/restaurantenum');
        $this->load->model('restaurant/couponenum');
        $this->load->model('restaurant/postenum');
        $this->load->model('restaurant/subscribedemailenum');
        $this->load->model('restaurant/closedmemberenum');
        $this->load->model('restaurant/menudishenum');
        
        //  Load model COMMON
        $this->load->model('common/commonmodel');
        $this->load->model('common/commonenum');
        
        //  Load model USER
        $this->load->model('user/usermodel');
        $this->load->model('user/userenum');
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs Assessment                                   //
    //                                                    //
    //----------------------------------------------------//
    
    /**
     * 
     * Get Assessment by Id Restaurant
     * 
     * @param int $limit
     * @param int $page
     * @param String $id_restaurant
     * 
     * Response: JSONObject
     * 
     */
    public function get_assessment_by_id_restaurant_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
        
        $id_restaurant = $this->get('id_restaurant');
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection Assessment
        $list_assessment    = $this->restaurantmodel->getAssessmentByIdRestaurant($id_restaurant);
        
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        
        foreach ($list_assessment as $assessment){

            $approval = $assessment['approval'];
            
            if( strcmp(strtoupper($approval), AssessmentEnum::APPROVAL_YES) == 0){
            
                $count ++ ;

                if(($count) >= $position_start_get && ($count) <= $position_end_get){

                    //  Get User of Assessment
                    $user = $this->Usermodel->getUserById($assessment['id_user']);
                    
                    //  Create JSONObject Restaurant
                    $jsonobject = array( 

                        AssessmentEnum::ID                          => $assessment['_id']->{'$id'},
                        AssessmentEnum::ID_USER                     => $assessment['id_user'],
                        AssessmentEnum::ID_RESTAURANT               => $assessment['id_restaurant'],
                        Userenum::FULL_NAME                         => $user[$assessment['id_user']]['full_name'],
                        Userenum::AVATAR                            => $user[$assessment['id_user']]['avatar'],
                        Userenum::NUMBER_ASSESSMENT                 => $this->restaurantmodel->countAssessmentForUser($assessment['id_user']),
                        AssessmentEnum::CONTENT                     => $assessment['content'],

                        AssessmentEnum::RATE_SERVICE                => $assessment['rate_service'],
                        AssessmentEnum::RATE_LANDSCAPE              => $assessment['rate_landscape'],
                        AssessmentEnum::RATE_TASTE                  => $assessment['rate_taste'],
                        AssessmentEnum::RATE_PRICE                  => $assessment['rate_price'],
                                
                        //  Number LIKE of Assessment
                        AssessmentEnum::NUMBER_LIKE                 => $this->Usermodel->countUserLogByAction(array ( 
                                                                                                                        UserLogEnum::ID_ASSESSMENT => $assessment['_id']->{'$id'}, 
                                                                                                                        UserLogEnum::ACTION        => Commonenum::LIKE_ASSESSMENT
                                                                                                                        )),
                        //  Number SHARE of Assessment
                        AssessmentEnum::NUMBER_SHARE                => $this->Usermodel->countUserLogByAction(array ( 
                                                                                                                        UserLogEnum::ID_ASSESSMENT => $assessment['_id']->{'$id'}, 
                                                                                                                        UserLogEnum::ACTION        => Commonenum::SHARE_ASSESSMENT
                                                                                                                        )),
                        AssessmentEnum::COMMENT_LIST                =>  $this->restaurantmodel->getCommentByIdAssessment($assessment['_id']->{'$id'}),
                                
                        Commonenum::CREATED_DATE                    => $assessment['created_date']
                                

                    );

                    $results[] = $jsonobject;

                }
            }
        }
        //  Response
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>  sizeof($results),
               'Results'    =>$results
        );
        $this->response($data);
        
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs Menu Dish                                    //
    //                                                    //
    //----------------------------------------------------//
    
    /**
     * 
     *  API get all Menu Dish
     * 
     *  Menthod: GET
     * 
     *  Response: JSONObject
     * 
     */
    public function get_all_menu_dish_get() {
        
        $list_menu_dish = $this->restaurantmodel->getMenuDish();
        
        $results = array();
        
        foreach ($list_menu_dish as $menu_dish) {
            
            $jsonobject = array(
                
                    Menudishenum::ID                => $menu_dish['_id']->{'$id'},
                    Menudishenum::ID_RESTAURANT     => $menu_dish['id_restaurant'],
                    Menudishenum::DISH_LIST         => $menu_dish['dish_list'],        
//                    Menudishenum::NAME              => $menu_dish['name'],
//                    Menudishenum::DESC              => $menu_dish['desc'],
//                    Menudishenum::PRICE             => $menu_dish['price'],
//                    Menudishenum::SIGNATURE_DISH    => $menu_dish['signature_dish'],
//                    Menudishenum::LINK_IMAGE        => $menu_dish['link_image'],
                
                    Commonenum::CREATED_DATE        => $menu_dish['created_date']
                );
            $results [] = $jsonobject;
                    
        }
        
        //  Response
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>  sizeof($results),
               'Results'    =>$results
        );
        $this->response($data);
        
    }
    
    //----------------------------------------------------//
    //                                                    //
    //  APIs Restaurant                                   //
    //                                                    //
    //----------------------------------------------------//

    /**
     * 
     *  API search Restaurant by Name
     * 
     *  Menthod: GET
     * 
     *  @param int    $limit
     *  @param int    $page
     *  @param String $key
     * 
     *  Response: JSONObject
     * 
     */
    public function search_restaurant_by_name_get() {
        
        //  Get param from client
        $limit = $this->get("limit");
        $page = $this->get("page");

        //  Key search
        $key = $this->get('key');
        
        //  Query
        $where = array(Restaurantenum::NAME => new MongoRegex('/'.$key.'/i'));
        $list_restaurant = $this->restaurantmodel->searchRestaurant($where);
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        if (sizeof($list_restaurant) > 0){
            
            foreach ($list_restaurant as $restaurant){
                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];
                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                if($interval_expired >=0 && $is_delete == 0){

                    $count ++;

                    if(($count) >= $position_start_get && ($count) <= $position_end_get){

                        //  Create JSONObject Restaurant
                        $jsonobject = array( 

                            Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                            Restaurantenum::ID_USER                    => $restaurant['id_user'],
                            Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                            Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],
                            Restaurantenum::NAME                       => $restaurant['name'],
							Restaurantenum::AVATAR                     => $restaurant['avatar'],

                            Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],
                            Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($restaurant['_id']->{'$id'}),
                            Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),

							Restaurantenum::FAVOURITE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::FAVOURITE_TYPE,   $restaurant['favourite_list']),
							Restaurantenum::PRICE_PERSON_LIST      		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PRICE_PERSON,   $restaurant['price_person_list']),
							Restaurantenum::CULINARY_STYLE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::CULINARY_STYLE,   $restaurant['culinary_style_list']),
							
                            Restaurantenum::NUMBER_LIKE                => 0,
                            Restaurantenum::NUMBER_SHARE               => 0,

                            Restaurantenum::RATE_SERVICE               => $this->restaurantmodel->getRateService(),
                            Restaurantenum::RATE_LANDSCAPE             => $this->restaurantmodel->getRateLandscape(),
                            Restaurantenum::RATE_TASTE                 => $this->restaurantmodel->getRateTaste(),
                            Restaurantenum::RATE_PRICE                 => $this->restaurantmodel->getRatePrice(),

                            Restaurantenum::ADDRESS                    => $restaurant['address'],
                            Restaurantenum::CITY                       => $restaurant['city'],
                            Restaurantenum::DISTRICT                   => $restaurant['district'],
                            Restaurantenum::EMAIL                      => $restaurant['email'],
                            Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                            Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'] 

                        );

                        $results[] = $jsonobject;
                    }
                }
            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
    }
    
    /**
     * 
     *  API search Restaurant by Id of Base colleciont
     * 
     *  Menthod: GET
     * 
     *  @param int    $limit
     *  @param int    $page
     *  @param String $key: id of FAVOURITE, PRICE_PERSON, MODE_USE, PAYMENT_TYPE, LANDSCAPE_LIST, OTHER_CRITERIA
     * 
     *  Response: JSONObject
     * 
     */
    public function search_restaurant_by_id_base_collection_get() {
        
        //  Get param from client
        $limit = $this->get("limit");
        $page  = $this->get("page");

        //  Field search
        $field = $this->get('field');
        //  Key search
        $key  = $this->get('key');
        
        //  Query
        $where = array($field => array('$in' => array($key)) );
        $list_restaurant = $this->restaurantmodel->searchRestaurant($where);
        
        //  End
        $position_end_get   = ($page == 1) ? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1) ? $page : ( $position_end_get - ($limit - 1) );
        
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        if (sizeof($list_restaurant) > 0){
            
            foreach ($list_restaurant as $restaurant){
                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];
                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                if($interval_expired >=0 && $is_delete == 0){

                    $count ++;

                    if(($count) >= $position_start_get && ($count) <= $position_end_get){

                        //  Create JSONObject Restaurant
                        $jsonobject = array( 

                            Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                            Restaurantenum::ID_USER                    => $restaurant['id_user'],
                            Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                            Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],
                            Restaurantenum::NAME                       => $restaurant['name'],
							Restaurantenum::AVATAR                     => $restaurant['avatar'],

                            Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],
                            Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($restaurant['_id']->{'$id'}),
                            Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),

							Restaurantenum::FAVOURITE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::FAVOURITE_TYPE,   $restaurant['favourite_list']),
							Restaurantenum::PRICE_PERSON_LIST      		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PRICE_PERSON,   $restaurant['price_person_list']),
							Restaurantenum::CULINARY_STYLE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::CULINARY_STYLE,   $restaurant['culinary_style_list']),
							
                            Restaurantenum::NUMBER_LIKE                => 0,
                            Restaurantenum::NUMBER_SHARE               => 0,

                            Restaurantenum::RATE_SERVICE               => $this->restaurantmodel->getRateService(),
                            Restaurantenum::RATE_LANDSCAPE             => $this->restaurantmodel->getRateLandscape(),
                            Restaurantenum::RATE_TASTE                 => $this->restaurantmodel->getRateTaste(),
                            Restaurantenum::RATE_PRICE                 => $this->restaurantmodel->getRatePrice(),

                            Restaurantenum::ADDRESS                    => $restaurant['address'],
                            Restaurantenum::CITY                       => $restaurant['city'],
                            Restaurantenum::DISTRICT                   => $restaurant['district'],
                            Restaurantenum::EMAIL                      => $restaurant['email'],
                            Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                            Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],

                        );

                        $results[] = $jsonobject;
                    }
                }
            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
    }
    
    /**
     * 
     *  API search Restaurant by Coupon
     * 
     *  Menthod: GET
     * 
     *  @param int    $limit
     *  @param int    $page
     *  @param String $key
     * 
     *  Response: JSONObject
     * 
     */
    public function search_restaurant_by_coupon_get() {
        
        //  Get param from client
        $limit = $this->get("limit");
        $page = $this->get("page");

        //  Key search
        $key = $this->get('key');
        
        //  Query
        $where = array(Restaurantenum::NAME => new MongoRegex('/'.$key.'/i'));
        $list_restaurant = $this->restaurantmodel->searchRestaurant($where);
        
        //  End
        $position_end_get   = ($page == 1) ? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1) ? $page : ( $position_end_get - ($limit - 1) );
        
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        if (sizeof($list_restaurant) > 0){
            
            foreach ($list_restaurant as $restaurant){
                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];
                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                //  Is coupon
                $is_coupon = ($restaurant['id_coupon'] == null) ? 0 : 1;
                
                if($interval_expired >=0 && $is_delete == 0 && $is_coupon == 1){

                    $count ++;

                    if(($count) >= $position_start_get && ($count) <= $position_end_get){

                        //  Create JSONObject Restaurant
                        $jsonobject = array( 

                            Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                            Restaurantenum::ID_USER                    => $restaurant['id_user'],
                            Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                            Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],

                            Restaurantenum::NAME                       => $restaurant['name'],
                            Restaurantenum::RATE_POINT                 => $restaurant['rate_point'],
                            Restaurantenum::ADDRESS                    => $restaurant['address'],
                            Restaurantenum::CITY                       => $restaurant['city'],
                            Restaurantenum::DISTRICT                   => $restaurant['district'],
                            Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                            Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],
                            Restaurantenum::LINK_TO                    => $restaurant['link_to'],
                            Restaurantenum::PHONE_NUMBER               => $restaurant['phone_number'],
                            Restaurantenum::WORKING_TIME               => $restaurant['working_time'],
                            Restaurantenum::STATUS_ACTIVE              => $restaurant['status_active'],
                            Restaurantenum::FAVOURITE_LIST             => $restaurant['favourite_list'],
                            Restaurantenum::PRICE_PERSON_LIST          => $restaurant['price_person_list'],
                            Restaurantenum::CULINARY_STYLE_LIST        => $restaurant['culinary_style_list'],
                            Restaurantenum::MODE_USE_LIST              => $restaurant['mode_use_list'],
                            Restaurantenum::PAYMENT_TYPE_LIST          => $restaurant['payment_type_list'],
                            Restaurantenum::LANDSCAPE_LIST             => $restaurant['landscape_list'],
                            Restaurantenum::OTHER_CRITERIA_LIST        => $restaurant['other_criteria_list'],
                            Restaurantenum::INTRODUCE                  => $restaurant['introduce'],
                            Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],

                            Restaurantenum::START_DATE                 => $restaurant['start_date'],
                            Restaurantenum::END_DATE                   => $restaurant['end_date'],

                            Commonenum::CREATED_DATE                   => $restaurant['created_date'] 

                        );

                        $results[] = $jsonobject;
                    }
                }
            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
    }
    
    /**
     * 
     *  API search Restaurant by Meal type
     * 
     *  Menthod: GET
     * 
     *  @param int    $limit
     *  @param int    $page
     *  @param String $key
     * 
     *  Response: JSONObject
     * 
     */
    public function search_restaurant_by_meal_get() {
        
        //  Get param from client
        $limit = $this->get("limit");
        $page = $this->get("page");

		//
        //  Edit field number_view: +1
        //
        
		
        //  Key search
        $key = $this->get('key');
        
        //  Query find collection Menu Dish by name
        $where = array(Menudishenum::DISH_LIST.'.'.Menudishenum::NAME => new MongoRegex('/'.$key.'/i'));
        $list_menu_dish = $this->restaurantmodel->searchMenuDish($where);
        
        //  List restaurant
        $list_restaurant = array();
        
        if (sizeof($list_menu_dish) > 0){
            
            foreach ($list_menu_dish as $menu_dish){

                $restaurant = $this->restaurantmodel->getRestaurantById($menu_dish['id_restaurant']);
                
                if($restaurant != null){
                    $list_restaurant[] = $restaurant;
                }
            }
        }
        
        //  End
        $position_end_get   = ($page == 1) ? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1) ? $page : ( $position_end_get - ($limit - 1) );
        
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        if (sizeof($list_restaurant) > 0){
            
            //  Current date
            $current_date = $this->commonmodel->getCurrentDate();
            
            foreach ($list_restaurant as $array_restaurant){
                
                foreach ($array_restaurant as $restaurant){
                    //  End date
                    $end_date = $restaurant['end_date'];
                    //  Get interval expired
                    $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                    //  Is delete
                    $is_delete = $restaurant['is_delete'];

                    if($interval_expired >=0 && $is_delete == 0){

                        $count ++;

                        if(($count) >= $position_start_get && ($count) <= $position_end_get){

                            //  Create JSONObject Restaurant
                            $jsonobject = array( 

                                Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                                Restaurantenum::ID_USER                    => $restaurant['id_user'],
                                Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                                Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],
								Restaurantenum::AVATAR					   => $restaurant['avatar'],
                                Restaurantenum::NAME                       => $restaurant['name'],
                                Restaurantenum::ADDRESS                    => $restaurant['address'],
                                Restaurantenum::CITY                       => $restaurant['city'],
                                Restaurantenum::DISTRICT                   => $restaurant['district'],
                                Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                                Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],
                                Restaurantenum::LINK_TO                    => $restaurant['link_to'],
                                Restaurantenum::PHONE_NUMBER               => $restaurant['phone_number'],
                                Restaurantenum::WORKING_TIME               => $restaurant['working_time'],
								
                                Restaurantenum::STATUS_ACTIVE              => $restaurant['status_active'],
								
                                //Restaurantenum::FAVOURITE_LIST             => $restaurant['favourite_list'],
                                //Restaurantenum::PRICE_PERSON_LIST          => $restaurant['price_person_list'],
                                //Restaurantenum::CULINARY_STYLE_LIST        => $restaurant['culinary_style_list'],
								
								Restaurantenum::FAVOURITE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::FAVOURITE_TYPE,   $restaurant['favourite_list']),
							    Restaurantenum::PRICE_PERSON_LIST      		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PRICE_PERSON,   $restaurant['price_person_list']),
							    Restaurantenum::CULINARY_STYLE_LIST    		   => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::CULINARY_STYLE,   $restaurant['culinary_style_list']),
								
								
                                Restaurantenum::MODE_USE_LIST              => $restaurant['mode_use_list'],
                                Restaurantenum::PAYMENT_TYPE_LIST          => $restaurant['payment_type_list'],
                                Restaurantenum::LANDSCAPE_LIST             => $restaurant['landscape_list'],
                                Restaurantenum::OTHER_CRITERIA_LIST        => $restaurant['other_criteria_list'],
                                Restaurantenum::INTRODUCE                  => $restaurant['introduce'],
								
                                Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],
								Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($restaurant['_id']->{'$id'}),
								Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),
										
								Restaurantenum::NUMBER_LIKE                => 0,
								Restaurantenum::NUMBER_SHARE               => 0,
										
								Restaurantenum::RATE_SERVICE               => $this->restaurantmodel->getRateService(),
								Restaurantenum::RATE_LANDSCAPE             => $this->restaurantmodel->getRateLandscape(),
								Restaurantenum::RATE_TASTE                 => $this->restaurantmodel->getRateTaste(),
								Restaurantenum::RATE_PRICE                 => $this->restaurantmodel->getRatePrice(),

                                Restaurantenum::START_DATE                 => $restaurant['start_date'],
                                Restaurantenum::END_DATE                   => $restaurant['end_date'],

                                Commonenum::CREATED_DATE                   => $restaurant['created_date'] 

                            );

                            $results[] = $jsonobject;
                        }
                    }
                }
                
            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
    }
    
    /**
     * API Get Restaurant by Id
     * 
     * Menthod: GET
     * 
     * @param String $id
     * 
     * Response: JSONObject
     * 
     */
    public function get_detail_restaurant_get() {
        
        //  Get param from client
        $id = $this->get('id');
        
        //
        //  Edit field number_view: +1
        //
        $this->commonmodel->editSpecialField(Restaurantenum::COLLECTION_RESTAURANT, $id, array('$inc' => array('number_view' => 1) ) );
        
        //  Get collection 
        $get_collection = $this->restaurantmodel->getRestaurantById($id);
        
        $error = $this->restaurantmodel->getError();

        if($error == null){
            //  Array object restaurant
            $results = array();

            foreach ($get_collection as $restaurant){

                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];

                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                if($interval_expired >= 0 && $is_delete == 0){


                    //  Create JSONObject Restaurant
                    $jsonobject = array( 

                        Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                        Restaurantenum::ID_USER                    => $restaurant['id_user'],
                        Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                        Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],
                        Restaurantenum::NAME                       => $restaurant['name'],
                                
                        Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],
                        Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($id),
                        Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),
                                
                        Restaurantenum::NUMBER_LIKE                => 0,
                        Restaurantenum::NUMBER_SHARE               => 0,
                                
                        Restaurantenum::RATE_SERVICE               => $this->restaurantmodel->getRateService(),
                        Restaurantenum::RATE_LANDSCAPE             => $this->restaurantmodel->getRateLandscape(),
                        Restaurantenum::RATE_TASTE                 => $this->restaurantmodel->getRateTaste(),
                        Restaurantenum::RATE_PRICE                 => $this->restaurantmodel->getRatePrice(),
                                
                        Restaurantenum::ADDRESS                    => $restaurant['address'],
                        Restaurantenum::CITY                       => $restaurant['city'],
                        Restaurantenum::DISTRICT                   => $restaurant['district'],
                        Restaurantenum::EMAIL                      => $restaurant['email'],
                        Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                        Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],
                        Restaurantenum::LINK_TO                    => $restaurant['link_to'],
                        Restaurantenum::PHONE_NUMBER               => $restaurant['phone_number'],
                        Restaurantenum::WORKING_TIME               => $restaurant['working_time'],
                        Restaurantenum::STATUS_ACTIVE              => $restaurant['status_active'],
                        Restaurantenum::FAVOURITE_LIST             => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::FAVOURITE_TYPE,   $restaurant['favourite_list']),
                        Restaurantenum::PRICE_PERSON_LIST          => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PRICE_PERSON,     $restaurant['price_person_list']),
                        Restaurantenum::CULINARY_STYLE_LIST        => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::CULINARY_STYLE,   $restaurant['culinary_style_list']),
                        Restaurantenum::MODE_USE_LIST              => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::MODE_USE,         $restaurant['mode_use_list']),
                        Restaurantenum::PAYMENT_TYPE_LIST          => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PAYMENT_TYPE,     $restaurant['payment_type_list']),
                        Restaurantenum::LANDSCAPE_LIST             => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::LANDSCAPE,        $restaurant['landscape_list']),
                        Restaurantenum::OTHER_CRITERIA_LIST        => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::OTHER_CRITERIA,   $restaurant['other_criteria_list']),
                        Restaurantenum::INTRODUCE                  => $restaurant['introduce'],
                        Restaurantenum::START_DATE                 => $restaurant['start_date'],
                        Restaurantenum::END_DATE                   => $restaurant['end_date'],
                        Restaurantenum::DESC                       => $restaurant['desc'],        
                        Commonenum::CREATED_DATE                   => $restaurant['created_date'] 

                    );

                    $results[] = $jsonobject;


                }


            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );
            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>  $error
            );
            $this->response($data);
        }
        
    }
    
    /**
     * 
     *  API get All Restaurant approval show carousel
     * 
     *  Menthod: GET
     * 
     *  @param int $limit
     *  @param int $page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_all_restaurant_approval_show_carousel_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        $list_order_by_restaurant = $this->restaurantmodel->orderByRestaurant( -1 );
        $error = $this->restaurantmodel->getError();
        if($error == null){

            //  Array object restaurant
            $results = array();

            //  Count object restaurant
            $count = 0;

            foreach ($list_order_by_restaurant as $restaurant){
                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];

                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                $approval_show_carousel = $restaurant['approval_show_carousel'];
                
                if( ($interval_expired >= 0 && $is_delete == 0) && $approval_show_carousel == 1){

                    $count ++;

                    if(($count) >= $position_start_get && ($count) <= $position_end_get){

                        //  Create JSONObject Restaurant
                        $jsonobject = array( 

                            Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                            Restaurantenum::NAME                       => $restaurant['name'],
                            Restaurantenum::ADDRESS                    => $restaurant['address'].', '.$restaurant['district'].', '.$restaurant['city'],
                            Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],
                            Restaurantenum::LINK_TO                    => $restaurant['link_to'],

                        );

                        $results[] = $jsonobject;

                    }

                }


            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );


            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error,
            );
            $this->response($data);
        }
        
    }
    
    /**
     * 
     *  API get Order By DESC Restaurant
     * 
     *  Menthod: GET
     * 
     *  @param int $limit
     *  @param int $page
     *  @param int $order_by
     * 
     *  Response: JSONObject
     * 
     */
    public function get_order_by_restaurant_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
        
        $order_by = ($this->get("order_by") == null)? 1 : (int)$this->get("order_by");
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        $list_order_by_restaurant = $this->restaurantmodel->orderByRestaurant( $order_by );
        $error = $this->restaurantmodel->getError();
        if($error == null){

            //  Array object restaurant
            $results = array();

            //  Count object restaurant
            $count = 0;

            foreach ($list_order_by_restaurant as $restaurant){
                //  Current date
                $current_date = $this->commonmodel->getCurrentDate();

                //  End date
                $end_date = $restaurant['end_date'];

                //  Get interval expired
                $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

                //  Is delete
                $is_delete = $restaurant['is_delete'];

                if($interval_expired >= 0 && $is_delete == 0){

                    $count ++;

                    if(($count) >= $position_start_get && ($count) <= $position_end_get){

                        //  Create JSONObject Restaurant
                        $jsonobject = array( 

                            Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                            Restaurantenum::ID_USER                    => $restaurant['id_user'],
                            Restaurantenum::ID_MENU_DISH               => $restaurant['id_menu_dish'],
                            Restaurantenum::ID_COUPON                  => $restaurant['id_coupon'],

                            Restaurantenum::NAME                       => $restaurant['name'],
                            Restaurantenum::RATE_POINT                 => $restaurant['rate_point'],
                            Restaurantenum::ADDRESS                    => $restaurant['address'],
                            Restaurantenum::CITY                       => $restaurant['city'],
                            Restaurantenum::DISTRICT                   => $restaurant['district'],
                            Restaurantenum::IMAGE_INTRODUCE_LINK       => $restaurant['image_introduce_link'],
                            Restaurantenum::IMAGE_CAROUSEL_LINK        => $restaurant['image_carousel_link'],
                            Restaurantenum::LINK_TO                    => $restaurant['link_to'],
                            Restaurantenum::PHONE_NUMBER               => $restaurant['phone_number'],
                            Restaurantenum::WORKING_TIME               => $restaurant['working_time'],
                            Restaurantenum::STATUS_ACTIVE              => $restaurant['status_active'],
                            Restaurantenum::FAVOURITE_LIST             => $restaurant['favourite_list'],
                            Restaurantenum::PRICE_PERSON_LIST          => $restaurant['price_person_list'],
                            Restaurantenum::CULINARY_STYLE_LIST        => $restaurant['culinary_style_list'],
                            Restaurantenum::MODE_USE_LIST              => $restaurant['mode_use_list'],
                            Restaurantenum::PAYMENT_TYPE_LIST          => $restaurant['payment_type_list'],
                            Restaurantenum::LANDSCAPE_LIST             => $restaurant['landscape_list'],
                            Restaurantenum::OTHER_CRITERIA_LIST        => $restaurant['other_criteria_list'],
                            Restaurantenum::INTRODUCE                  => $restaurant['introduce'],
                            Restaurantenum::NUMBER_VIEW                => $restaurant['number_view'],

                            Restaurantenum::START_DATE                 => $restaurant['start_date'],
                            Restaurantenum::END_DATE                   => $restaurant['end_date'],

                            Commonenum::CREATED_DATE                   => $restaurant['created_date'] 

                        );

                        $results[] = $jsonobject;

                    }

                }


            }
            //  Response
            $data =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Total'      =>  sizeof($results),
                   'Results'    =>$results
            );


            $this->response($data);
        }
        else{
            //  Response
            $data =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>$error,
            );
            $this->response($data);
        }
        
    }
    
    /**
     * 
     *  API get Newest Restaurant
     * 
     *  Menthod: GET
     * 
     *  @param int $limit
     *  @param int $page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_newest_restaurant_list_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection restaurant
        $collection_name = Restaurantenum::COLLECTION_RESTAURANT;
        $list_restaurant = $this->commonmodel->getCollection($collection_name);
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        
        foreach ($list_restaurant as $restaurant){
            //  Get created date
            $created_date = $restaurant['created_date'];

            //  Current date
            $current_date = $this->commonmodel->getCurrentDate();

            //  End date
            $end_date = $restaurant['end_date'];

            //  Get interval expired
            $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

            //  Is delete
            $is_delete = $restaurant['is_delete'];
            
            //  Get interval
            $interval = $this->commonmodel->getInterval($created_date, $current_date);
//            var_dump($created_date);
//            var_dump($current_date);
//            var_dump($interval);
            if( (($interval <= Commonenum::INTERVAL_NEWST_RESTAURANT) && $interval >=0) && ($interval_expired >=0 && $is_delete == 0) ){
                
                $count ++ ;
                
                if(($count) >= $position_start_get && ($count) <= $position_end_get){
                    
                    //  Create JSONObject Restaurant
                    $jsonobject = array( 

                        Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                        Restaurantenum::NAME                       => $restaurant['name'],
                        Restaurantenum::DESC                       => $restaurant['desc'],
                        Restaurantenum::AVATAR                     => $restaurant['avatar'],
                        Restaurantenum::ADDRESS                    => $restaurant['address'].', '.$restaurant['district'].', '.$restaurant['city'],
                        Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($restaurant['_id']->{'$id'}),
                        Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),
                        Restaurantenum::NUMBER_LIKE                => 0


                    );
                
                    $results[] = $jsonobject;
                    
                    $this->restaurantmodel->setRateService(0);
                    $this->restaurantmodel->setRateLandscape(0);
                    $this->restaurantmodel->setRateTaste(0);
                    $this->restaurantmodel->setRatePrice(0);
                    
                }
            }
            
        }
        //  Response
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>  sizeof($results),
               'Results'    =>$results
        );
        $this->response($data);
    }
    
    /**
     * 
     *  API get Order Restaurant
     * 
     *  Menthod: GET
     * 
     *  @param int $limit
     *  @param int $page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_orther_restaurant_list_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
                
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection restaurant
        $collection_name = Restaurantenum::COLLECTION_RESTAURANT;
        $list_restaurant = $this->commonmodel->getCollection($collection_name);
        //  Array object restaurant
        $results = array();
        
        //  Count object restaurant
        $count = 0;
        
        //  Count result
        $count_result = 0;
        
        foreach ($list_restaurant as $restaurant){
            //  Get created date
            $created_date = $restaurant['created_date'];

            //  Current date
            $current_date = $this->commonmodel->getCurrentDate();

            //  End date
            $end_date = $restaurant['end_date'];

            //  Get interval expired
            $interval_expired = $this->commonmodel->getInterval($current_date, $end_date);

            //  Is delete
            $is_delete = $restaurant['is_delete'];
            
            //  Get interval
            $interval = $this->commonmodel->getInterval($created_date, $current_date);
            
            if( ($interval > Commonenum::INTERVAL_NEWST_RESTAURANT) && ($interval_expired >=0 && $is_delete == 0) ){
                
                $count++;
                
                
                
                if(($count) >= $position_start_get && ($count) <= $position_end_get){
                    
                    $count_result ++ ;
                
                    //  Create JSONObject Restaurant
                    $jsonobject = array( 

                        Restaurantenum::ID                         => $restaurant['_id']->{'$id'},
                        Restaurantenum::NAME                       => $restaurant['name'],
                        Restaurantenum::DESC                       => $restaurant['desc'],
                        Restaurantenum::AVATAR                     => $restaurant['avatar'],
                        Restaurantenum::ADDRESS                    => $restaurant['address'].', '.$restaurant['district'].', '.$restaurant['city'],
                        Restaurantenum::NUMBER_ASSESSMENT          => $this->restaurantmodel->countAssessmentForRestaurant($restaurant['_id']->{'$id'}),
                        Restaurantenum::RATE_POINT                 => $this->restaurantmodel->getRatePoint(),
                        Restaurantenum::NUMBER_LIKE                => 0


                    );
                
                    $results[] = $jsonobject;
                    
                    $this->restaurantmodel->setRateService(0);
                    $this->restaurantmodel->setRateLandscape(0);
                    $this->restaurantmodel->setRateTaste(0);
                    $this->restaurantmodel->setRatePrice(0);
                    
                }
            }
            
        }
        
        //  Response
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>sizeof($results),
               'Results'    =>$results
        );

        $this->response($data);
    }
    
    
    /**
     * 
     * API update Restaurant
     * 
     * Menthod: POST
     * 
     * $action: insert | edit | delete
        
     * @param String $id
     * @param String $id_user
     * @param String $id_menu_dish
     * @param String $id_coupon
     * @param String $name
     * @param int    $rate_point
     * @param String $address
     * @param String $city
     * @param String $district
     * @param String $image_introduce_link
     * @param String $image_carousel_link
     * @param String $link_to
     * @param String $phone_number
     * @param String $working_time
     * @param String $status_active
     * @param String $favourite_list
     * @param String $price_person_list
     * @param String $culinary_style_list
     * @param String $mode_use_list
     * @param String $payment_type_list
     * @param String $landscape_list
     * @param String $other_criteria_list
     * @param String $introduce
     * @param int    $number_view
     * @param String $start_date
     * @param String $end_date
     * @param String $created_date
     * @param int    $is_delete
     * 
     *  Response: JSONObject
     * 
     */
    public function update_restaurant_post(){
        
        //  Get param from client
        $action                  = $this->post('action'); 
        
        $id                      = $this->post('id'); 
        $id_user                 = $this->post('id_user');
        $id_menu_dish            = $this->post('id_menu_dish');
        $id_coupon               = $this->post('id_coupon');
        $name                    = $this->post('name');
        $rate_point              = $this->post('rate_point');
        $address                 = $this->post('address');
        $city                    = $this->post('city');
        $district                = $this->post('district');
        $image_introduce_link    = $this->post('image_introduce_link');
        $image_carousel_link     = $this->post('image_carousel_link');
        $link_to                 = $this->post('link_to');
        $phone_number            = $this->post('phone_number');
        $working_time            = $this->post('working_time');
        $status_active           = $this->post('status_active');
        $favourite_list          = $this->post('favourite_list');
        $price_person_list       = $this->post('price_person_list');
        $culinary_style_list     = $this->post('culinary_style_list');
        $mode_use_list           = $this->post('mode_use_list');
        $payment_type_list       = $this->post('payment_type_list');
        $landscape_list          = $this->post('landscape_list');
        $other_criteria_list      = $this->post('other_criteria');
        $introduce               = $this->post('introduce');
        $number_view             = $this->post('number_view');
        $start_date              = $this->post('start_date');
        $end_date                = $this->post('end_date');
        $created_date            = $this->post('created_date');
        $is_delete               = $this->post('is_delete');
        
        (int)$is_insert = strcmp( strtolower($action), Commonenum::INSERT );
        
        $array_value = array( 

            Restaurantenum::ID                         => $id,
            Restaurantenum::ID_USER                    => $id_user,
            Restaurantenum::ID_MENU_DISH               => $id_menu_dish,
            Restaurantenum::ID_COUPON                  => $id_coupon,

            Restaurantenum::NAME                       => $name,
            Restaurantenum::RATE_POINT                 => (int)$rate_point,
            Restaurantenum::ADDRESS                    => $address,
            Restaurantenum::CITY                       => $city,
            Restaurantenum::DISTRICT                   => $district,
            Restaurantenum::IMAGE_INTRODUCE_LINK       => ($image_introduce_link != null ) ? explode(Commonenum::MARK, $image_introduce_link): array(),
            Restaurantenum::IMAGE_CAROUSEL_LINK        => $image_carousel_link,
            Restaurantenum::LINK_TO                    => $link_to,
            Restaurantenum::PHONE_NUMBER               => $phone_number,
            Restaurantenum::WORKING_TIME               => $working_time,
            Restaurantenum::STATUS_ACTIVE              => $status_active,
            Restaurantenum::FAVOURITE_LIST             => ($favourite_list != null ) ? explode(Commonenum::MARK, $favourite_list): array(),
            Restaurantenum::PRICE_PERSON_LIST          => ($price_person_list != null ) ? explode(Commonenum::MARK, $price_person_list): array(),
            Restaurantenum::CULINARY_STYLE_LIST        => ($culinary_style_list != null ) ? explode(Commonenum::MARK, $culinary_style_list): array(),
            
            Restaurantenum::MODE_USE_LIST              => ($mode_use_list != null ) ? explode(Commonenum::MARK, $mode_use_list): array(),
            Restaurantenum::PAYMENT_TYPE_LIST          => ($payment_type_list != null ) ? explode(Commonenum::MARK, $payment_type_list): array(),
            Restaurantenum::LANDSCAPE_LIST             => ($landscape_list != null ) ? explode(Commonenum::MARK, $landscape_list): array(),
            Restaurantenum::OTHER_CRITERIA_LIST        => ($other_criteria_list != null ) ? explode(Commonenum::MARK, $other_criteria_list): array(),
            
            Restaurantenum::INTRODUCE                  => $introduce,
            Restaurantenum::NUMBER_VIEW                => (int)$number_view,

            Restaurantenum::START_DATE                 => $start_date,
            Restaurantenum::END_DATE                   => $end_date,

            Commonenum::CREATED_DATE                   => ($is_insert == 0 ) ? $this->commonmodel->getCurrentDate(): $created_date,
            Restaurantenum::IS_DELETE                  => ($is_insert == 0 ) ? Restaurantenum::DEFAULT_IS_DELETE : (int)$is_delete
                
        );
        
        $this->restaurantmodel->updateRestaurant($action, $id, $array_value);
        $error = $this->restaurantmodel->getError();
        
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
    
    
    
    //------------------------------------------------------
    //                                                     /
    //  APIs Coupon                                        /
    //                                                     /
    //------------------------------------------------------
    
    /**
     * 
     *  API get Coupon
     * 
     *  Menthod: GET
     * 
     *  @param $limit
     *  @param $page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_coupon_list_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
                
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection coupon
        $collection_name = Couponenum::COLLECTION_NAME;
        $list_coupon = $this->commonmodel->getCollection($collection_name);
        
        //  Array object coupon
        $results = array();
        
        //  Count object coupon
        $count = 0;
        
        //  Count result
        $count_result = 0;
        
        foreach ($list_coupon as $coupon){
            
            //  Get deal to date
            $deal_to_date = $coupon['deal_to_date'];

            //  Get now date
            $now_date = new DateTime();

            //  Get interval
            $interval = $this->commonmodel->getInterval($now_date->format('d-m-Y H:i:s'), $deal_to_date);
            
            if($interval >= 0){
                
                $count++;
                
                if(($count) >= $position_start_get && ($count) <= $position_end_get){
                    
                    $count_result ++ ;
                
                    //  Create JSONObject Coupon
                    $jsonobject = array( 

                               Couponenum::ID               => $coupon['_id']->{'$id'},
                               Couponenum::COUPON_VALUE     => $coupon['coupon_value'],
                               Couponenum::DEAL_TO_DATE     => $coupon['deal_to_date'],
                               Couponenum::RESTAURANT_NAME  => $coupon['restaurant_name'],
                               Couponenum::CONTENT          => $coupon['content'],
                               Couponenum::IMAGE_LINK       => Couponenum::BASE_IMAGE_LINK.$coupon['image_link'],
                               Couponenum::LINK_TO          => $coupon['link_to']
                                       
                               );

                    $results[] = $jsonobject;
                    
                }
            }
            
        }
        
        //  Response
//        $data = array();
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>$count_result,
               'Results'    =>$results
        );

        $this->response($data);
    }
    
    /**
     * 
     * API insert Coupon
     * 
     * Menthod: POST
     * 
     * @param int $coupon_value
     * @param String $deal_to_date
     * @param String $restaurant_name
     * @param String $content
     * @param String $image_link
     * @param String $link_to
     * 
     *  Response: JSONObject
     * 
     */
    public function insert_coupon_post(){
        
        //  Get param from client;
         $coupon_value          = $this->post('coupon_value');
         $deal_to_date          = $this->post('deal_to_date');
         $restaurant_name       = $this->post('restaurant_name');
         $content               = $this->post('content');
         $image_link            = $this->post('image_link');
         $link_to               = $this->post('link_to');
         
        //  Resulte
        $resulte = array();
        
        if($coupon_value == null || $deal_to_date == null || $restaurant_name == null || 
           $content == null || $image_link == null || $link_to == null){
           
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      => 'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->insertCoupon($coupon_value, $deal_to_date, $restaurant_name, 
                                                           $content, $image_link, $link_to);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
     * 
     * API upadate Coupon
     * 
     * Menthod: POST
     * 
     * @param String $id
     * @param int $coupon_value
     * @param String $deal_to_date
     * @param String $restaurant_name
     * @param String $content
     * @param String $image_link
     * @param String $link_to
     * 
     *  Response: JSONObject
     * 
     */
    public function update_coupon_post(){
        
        //  Get param from client
         $id                    = $this->post('id');
         $coupon_value          = $this->post('coupon_value');
         $deal_to_date          = $this->post('deal_to_date');
         $restaurant_name       = $this->post('restaurant_name');
         $content               = $this->post('content');
         $image_link            = $this->post('image_link');
         $link_to               = $this->post('link_to');
        
        //  Resulte
        $resulte = array();
        
        if($id == null || $coupon_value == null || $deal_to_date == null || $restaurant_name == null || 
           $content == null || $image_link == null || $link_to == null){
           
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      => 'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->updateCoupon($id, $coupon_value, $deal_to_date, $restaurant_name, 
                                                           $content, $image_link, $link_to);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
     * 
     * API delete Coupon
     * 
     * Menthod: POST
     * 
     * @param $id
     * 
     *  Response: JSONObject
     * 
     */
    public function delete_coupon_post(){
        
        //  Get param from client
        $id  = $this->post('id');
        
        //  Resulte
        $resulte = array();
        
        if($id == null){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      => 'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->deleteCoupon($id);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    //------------------------------------------------------
    //                                                     /
    //  APIs Post                                          /
    //                                                     /
    //------------------------------------------------------
    
    /**
     * 
     *  API search Post
     * 
     *  Menthod: GET
     * 
     *  @param int $limit
     *  @param int $page
     *  @param String $key
     * 
     *  Response: JSONObject
     * 
     */    
    public function search_post_get(){
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
        
        //  Key search
        $key = $this->get('key');
        
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        //  Query
        $where = array(Postenum::TITLE => new MongoRegex('/'.$key.'/i'));
        $list_post = $this->restaurantmodel->searchPost($where);
        
        //  Array object post
        $results = array();
        
        //  Count object post
        $count = 0;
        
        //  Count resulte
        $count_resulte = 0;
        
        foreach ($list_post as $post){
            
            $count++;

            if(($count) >= $position_start_get && ($count) <= $position_end_get){

                $count_resulte ++;

                //  Create JSONObject Post
                $jsonobject = array( 
                    
                           Postenum::ID                     => $post['_id']->{'$id'},
                           Postenum::ID_USER                => $post['id_user'],
                           Postenum::TITLE                  => $post['title'],
                           Postenum::AVATAR                 => $post['avatar'],
                           Postenum::ADDRESS                => $post['address'],
                           Postenum::FAVOURITE_TYPE_LIST    => $post['favourite_type_list'],
                           Postenum::PRICE_PERSON_LIST      => $post['price_person_list'],
                           Postenum::CULINARY_STYLE_LIST    => $post['culinary_style'],
                           Postenum::CONTENT                => $post['content'],
                           Postenum::NUMBER_VIEW            => $post['number_view'],
                           Postenum::NOTE                   => $post['note'],
                           Postenum::AUTHORS                => $post['authors'],
                           Commonenum::CREATED_DATE         => $post['created_date'],
                           
                           );

                $results[] = $jsonobject;

            }
            
        }
        
        //  Response
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>$count_resulte,
               'Results'    =>$results
        );

        $this->response($data);
    }
    
    /**
     * 
     *  API get Post
     * 
     *  Menthod: GET
     * 
     *  @param $limit
     *  @param $page
     * 
     *  Response: JSONObject
     * 
     */    
    public function get_post_list_get(){
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
                
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        $list_post = $this->restaurantmodel->getAllPost();
//        
        //  Array object post
        $results = array();
        
        //  Count object post
        $count = 0;
        
        //  Count resulte
        $count_resulte = 0;
        
        foreach ($list_post as $post_){
            
			
			
            $count++;

            if(($count) >= $position_start_get && ($count) <= $position_end_get){

                $count_resulte ++;
             
                //  Create JSONObject Post
                $jsonobject = array( 
                    
                           Postenum::ID                     => $post_['_id']->{'$id'},
                           Postenum::ID_USER                => $post_['id_user'],
                           Postenum::TITLE                  => $post_['title'],
                           Postenum::AVATAR                 => $post_['avatar'],
                           Postenum::ADDRESS                => $post_['address'],
                           Postenum::FAVOURITE_TYPE_LIST    => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::FAVOURITE_TYPE,   $post_['favourite_type_list']),
                           Postenum::PRICE_PERSON_LIST      => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::PRICE_PERSON,   $post_['price_person_list']),
                           Postenum::CULINARY_STYLE_LIST    => $this->commonmodel->getValueFeildNameBaseCollectionById(Commonenum::CULINARY_STYLE,   $post_['culinary_style_list']),
                           Postenum::CONTENT                => $post_['content'],
                           //Postenum::NUMBER_VIEW            => $post['number_view'],
                           Postenum::NOTE                   => $post_['note'],
                           Postenum::AUTHORS                => $post_['authors'],
                           Commonenum::CREATED_DATE         => $post_['created_date'],
                           
                           );

                $results[] = $jsonobject;

            }
            
        }
        
        //  Response
//        $data = array();
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>$count_resulte,
               'Results'    =>$results
        );

        $this->response($data);
    }
    
    /**
     * 
     * API Update Post
     * 
     * Menthod: POST
     * 
     * @param String $action
     * @param String $id
     * @param String $id_user
     * @param String $title
     * @param String $content
     * @param String $number_view
     * @param String $note
     * @param String $authors
     * 
     * Response: JSONObject
     * 
     */
   public function update_post_post(){
        
        //  Get param from client
        $action                 = $this->post('action');
        
        $id                     = $this->post('id');
        
        $id_user                = $this->post('id_user');
        $title                  = $this->post('title');
        $address                = $this->post('address');
        $favourite_type_list    = $this->post('favourite_type_list');
        $price_person_list      = $this->post('price_person_list');
        $culinary_style_list    = $this->post('culinary_style_list');
		
        $content                = $this->post('content');
        $note                   = $this->post('note');
        $authors                = $this->post('authors');
        
        //  More
        $str_image_post = $this->post('array_image');                   //  image.jpg,image2.png,...
        $array_image_post = explode(Commonenum::MARK, $str_image_post); //  ['image.jpg', 'image2.png' ,...]
        
        $file_avatar;
        
        $base_path_post = Commonenum::ROOT.Commonenum::DIR_POST.$id_user.'/';
        
        //  Create directory $path
        if(!file_exists($base_path_post)){
            mkdir($base_path_post, 0, true);
        }
        
        for($i=0; $i<sizeof($array_image_post); $i++) {
            
            $file_temp = Commonenum::ROOT.Commonenum::PATH_TEMP.$array_image_post[$i];
           // var_dump('temp ['.$i.'] = '.$file_temp);
			
            if (file_exists($file_temp)) {
                
                $path_image_post = $base_path_post.$array_image_post[$i];
                
                //  Move file from directory post
                $move_file = $this->commonmodel->moveFileToDirectory($file_temp, $path_image_post);
                
                if($move_file){
					
                    if($i==0){
                        //$file_avatar = str_replace(Commonenum::ROOT,'' ,$path_image_post);
						$file_avatar=$id_user."/".$array_image_post[$i];
                    }
					else{
					
						var_dump('Temp :'.str_replace(Commonenum::ROOT, Commonenum::LOCALHOST ,$file_temp));
						var_dump('Final :'.str_replace(Commonenum::ROOT, Commonenum::LOCALHOST ,$path_image_post));
						var_dump('Content :'.$content);
						
						$content=str_replace(str_replace(Commonenum::ROOT, Commonenum::LOCALHOST ,$file_temp), 
								str_replace(Commonenum::ROOT, Commonenum::LOCALHOST ,$path_image_post),
								$content);
						
					
					}
                    
                }
                
            }
            
        }
        
       (int)$is_insert = strcmp( strtolower($action), Commonenum::INSERT );
       (int)$is_delete = strcmp( strtolower($action), Commonenum::DELETE );
        
        $array_value = ($is_delete != 0) ? array(
                        Postenum::ID_USER               => $id_user,
                        Postenum::TITLE                 => $title,     
            
                        Postenum::AVATAR                => $file_avatar,
                        Postenum::ADDRESS               => $address,
                        Postenum::FAVOURITE_TYPE_LIST   => explode(Commonenum::MARK, $favourite_type_list),
                        Postenum::PRICE_PERSON_LIST     => explode(Commonenum::MARK, $price_person_list),
                        Postenum::CULINARY_STYLE_LIST   => explode(Commonenum::MARK, $culinary_style_list),
            
                        Postenum::CONTENT               => $content,
                        //Postenum::NUMBER_VIEW           => ($is_insert == 0) ? Postenum::DEFAULT_NUMBER_VIEW : (int)$number_view,
                        Postenum::NOTE                  => $note,
                        Postenum::AUTHORS               => $authors,
                        Commonenum::CREATED_DATE        => $this->commonmodel->getCurrentDate()
                ) : array();
        
        $this->restaurantmodel->updatePost($action, $id, $array_value);
        $error = $this->restaurantmodel->getError();
        
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
    //------------------------------------------------------
    //                                                     /
    //  APIs Subscribed Email                              /
    //                                                     /
    //------------------------------------------------------
    
    /**
     * 
     *  API get Subscribed Email
     * 
     *  Menthod: GET
     *  @param limit
     *  @param page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_email_list_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
                
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection subscribed_email
        $collection_name = Subscribedmailenum::COLLECTION_NAME;
        $list_subscribed_email = $this->restaurantmodel->getCollection($collection_name);
        
        //  Array object subscribed_email
        $results = array();
        
        //  Count object subscribed_email
        $count = 0;
        
        //  Count resulte
        $count_resulte = 0;
        
        foreach ($list_subscribed_email as $subscribed_email){
            
            $count++;

            if(($count) >= $position_start_get && ($count) <= $position_end_get){

                $count_resulte ++;

                //  Create JSONObject Post
                $jsonobject = array( 
                    
                           Subscribedmailenum::ID        => $subscribed_email['_id']->{'$id'},
                           Subscribedmailenum::EMAIL     => $subscribed_email['email'],
                           
                           );

                $results[] = $jsonobject;

            }
            
        }
        
        //  Response
//        $data = array();
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>$count_resulte,
               'Results'    =>$results
        );

        $this->response($data);
    }
    
     /**
     * 
     *  API insert Subcribed Email
     * 
     *  Menthod: POST
     * 
     *  @param String $email
     * 
     *  Response: JSONObject
     * 
     */
    public function insert_email_post(){
        
        //  Get param from client
        $email = $this->post('email');
        
        //  Resulte
        $resulte = array();
        
        if($email == null){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      => Subscribedmailenum::EMAIL.' is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->insertEmail($email);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
     * 
     *  API update Subcribed Email
     * 
     *  Menthod: POST
     * 
     *  @param String $id
     *  @param String $email
     * 
     *  Response: JSONObject
     * 
     */
    public function update_email_post(){
        
        //  Get param from client
        $id = $this->post('id');
        $email = $this->post('email');
        
        //  Resulte
        $resulte = array();
        
        if( $id == null ||$email == null){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->updateEmail($id, $email);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
     * 
     *  API delete Subcribed Email
     * 
     *  Menthod: POST
     * 
     *  @param String $id
     * 
     *  Response: JSONObject
     * 
     */
    public function delete_email_post(){
        
        //  Get param from client
        $id = $this->post('id');
        
        //  Resulte
        $resulte = array();
        
        if( $id == null ){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->deleteEmail($id);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    //------------------------------------------------------
    //                                                     /
    //  APIs Closed Member                                 /
    //                                                     /
    //------------------------------------------------------
    
    /**
     * 
     *  API get Closed Member
     * 
     *  Menthod: GET
     * 
     *  @param limit
     *  @param page
     * 
     *  Response: JSONObject
     * 
     */
    public function get_closed_member_list_get() {
        
        //  Get limit from client
        $limit = $this->get("limit");
        
        //  Get page from client
        $page = $this->get("page");
                
        //  End
        $position_end_get   = ($page == 1)? $limit : ($limit * $page);
        
        //  Start
        $position_start_get = ($page == 1)? $page : ( $position_end_get - ($limit - 1) );
        
        // Get collection subscribed_email
        $collection_name = "closed_member";
        $list_closed_member = $this->restaurantmodel->getCollection($collection_name);
        
        //  Array object closed_member
        $results = array();
        
        //  Count object closed_member
        $count = 0;
        
        //  Count resulte
        $count_resulte = 0;
        
        foreach ($list_closed_member as $closed_member){
            
            $count++;

            if(($count) >= $position_start_get && ($count) <= $position_end_get){

                $count_resulte ++;

                //  Create JSONObject Post
                $jsonobject = array( 
                    
                           Closedmemberenum::ID                    => $closed_member['_id']->{'$id'},
                           Closedmemberenum::NAME                  => $closed_member['name'],
                           Closedmemberenum::IMAGE_LINK            => Closedmemberenum::BASE_IMAGE_LINK.$closed_member['image_link'], 
                           Closedmemberenum::MEMBER_OF_COMMENTS    => $closed_member['member_of_comments'],
                           Closedmemberenum::LINK_TO               => $closed_member['link_to']
                           
                           );

                $results[] = $jsonobject;

            }
            
        }
        
        //  Response
//        $data = array();
        $data =  array(
               'Status'     =>'SUCCESSFUL',
               'Total'      =>$count_resulte,
               'Results'    =>$results
        );

        $this->response($data);
    }
    
    /**
    * 
    *  API insert Closed Member
    * 
    *  Menthod: POST
    * 
    * @param String $name
    * @param String $image_link
    * @param String $member_of_comments
    * @param String $link_to
    * 
    *  Response: JSONObject
    * 
    */
    public function insert_closed_member_post(){
        
        //  Get param from client        
        $name                   = $this->post('name');
        $image_link             = $this->post('image_link');
        $member_of_comments     = $this->post('member_of_comments');
        $link_to                = $this->post('link_to');

        //  Resulte
        $resulte = array();
        
        if( $name == null || $image_link == null || $member_of_comments == null || $link_to == null ){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->insertClosedMember($name, $image_link, $member_of_comments, $link_to);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
    * 
    *  API update Closed Member
    * 
    *  Menthod: POST
    * 
    * @param String $id
    * @param String $name
    * @param String $image_link
    * @param String $member_of_comments
    * @param String $link_to
    * 
    *  Response: JSONObject
    * 
    */
    public function update_closed_member_post(){
        
        //  Get param from client        
        $id                     = $this->post('id');
        $name                   = $this->post('name');
        $image_link             = $this->post('image_link');
        $member_of_comments     = $this->post('member_of_comments');
        $link_to                = $this->post('link_to');
        
        //  Resulte
        $resulte = array();
        
        if( $id == null || $name == null || $image_link == null || $member_of_comments == null || $link_to == null ){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->updateClosedMember($id, $name, $image_link, $member_of_comments, $link_to);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
    /**
     * 
     *  API delete Closed Member
     * 
     *  Menthod: POST
     * 
     *  @param String $id
     * 
     *  Response: JSONObject
     * 
     */
    public function delete_closed_member_post(){
        
        //  Get param from client
        $id = $this->post('id');
        
        //  Resulte
        $resulte = array();
        
        if( $id == null ){
            
            //  Response error
            $resulte =  array(
                   'Status'     =>'FALSE',
                   'Error'      =>'Param is NULL'
            );

            $this->response($resulte);
            
        }else{
            
            $error = $this->restaurantmodel->deleteClosedMember($id);
            
            //  If insert successful
            if( is_null($error) ){
                
                //  Response
                $resulte =  array(
                   'Status'     =>'SUCCESSFUL',
                   'Error'      =>$error
                );

                $this->response($resulte);

            }
            else{
                //  Response error
                $resulte =  array(
                       'Status'     =>'FALSE',
                       'Error'      =>$error
                );

                $this->response($resulte);

            }
        }
        
    }
    
}

?>
