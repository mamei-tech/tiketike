<table id="tbl_praffles" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead class=" text-primary">
    {{--TODO Use translations here--}}
    <tr>
        <th>
            Id
        </th>
        <th>
            Title
        </th>
        <th>
            Price
        </th>
        <th>
            Profit
        </th>
        <th>
            T.Price
        </th>
        <th>
            T.Sold
        </th>
        <th>
            T.Total
        </th>
        <th>
            A.Date {{-- TODO show only the date --}}
        </th>
        <th class="disabled-sorting text-right">
            Act
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
            <td>{{ $raffle->activation_date }}</td>
            {{--<td>???</td>--}}
            <td class="text-right">


                {{-- Buttons --}}
                {{-- TODO Aling the action icons making them floating to right --}}
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