<table id="groups_table" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead class="text-primary">
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
        <th class="disabled-sorting">
            Referrals
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($sharedRaffles as $key => $raffle)
        <tr>
            <td>{{ $raffle->id }}</td>
            <td>{{ $raffle->title }}</td>
            <td>{{ $raffle->price }}</td>

            {{--Buttons --}}
            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}

                <a class="btn btn-info btn-icon btn-sm like" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
