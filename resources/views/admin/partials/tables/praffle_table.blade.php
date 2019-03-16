<table id="tbl_praffles" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="text-primary">
    <tr>
        <th>
            Id
        </th>
        <th>
            @lang('tables.title')
        </th>
        <th>
            @lang('tables.price')
        </th>
        <th>
            @lang('tables.profit')
        </th>
        <th>
            @lang('tables.ticket_price')
        </th>
        <th>
            @lang('tables.ticket_sold')
        </th>
        <th>
            @lang('tables.ticket_total')
        </th>
        <th>
            @lang('tables.activation_date')
        </th>
        <th class="disabled-sorting text-right">
            @lang('tables.action')
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($raffles as $raffle)
        <tr>
            <td>{{ $raffle->id }}</td>
            <td>{{ $raffle->title }}</td>
            <td>{{ $raffle->price }}</td>
            <td>{{ $raffle->profit }}</td>
            <td>{{ $raffle->tickets_price }}</td>
            <td>{{ $raffle->getTicketsSold() }}</td>
            <td>{{ count($raffle->getTickets)}}</td>
            <td>{{ $raffle->activation_date->format('d/m/Y') }}</td>
            {{--<td>???</td>--}}
            <td class="text-right">
                @if($raffle->progress == 100)
                    <a id="rpublish" class="btn btn-info btn-icon btn-sm" href="{{ route('praffle.shuffle',['id'=> $raffle->id]) }}">
                        <i class="now-ui-icons loader_refresh"></i>
                    </a>
                @endif

                <a id="rdelete" class="btn btn-danger btn-icon btn-sm remove" href="">
                    <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                </a>
            </td>

        </tr>
    @endforeach
</table>