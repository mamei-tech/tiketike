<table id="groups_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="text-primary">
    <tr>
        <th>
            ID
        </th>
        <th>
            @lang('tables.title')
        </th>
        <th>
            @lang('tables.price')
        </th>
        <th class="disabled-sorting">
            @lang('tables.referrals')
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
                <a class="btn btn-info btn-icon btn-sm like" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
