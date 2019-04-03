
<div class="modal fade" id="comment-{{$commentario->id}}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 60% !important; height: 300px !important;">
        <div class="modal-content" style="width: 100% !important;">
            <div class="modal-header padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding-left: 5%">
                    <span class="ti-close"></span>
                </button>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">Comment</h5>
            </div>
            <div class="modal-body">

                <form class="col-md-12" action="{{ route('comment.edit',$commentario->id) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-12">
                        {{-- FIRST NAME ¦ LASTNAME --}}

                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                {{ $commentario->getUser->name }} {{ $commentario->getUser->lastname }}
                            </div>
                        </div>
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Texto del Comentario</label>
                                <textarea name="text" class="form-control" id="text" placeholder="Raffle description">{{ $commentario->text }}</textarea>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-3">
                        <div class="row padding-top-20">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Editar
                                </button>
                            </div>

                            <div class="col-xs-5">
                                <a href="{{ route('comment.delete',$commentario->id) }}"  class="btn btn-sm btn-danger">
                                    Eliminar
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

