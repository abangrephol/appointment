<?php

class ServicesController extends \BaseController {
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

        return Datatable::collection(Subscription::find(Sentry::getUser()->subscription_id)->service) //array('id','first','last','email','username','is_active')
            ->showColumns('name', 'price','duration','interval')
            ->addColumn('active', function($model){
                if($model->is_active)
                    return 'Active';
                else
                    return 'Not Active';
            })
            ->addColumn('action',function($model){
                return Theme::widget("buttonColumn", array("model" => $model,'route'=>'service'))->render();
            })
            ->searchColumns('name', 'price','duration','interval')
            ->orderColumns('id','name', 'price','duration','interval')
            ->make();
    }

    public  function  tab($tabId,$id){
        $theme = $this->theme;
        $model = Services::find($id);
        if($tabId!='service')
        {
            $data = array("data"=>$model);
        }else{
            $data = array(
                "data"=>$model,
                'customfields'=>Subscription::find(Sentry::getUser()->subscription_id)->customform,
                'datacustomfields' => $model->customform
            );

        }
        return $theme->layout('tab')->scope('services._tab_'.$tabId,$data)->render();
    }
	/**
	 * Display a listing of the resource.
	 * GET /services
	 *
	 * @return Response
	 */
	public function index()
	{
        $theme = $this->theme;
        $theme->set('title','Services');
        $theme->set('route','service');
        $routeUrl = 'dt.services';
        $columns = array('Name','Price','Duration (minutes)', 'Interval (minutes)' ,'Status','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('services.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /services/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $theme = $this->theme;
        $theme->set('title','New Service');
        $data = array('customfields'=>Subscription::find(Sentry::getUser()->subscription_id)->customform);
        return $theme->layout('form')->scope('services.create',$data)->render();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /services
	 *
	 * @return Response
	 */
	public function store()
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = new Services();


            $validator = Validator::make($formFields,Services::$rulesCreate);
            if($validator->passes()){
                $model->name = $formFields['name'];
                $model->description = $formFields['description'];
                $model->price = $formFields['price'];
                $model->duration = $formFields['duration'];
                $model->interval = $formFields['interval'];
                $model->capacity = $formFields['capacity'];
                $model->subscription_id = $model->subscription_id = Sentry::getUser()->subscription_id;
                if($model->save()){
                    if(isset($formFields['custom_forms'])){
                        for($i=0;$i<count($formFields['custom_forms']);$i++){
                            $customForm = new ServiceCustomForm();
                            $customForm->services_id = $model->id;
                            $customForm->custom_form_id = $formFields['custom_forms'][$i];
                            $customForm->save();
                        }
                    }

                    return \Response::json(array("success"=>true,"flashMessage"=>"Create Service Success."));
                }
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Failed.","message"=>$e->getMessage()));
        }
	}

	/**
	 * Display the specified resource.
	 * GET /services/{id}
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
	 * GET /services/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Edit Service');
        $model = Services::find($id);
        $data = array(
            "data"=>$model
        );

        return $theme->layout('form')->scope('services.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /services/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = Services::find($id);


            $validator = Validator::make($formFields,Services::$rulesUpdate);
            if($validator->passes()){
                $model->name = $formFields['name'];
                $model->description = $formFields['description'];
                $model->price = $formFields['price'];
                $model->duration = $formFields['duration'];
                $model->interval = $formFields['interval'];
                $model->capacity = $formFields['capacity'];

                if($model->save()){
                    if(isset($formFields['custom_forms'])){
                        $model->customforms()->delete();
                        for($i=0;$i<count($formFields['custom_forms']);$i++){
                            $customForm = new ServiceCustomForm();
                            $customForm->services_id = $model->id;
                            $customForm->custom_form_id = $formFields['custom_forms'][$i];
                            $customForm->save();
                        }
                    }
                    return \Response::json(array("success"=>true,"flashMessage"=>"Update Success."));
                }

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
        $model = Services::find($id);
        $data = $model->toArray();

        return $theme->partial('deleteModal',array('data'=>$data,'route'=>'service'));
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /services/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model = Services::find($id);
        $delete = $model->delete();
        if ($delete) {
            return \Response::json(array('success'=>true));
        }else{
            return \Response::json(array('failed'=>true));
        }
	}

}