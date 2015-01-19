<?php

class ServiceLocationsController extends \BaseController {
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

        return Datatable::collection(ServiceLocation::all()) //array('id','first','last','email','username','is_active')
            ->showColumns('name','description','address')
            ->addColumn('active', function($model){
                if($model->is_active)
                    return 'Active';
                else
                    return 'Not Active';
            })
            ->addColumn('action',function($model){
                return Theme::widget("buttonColumn", array("model" => $model,'route'=>'serviceloc'))->render();
            })
            ->searchColumns('name','description','address')
            ->orderColumns('id','name')
            ->make();
    }
	/**
	 * Display a listing of the resource.
	 * GET /servicelocations
	 *
	 * @return Response
	 */
	public function index()
	{
        $theme = $this->theme;
        $theme->set('title','Service Locations');
        $theme->set('route','serviceloc');
        $routeUrl = 'dt.servicelocs';
        $columns = array('Name','Description','Address' ,'Status','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);


        return $theme->scope('service_locations.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /servicelocations/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $theme = $this->theme;
        $theme->set('title','New Service Location');

        return $theme->layout('form')->scope('service_locations.create')->render();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /servicelocations
	 *
	 * @return Response
	 */
	public function store()
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = new ServiceLocation();


            $validator = Validator::make($formFields,ServiceLocation::$rulesCreate);
            if($validator->passes()){
                $model->name = $formFields['name'];
                $model->description = $formFields['description'];
                $model->address = $formFields['address'];
                $model->timezone = $formFields['timezone'];
                if($model->save())
                    return \Response::json(array("success"=>true,"flashMessage"=>"Create Service Location Success."));
                else
                    return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Location Failed.","message"=>$model->validationErrors));
            }else{
                return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Location Failed.","message"=>$validator->getMessageBag()->toArray()));
            }
        }catch (\Exception $e){
            return \Response::json(array("failed"=>true,"flashMessage"=>"Create Service Location Failed.","message"=>$e->getMessage()));
        }
	}

	/**
	 * Display the specified resource.
	 * GET /servicelocations/{id}
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
	 * GET /servicelocations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $theme = $this->theme;
        //$theme->layout('form');
        $theme->set('title','Edit Service Location');
        $model = ServiceLocation::find($id);
        $data = array("data"=>$model);

        return $theme->layout('form')->scope('service_locations.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /servicelocations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try{

            $inputData = Input::get('formData');
            parse_str($inputData, $formFields);
            $model = ServiceLocation::find($id);


            $validator = Validator::make($formFields,ServiceLocation::$rulesUpdate);
            if($validator->passes()){
                $model->name = $formFields['name'];
                $model->description = $formFields['description'];
                $model->address = $formFields['address'];
                $model->timezone = $formFields['timezone'];

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
        $model = ServiceLocation::find($id);
        $data = $model->toArray();

        return $theme->partial('deleteModal',array('data'=>$data,'route'=>'serviceloc'));
    }
	/**
	 * Remove the specified resource from storage.
	 * DELETE /servicelocations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model = ServiceLocation::find($id);
        $delete = $model->delete();
        if ($delete) {
            return \Response::json(array('success'=>true));
        }else{
            return \Response::json(array('failed'=>true));
        }
	}

}