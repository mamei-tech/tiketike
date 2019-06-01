<form class="form-horizontal" method="post" action="{{ route('categories.update','') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" id="tb_id" name="id">

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
                    //adding new icons
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-tablet">
                        <span class="form-check-sign"></span>
                        <i class="ti-tablet"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-spray">
                        <span class="form-check-sign"></span>
                        <i class="ti-spray"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-signal">
                        <span class="form-check-sign"></span>
                        <i class="ti-signal"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-settings">
                        <span class="form-check-sign"></span>
                        <i class="ti-settings"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-cut">
                        <span class="form-check-sign"></span>
                        <i class="ti-cut"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-ruler">
                        <span class="form-check-sign"></span>
                        <i class="ti-ruler"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-pencil">
                        <span class="form-check-sign"></span>
                        <i class="ti-pencil"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-paint-roller">
                        <span class="form-check-sign"></span>
                        <i class="ti-paint-roller"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-paint-bucket">
                        <span class="form-check-sign"></span>
                        <i class="ti-paint-bucket"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-medall">
                        <span class="form-check-sign"></span>
                        <i class="ti-medall"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-lock">
                        <span class="form-check-sign"></span>
                        <i class="ti-lock"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-key">
                        <span class="form-check-sign"></span>
                        <i class="ti-key"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-import">
                        <span class="form-check-sign"></span>
                        <i class="ti-import"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-cup">
                        <span class="form-check-sign"></span>
                        <i class="ti-cup"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-briefcase">
                        <span class="form-check-sign"></span>
                        <i class="ti-briefcase"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-bolt">
                        <span class="form-check-sign"></span>
                        <i class="ti-bolt"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-world">
                        <span class="form-check-sign"></span>
                        <i class="ti-world"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-truck">
                        <span class="form-check-sign"></span>
                        <i class="ti-truck"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-shield">
                        <span class="form-check-sign"></span>
                        <i class="ti-shield"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-notepad">
                        <span class="form-check-sign"></span>
                        <i class="ti-notepad"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-server">
                        <span class="form-check-sign"></span>
                        <i class="ti-server"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-printer">
                        <span class="form-check-sign"></span>
                        <i class="ti-printer"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-plug">
                        <span class="form-check-sign"></span>
                        <i class="ti-plug"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-panel">
                        <span class="form-check-sign"></span>
                        <i class="ti-panel"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-package">
                        <span class="form-check-sign"></span>
                        <i class="ti-package"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-music-alt">
                        <span class="form-check-sign"></span>
                        <i class="ti-music-alt"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-mouse-alt">
                        <span class="form-check-sign"></span>
                        <i class="ti-mouse-alt"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-microphone">
                        <span class="form-check-sign"></span>
                        <i class="ti-microphone"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-headphone">
                        <span class="form-check-sign"></span>
                        <i class="ti-headphone"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-harddrive">
                        <span class="form-check-sign"></span>
                        <i class="ti-harddrive"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-gift">
                        <span class="form-check-sign"></span>
                        <i class="ti-gift"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-envelope">
                        <span class="form-check-sign"></span>
                        <i class="ti-envelope"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-dashboard">
                        <span class="form-check-sign"></span>
                        <i class="ti-dashboard"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-bell">
                        <span class="form-check-sign"></span>
                        <i class="ti-bell"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-video-camera">
                        <span class="form-check-sign"></span>
                        <i class="ti-video-camera"></i>
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="icon" id="icon"
                               value="ti-credit-card">
                        <span class="form-check-sign"></span>
                        <i class="ti-credit-card"></i>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <button id="updateCategory" class="btn btn-primary btn-round" type="submit" value="add">
            Update
        </button>
    </div>
</form>

