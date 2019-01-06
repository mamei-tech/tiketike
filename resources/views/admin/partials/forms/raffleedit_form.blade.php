<form class="form-horizontal" method="post" action="{{ route('unpublished.update','') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
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
                <textarea id="tb_editdescription" class="form-control" type="text" placeholder="description"
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
                <select name="owner" id="tb_eowner" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select Owner">
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
                <select name="category" id="tb_ecategory" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select Category">
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
                <select name="location" id="tb_elocation" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Select the Raffle location">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <button id="btn_rolescreatesubmt" class="btn btn-primary btn-round" type="submit" value="add">
            <i class="now-ui-icons ui-1_settings-gear-63"></i>
            Save
        </button>
    </div>
</form>

