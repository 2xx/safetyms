@extends('reg')

@section('main')
  <meta http-equiv="refresh" content="2;url=/admin">
  <div class="example-modal">
        <div class="modal modal-info show">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">成功</h4>
              </div>
              <div class="modal-body" style="text-align: center;">
                <h2>注册成功</h2>
              </div>
              <div class="modal-footer">
                <a href="/admin" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</a>
                <a href="/admin" type="button" class="btn btn-outline">Save changes</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
@endsection