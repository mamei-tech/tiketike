<table id="table_promo" class="table table-striped table-bordered" cellspacing="0" width="100%">

    {{--Header--}}
    <thead class=" text-primary">
    <tr>
        {{-- TODO make the id column thinner. Make this in the JS file for this file --}}
        <th>Id</th>
        <th>@lang('Name')</th>
        <th>@lang('aPromo.type')</th>
        <th>@lang('aPromo.sts')</th>
        <th>@lang('aPromo.expdate')</th>
        <th>@lang('aPromo.prvw')</th>
        <th class="disabled-sorting text-right">@lang('Actions')</th>
    </tr>
    </thead>

    {{--Footer--}}
    <tfoot>
    <tr>
        <th rowspan="1" colspan="1">Id</th>
        <th rowspan="1" colspan="1">@lang('Name')</th>
        <th rowspan="1" colspan="1">@lang('aPromo.type')</th>
        <th rowspan="1" colspan="1">@lang('aPromo.sts')</th>
        <th rowspan="1" colspan="1">@lang('aPromo.expdate')</th>
        <th rowspan="1" colspan="1">@lang('aPromo.prvw')</th>
        <th class="disabled-sorting text-right" rowspan="1" colspan="1">@lang('Actions')</th>
    </tr>
    </tfoot>

    <tbody>
    @foreach ($promos as $key => $promo)
        <tr>
            <td>{{$promo->id}}</td>
            <td>{{$promo->name}}</td>
            <td>
                @if ($promo->type === 0)
                    Principal
                @else
                    Secundary
                @endif
            </td>
            <td>
                @if ($promo->status === 1)
                    <i class="now-ui-icons ui-1_check enable" id="enable"></i>
                @else
                    <i class="now-ui-icons ui-1_simple-remove unable" id="unable"></i>
                @endif
            </td>
            <td>{{$promo->expdate}}</td>
            <td>{{$promo->image}}</td>

            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}
                <a class="btn btn-info btn-icon btn-sm like" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>
                <a class="btn btn-success btn-icon btn-sm edit" href="">
                    <i class="now-ui-icons ui-2_settings-90"></i>
                </a>
                <a class="btn btn-danger btn-icon btn-sm remove" href="">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>