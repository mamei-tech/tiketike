<div class="modal fade login" id="mdal_editPoster"  aria-hidden="true">

    <div class="modal-dialog animated">
        <div class="modal-content">

            {{--Modal Body--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title"> Edit Poster </h4>
            </div>

            {{--Modal Body--}}
            <div class="modal-body">
                <div class="container">

                    {{--<div class="">--}}
                        {{--<p> Enter the info for creating a Role </p>--}}
                    {{--</div>--}}



                    <div id="frm_editPoster" class="col-md-12">
                        <form class="form-horizontal" method="post" action="{{ route('poster.update', '')}}"
                              accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}

{{--                            <input name="id" value="{{WelcomePoster::all()->first->id}}" type="hidden">--}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group basicmodal">
                                         <label for="title">Title</label>
{{--                                        <input id="title" value="{{WelcomePoster::all()->first->title}}"  class="form-control" type="text" name="title" />--}}
                                    </div>
                                </div>

                            </div>

                            {{-- CLIENT | TYPE | STATUS --}}
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group basicmodal">
                                        <label for="subtitle">Subtitle</label>
{{--                                        <input id="subtitle" value="{{WelcomePoster::all()->first->subtitle}}"  class="form-control" type="text" name="subtitle" placeholder="Poster Subtitle"/>--}}
                                    </div>
                                </div>

                            </div>

                            {{-- IMGS --}}

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

                        {{-- control --}}
                        {{-- this is for /created specific URL controller response method --}}
                        <span id="show_modal" hidden>@isset($show_details_modal){{ $show_details_modal }}@endisset</span>
                    </div>

                </div>
            </div>

            {{--Modal Footer--}}
            {{--<div class="modal-footer">--}}
            {{--<div class="">--}}
            {{--<p></p>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>

    </div>
</div>