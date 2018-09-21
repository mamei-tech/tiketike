<div class="row">

    @if ($errors->any())
        <div id="err_admsec" class="col-md-12" style="display: none;">
            <div class="alert alert-danger alert-with-icon">
                <button type="button" aria-hidden="true" class="close btn-close">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span data-notify="icon" class="now-ui-icons objects_support-17"></span>
                <span data-notify="message">
                <ul style="list-style: none; margin-bottom: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </span>
            </div>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div id="msg_admsec" class="col-md-12" style="display: none;">
            <div class="alert alert-success alert-with-icon">
                <button type="button" aria-hidden="true" class="close btn-close">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <span data-notify="icon" class="now-ui-icons media-2_sound-wave"></span>

                <span data-notify="message">
            <p style="margin-bottom: 0">{{ $message }}</p>
            </span>
            </div>
        </div>
    @endif
</div>
