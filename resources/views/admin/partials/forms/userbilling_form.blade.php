<form id="ftm_userBillingInfo" class="form-horizontal" method="post" action="{{ route('billing.saveinfo', Auth::id()) }}"
      accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="PATCH">

    {{-- ACCNUMBER ¦ CVV --}}
    {{-- By now we only will manage one credit card by user --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basic">
                <label> Account </label>
                <input type="text" name="accnumber" class="form-control" placeholder="0000000000000000"
                       value="@php count($user->debitcards) > 0 ?  print($user->debitcards[0]->accnumber) : print("") @endphp">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basic">
                <label> CVV </label>
                <input type="text" name="cvv" class="form-control" placeholder="00000"
                       value="@php count($user->debitcards) > 0 ? print($user->debitcards[0]->cvv) : print(""); @endphp">
            </div>
        </div>

    </div>

    {{-- EXPIRATION DATE --}}
    <div class="row">

        <div class="col-md-2">
            <div class="form-group basic">
                <label> Expiration Date </label>
                <input type="text" name="expdate_month" class="form-control" placeholder="00"
                       value="@php count($user->debitcards) > 0 ? print($user->debitcards[0]->getExpMonth()) : print(""); @endphp">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group basic">
                <label> &emsp; </label>
                <input type="text" name="expdate_year" class="form-control" placeholder="0000"
                       value="@php count($user->debitcards) > 0 ? print($user->debitcards[0]->getExpYear()) : print(""); @endphp">
            </div>
        </div>

    </div>

    <br>

    {{-- BUTTONS --}}
    <div class="row">

        <div class="col-md-9">
            <div class="form-group basic">
                <button id="btn-submit" class="btn btn-success btn-round" type="submit" value="add">
                    <b>
                        <i class="now-ui-icons ui-1_simple-add"></i>
                        @lang('buttons.save')
                    </b>
                </button>
            </div>
        </div>

    </div>

</form>