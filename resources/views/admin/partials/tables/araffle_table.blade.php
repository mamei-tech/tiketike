<table id="tbl_araffles" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead class=" text-primary">
    {{--TODO Use translations here--}}
    <tr>
        <th>
            ID
        </th>
        <th>
            Title
        </th>
        <th>
            Price
        </th>
        <th>
            T.Sold
        </th>
        <th>
            T.Total
        </th>
        <th>
            Progress
        </th>
        <th>
            A.Date
        </th>
        <th class="disabled-sorting text-right">
            Actions
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($raffles as $key => $raffle)
        <tr>
            <td>{{ $raffle->id }}</td>
            <td>{{ $raffle->title }}</td>
            <td>{{ $raffle->price }}</td>
            <td>{{ $raffle->solds_tickets }}</td>
            <td>{{ $raffle->tickets_count}}</td>
            <td>{{ ($raffle->solds_tickets * 100)/$raffle->tickets_count }} %</td>
            <td>{{ $raffle->activation_date }}</td>

            {{--Buttons --}}
            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}

                <a class="btn btn-info btn-icon btn-sm" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>

                <a id="deleteBtn" class="btn btn-danger btn-icon btn-sm remove" href="">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>