<form class="form-horizontal" method="post" action="{{ route('admin.raffle.saveconfig') }}"
      accept-charset="UTF-8" enctype="multipart/form-data" id="frm_configraffle">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="patch">
    {{-- TODO Include the password --}}

    {{-- Transaction Fee | Minimun Value 4 withdraw --}}
    <div class="row">

        <div class="col-md-4">
            <div class="form-group basic">
                <label>
                    Transaction Fee (%)
                    <a href="#" title="{{ $cnf['gwfee']->description }}">
                        <i class="fas fa-question"></i>
                    </a>
                </label>
                <input type="text" name="transactionfee" class="form-control" placeholder="transaction fee"
                       value="{{  $cnf['gwfee']->value }}">
                {{--<span class="form-text">{{  $cnf['gwfee']->description }}</span>--}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group basic">
                <label>
                    Min Withdraw Value ($)
                    <a href="#" title="{{ $cnf['minextractbalance']->description }}">
                        <i class="fas fa-question"></i>
                    </a>
                </label>
                <input type="text" name="minextractbalance" class="form-control" placeholder="minimun withdraw value"
                       value="{{  $cnf['minextractbalance']->value }}">
                {{--<span class="form-text">{{  $cnf['gwfee']->description }}</span>--}}
            </div>
        </div>

    </div>


    <br>

    {{-- BUTTONS --}}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <button class="btn btn-success btn-round" type="submit" value="add">
                    <i class="now-ui-icons ui-1_check"></i>
                    Save
                </button>
            </div>
        </div>
    </div>

</form>