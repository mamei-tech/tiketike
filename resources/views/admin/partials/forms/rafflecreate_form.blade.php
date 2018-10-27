<form class="form-horizontal" method="post" action="{{ route('unpublished.store') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}

    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Title</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_title" class="form-control" type="text" placeholder="title" name="title" required>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Description</label>
        <div class="col-sm-9">
            <div class="form-group">
                <textarea id="tb_description" class="form-control" type="text" placeholder="description"
                          name="description"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Price</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_price" class="form-control" type="text" placeholder="price" name="price" required>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Owner</label>
        <div class="col-sm-9">
            <div class="form-group">
                <select name="owner" id="tb_owner" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select Owner">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{ $user->name }} {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Category</label>
        <div class="col-sm-9">
            <div class="form-group">
                <select name="category" id="tb_category" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select Category">
                    @foreach($categories as $category)
                        <option class="input-group" value="{{$category->id}}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Location</label>
        <div class="col-sm-9">
            <div class="form-group">
                <select name="location" id="tb_location" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select the Raffle location">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-3 col-form-label">Raffle Location</label>
        <div class="col-sm-9">
            <div class="form-group">
                <span class="btn btn-simple btn-round">
                    <input id="avatar" type="file" class="form-control" name="avatar[]" multiple="multiple">
                    <i class="now-ui-icons users_circle-08"></i>
                    Avatar
                </span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group basic">
                <label for="image">Image</label>
                <br>
                <span class="btn btn-simple btn-round">
                    <i class="now-ui-icons design_image"></i>
                    <input id="f_image" type="file" class="form-control" name="image[]">
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

    <div class="row">
        <button id="btn_rolescreatesubmt" class="btn btn-primary btn-round" type="submit" value="add">
            <i class="now-ui-icons ui-1_simple-add"></i>
            Add
        </button>
    </div>
</form>

