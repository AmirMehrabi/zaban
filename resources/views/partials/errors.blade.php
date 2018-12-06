@if (session()->has('flash_notification.message'))
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-1-10 col-md-offset-1">
        <div class="alert alert-{{ session('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session('flash_notification.message') !!}
        </div>
      </div>

    </div>
  </div>
@endif
