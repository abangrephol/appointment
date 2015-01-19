<?php

class CustomersController extends \BaseController {
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

        $dataType = Route::currentRouteName();
        switch($dataType){
            case "dt.customers":
                $columns =  array('first', 'last','address_1','email','username');
                $button = function($model){
                    return Theme::widget('buttonColumn', array("model" => $model,'route'=>'customer'))->render();
                };
                break;
            case "dt.customers.appointment" :
                $columns =  array('first', 'last','address_1');
                $button = function($model){
                    return Theme::widget('buttonColumnApp', array("model" => $model,'route'=>'customer'))->render();
                };
                break;
        }
        return Datatable::collection(Subscription::find(Auth::user()->subscription_id)->customer) //array('id','first','last','email','username','is_active')
            ->showColumns($columns)
            ->addColumn('action',$button)
            ->searchColumns('first', 'last','address_1','email')
            ->orderColumns('id','first', 'last','address_1','email')
            ->make();

    }
    function getCustomerData($id){
        $model = Customer::find($id);
        return Response::json($model);
    }
	/**
	 * Display a listing of the resource.
	 * GET /customers
	 *
	 * @return Response
	 */
	public function index()
	{
        $theme = $this->theme;
        $theme->set('title','Customers');
        $theme->set('route','customer');
        $routeUrl = 'dt.customers';
        $columns = array('First Name','Last Name','Address', 'Email' ,'Username','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('customers.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customers/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $theme = $this->theme;
        $theme->set('title','New Customer');

        return $theme->layout('form')->scope('customers.create')->render();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customers
	 *
	 * @return Response
	 */
	public function store()
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = new Customer();


            $validator = Validator::make($formFields,Customer::$rulesCreate);
            if($validator->passes()){
                $model->first = $formFields['first'];
                $model->last = $formFields['last'];
                $model->email = $formFields['email'];
                $model->address_1 = $formFields['address_1'];
                $model->address_2 = $formFields['address_2'];
                $model->zip = $formFields['zip'];
                $model->username = $formFields['username'];
                $model->password = $formFields['password'];
                $model->subscription_id = Auth::user()->subscription_id;
                if($model->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Create Customer Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Customer Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create Customer Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create Customer Failed.","message"=>$e->getMessage()));
        }
	}

	/**
	 * Display the specified resource.
	 * GET /customers/{id}
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
	 * GET /customers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Edit Customer');
        $model = Customer::find($id);
        $data = array("data"=>$model);

        return $theme->layout('form')->scope('customers.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /customers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = Customer::find($id);


            $validator = Validator::make($formFields,Customer::$rulesUpdate);
            if($validator->passes()){
                $model->first = $formFields['first'];
                $model->last = $formFields['last'];
                $model->email = $formFields['email'];
                $model->address_1 = $formFields['address_1'];
                $model->address_2 = $formFields['address_2'];
                $model->zip = $formFields['zip'];
                $model->username = $formFields['username'];
                if(isset($formFields['old_password']) && isset($formFields['password']))
                    $model->password = $formFields['password'];
                if($model->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Update Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Update Failed.","message"=>$e->getMessage()));
        }
	}
    public  function delete($id){
        $theme = $this->theme;
        $model = Customer::find($id);
        $data = $model->toArray();

        return $theme->partial('deleteModal',array('data'=>$data,'route'=>'customer'));
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /customers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model = Customer::find($id);
        $delete = $model->delete();
        if ($delete) {
            return \Response::json(array('success'=>true));
        }else{
            return \Response::json(array('failed'=>true));
        }
	}

}