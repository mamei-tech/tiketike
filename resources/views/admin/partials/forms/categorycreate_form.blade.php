<form class="form-horizontal" method="post" action="{{ route('categories.store') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}

    <div class="row">
        <label class="col-sm-3 col-form-label">Category name</label>
        <div class="col-sm-9">
            <div class="form-group">
                <input id="tb_category" class="form-control" type="text" placeholder="Category name" name="category"
                       required>
            </div>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 col-form-label">Icon</label>
        <div class="col-sm-9">
            <div class="form-group">
                <div class="form-check form-check-radio" style="float: left">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-download">
                        <span class="form-check-sign"></span>
                        <i class="ti-download"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-car">
                        <span class="form-check-sign"></span>
                        <i class="ti-car"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-time">
                        <span class="form-check-sign"></span>
                        <i class="ti-time"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-desktop">
                        <span class="form-check-sign"></span>
                        <i class="ti-desktop"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-mobile">
                        <span class="form-check-sign"></span>
                        <i class="ti-mobile"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-blackboard">
                        <span class="form-check-sign"></span>
                        <i class="ti-blackboard"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-camera">
                        <span class="form-check-sign"></span>
                        <i class="ti-camera"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-home">
                        <span class="form-check-sign"></span>
                        <i class="ti-home"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-money">
                        <span class="form-check-sign"></span>
                        <i class="ti-money"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-palette">
                        <span class="form-check-sign"></span>
                        <i class="ti-palette"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-game">
                        <span class="form-check-sign"></span>
                        <i class="ti-game"></i>
                    </label>
                </div>
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

