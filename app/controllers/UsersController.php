<?php

class UsersController extends \BaseController {
    protected $layout = 'panel';
    protected $themes = "default";

    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {

        return Datatable::collection(User::all()) //array('id','first','last','email','username','is_active')
            ->showColumns('first_name', 'last_name','email','username')
            ->addColumn('active', function($model){
                if($model->activated)
                    return 'Active';
                else
                    return 'Not Active';
            })
            ->addColumn('action',function($model){
                return Theme::widget("buttonColumn", array("model" => $model,'route'=>'user'))->render();
            })
            ->searchColumns('first_name','last_name','email','username','active')
            ->orderColumns('id','first_name','last_name','email','username','active')
            ->make();
    }
	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $theme = $this->theme;
        $theme->set('title','Users');
        $theme->set('route','user');
        $routeUrl = 'dt.users';
        $columns = array('First Name','Last Name', 'Email' , 'User Name','Status','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('users.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $theme = $this->theme;
        $theme->set('title','New User');

        return $theme->layout('form')->scope('users.create')->render();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $user = new User;


            $validator = Validator::make($formFields,User::$rulesCreate);
            if($validator->passes()){
                $user->first_name = $formFields['first_name'];//Input::get('first');
                $user->last_name = $formFields['last_name'];//Input::get('last');
                $user->email = $formFields['email'];//Input::get('email'); ;
                $user->username = $formFields['username'];//Input::get('username');
                $user->password = $formFields['password'];
                if($user->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Create User Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create User Failed.","message"=>$user->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create User Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create User Failed.","message"=>$e->getMessage()));
        }



    }

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Edit Users');
        $user = User::find($id);
        $data = array("data"=>$user);

        return $theme->layout('form')->scope('users.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $user = Sentry::findUserById($id);


            $validator = Validator::make($formFields,User::$rulesUpdate);
            if($validator->passes()){
                $user->first_name = $formFields['first_name'];//Input::get('first');
                $user->last_name = $formFields['last_name'];//Input::get('last');
                $user->email = $formFields['email'];//Input::get('email'); ;
                $user->username = $formFields['username'];//Input::get('username');
                $user->subscription_id = Sentry::getUser()->subscription_id;
                if(isset($formFields['activated']))
                    $user->activated = $formFields['activated'];
                else
                    $user->activated = 0;
                if(strlen($formFields['old_password'])>0 && strlen($formFields['password'])>0){
                    $user->password = $formFields['password'];
                }


                if($user->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Update Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$user->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$e->getMessage()));
        }




	}

    public  function delete($id){
        $theme = $this->theme;
        //$theme->layout('form');
        $user = User::find($id);
        $data = $user->toArray();

        return $theme->partial('deleteModal',array('data'=>$data,'route'=>'user'));
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $user = User::find($id);
        $delete = $user->delete();
        if ($delete) {
            return \Response::json(array('success'=>true));
        }else{
            return \Response::json(array('failed'=>true));
        }

	}

}