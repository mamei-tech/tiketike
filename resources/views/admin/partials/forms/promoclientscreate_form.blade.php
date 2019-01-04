<form  class="form-horizontal" method="POST" action="{{ route('pmclients.store')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- NAME | Email --}}
    <div class="row">

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_name">@lang('Client')</label>
                <input id="tb_name" class="form-control" type="text" name="name" placeholder="Client Name"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_email">Email</label>
                <input id="tb_email" class="form-control" type="text" name="email" placeholder="hotel@gmail.com"/>
            </div>
        </div>

    </div>

    {{-- CONTACTS PHONES --}}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group basicmodal">
                <label for="tb_contact">@lang('Contact')</label>
                <input id="tb_contact" class="form-control" type="text" name="contact" placeholder="+53 5 5555555 +1 222 2222"/>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <button id="createBtn" class="btn btn-primary btn-round" type="submit" value="post">
            <b>
                <i class="now-ui-icons ui-1_simple-add"></i>
                Create
            </b>
        </button>
    </div>

    <br>
</form>