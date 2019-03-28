<div class="collapse my-3" id="reply-{{$answer_text->id}}">

    <form action="{{route('raffle.comment', $raffleId)}}" method="POST" role="form" style="  padding-top: 30px">
        {{ csrf_field() }}
        <div class="form-group">
            <input  type="hidden" name="parent_id" value="{{$comment->id}}">
            <textarea maxlength="100" autofocus="true" class="form-control bg-gris"  rows="auto" cols="50" name="text" id="text" style="resize: none; height: 30px ">@if($isSon){{ $answer_text->getUser->name }} {{ $answer_text->getUser->lastname }}@endif
            </textarea>
            <div>
                {{ $errors->first('text') }}
            </div>
        </div>
        <button class="btn btn-primary bg_green extraer sinkinSans700B text-uppercase"
                type="submit">@lang('views.send')
        </button>
    </form>

</div>