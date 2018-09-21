<form class="form-horizontal" method="post" action="{{ route('pmclients.update', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="PATCH">

    {{-- ID --}}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group basicmodal">
                <label for="tb_id">@lang('Client')</label>
                <input id="tb_id" class="form-control" type="text" name="id" disabled/>
            </div>
        </div>

    </div>

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
                <input id="tb_contact" class="form-control" type="text" name="contact"/>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <button id="editBtn" class="btn btn-success btn-round" type="submit" value="edit">
            <b>
                <i class="now-ui-icons ui-1_check"></i>
                Update
            </b>
        </button>
    </div>

    <br>
</form>