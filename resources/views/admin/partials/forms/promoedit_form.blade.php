<form class="form-horizontal" method="post" action="{{ route('promos.update', '')}}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="PATCH">

    {{-- ID/HIDDEN --}}
    <p id="tb_id" hidden></p>

    {{-- NAME | EXP DATE --}}
    <div class="row">

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_name">Name</label>
                <input id="tb_name" class="form-control" type="text" name="name" placeholder="Promo Name"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group basicmodal">
                <label for="tb_expdate">Exp Date</label>
                <input id="tb_expdate" name="expdate" type="text" placeholder="" class="form-control datepicker"
                       value="{{ date('Y-m-d',mktime(0, 0, 0,date("m")+1  , date("d"), date("Y"))) }}">
            </div>
        </div>

    </div>

    {{-- CLIENT | TYPE | STATUS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="slt_client">Client</label>

                <input id="slt_client" class="form-control" type="text" name="client" disabled/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_type">Type</label>
                <br>
                <input id="tb_type" type="checkbox" name="type" class="form-control bootstrap-switch" value="1"
                       data-on-label="SEC"
                       data-off-label="PRC">
            </div>

        </div>

        <div class="col-md-4">
            <div class="form-group basicmodal">
                <label for="tb_status">Status</label>
                <br>
                <input id="tb_status" type="checkbox" name="status" class="form-control bootstrap-switch" value="1"
                       data-on-label="<i class='now-ui-icons ui-1_check'></i>"
                       data-off-label="<i class='now-ui-icons ui-1_simple-remove'></i>" checked>
            </div>
        </div>

    </div>

    {{-- IMGS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basic">
                <label for="image">Image</label>
                <br>
                <span class="btn btn-simple btn-round">
                    <i class="now-ui-icons design_image"></i>
                    <input id="f_image" type="file" class="form-control" name="image">
                    Select Image
                </span>
            </div>
        </div>

        <div class="col-md-8">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput thumbnailpromo">
                    <img id="promo-img" src="{{ asset('pics/common/image_placeholder.jpg') }}" alt="">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
            </div>
        </div>

    </div>

    {{-- ALT --}}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group basicmodal">
                <label for="tb_alt">Alternative</label>
                <input id="tb_alt" class="form-control" type="text" name="alternative"
                       placeholder="alternative text for image"/>
            </div>
        </div>

    </div>

    {{-- WWW --}}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group basicmodal">
                <label for="tb_website">Website</label>
                <input id="tb_website" class="form-control" type="text" name="website"
                       placeholder="enter the web for the promo bussines.com"/>
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