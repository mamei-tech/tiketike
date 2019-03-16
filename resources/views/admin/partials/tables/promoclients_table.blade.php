<table id="table_promo" class="table table-striped table-bordered" cellspacing="0" width="100%">

    {{--Header--}}
    <thead class=" text-primary">
    <tr>
        <th>Id</th>
        <th>@lang('Client')</th>
        <th>@lang('Contact')</th>
        <th>Email</th>
        <th class="disabled-sorting text-right">@lang('Actions')</th>
    </tr>
    </thead>

    {{--Footer--}}
    <tfoot>
    <tr>
        <th rowspan="1" colspan="1">Id</th>
        <th rowspan="1" colspan="1">@lang('Client')</th>
        <th rowspan="1" colspan="1">@lang('Contact')</th>
        <th rowspan="1" colspan="1">Email</th>
        <th class="disabled-sorting text-right" rowspan="1" colspan="1">@lang('Actions')</th>
    </tr>
    </tfoot>

    <tbody>
    @foreach ($clients as $key => $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>
                @php

                    $phonelist = unserialize($client->contact);

                    for($i = 0; $i < count($phonelist); ++$i) {
                        echo $phonelist[$i] .' ' ;
                    }

                @endphp
            </td>
            <td>{{$client->email}}</td>

            <td class="text-right">
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