<!--a class="btn btn-xs btn-primary btn-view" data-action= "{{ route('user.show', $model->id ) }}" href="#"><span class="fa fa-folder-open"></span></a-->&nbsp;
<a class="btn btn-xs btn-success btn-edit" data-action= "{{ route($route.'.edit', $model->id ) }}" href="#"><span class="fa fa-pencil"></span></a>&nbsp;
<a class="btn btn-xs btn-danger btn-delete" href= "{{ url( $route.'/delete/'.$model->id ) }}" data-toggle="modal" data-target=".bs-delete-modal"><span class="fa fa-trash-o"></span></a>&nbsp;
