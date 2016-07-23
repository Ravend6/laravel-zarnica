@if (Session::has('flash_success'))
  <div id="flash-notify">
    <p data-type="success">{{ session('flash_success') }}</p>
  </div>
@endif
@if (Session::has('flash_danger'))
  <div id="flash-notify">
    <p data-type="danger">{{ session('flash_danger') }}</p>
  </div>
@endif
@if (Session::has('flash_info'))
  <div id="flash-notify">
    <p data-type="info">{{ session('flash_info') }}</p>
  </div>
@endif
@if (Session::has('flash_warning'))
  <div id="flash-notify">
    <p data-type="warning">{{ session('flash_warning') }}</p>
  </div>
@endif

{{-- @if ($errors->any())
  <div id="flash-notify">
    <p data-type="warning">{{ trans('messages.validation_error') }}</p>
  </div>
@endif --}}
