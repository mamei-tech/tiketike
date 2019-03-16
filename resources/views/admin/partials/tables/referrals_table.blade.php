
<table id="tbl_referrals" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead class=" text-primary">
    {{--TODO Use translations here--}}
    <tr>
        <th>
            ID
        </th>
        <th>
            Name
        </th>
        <th>
            Buyed Tickets
        </th>
    </tr>
    </thead>

    <tbody>
    {{--<h1>{{$referrals}}</h1>--}}
    @foreach ($referrals as $key => $r)
        <tr>
            {{--<td>{{ $r->id }}</td>--}}
            {{--<td>{{ $r->name }}</td>--}}
            {{--<td>{{ $r->shared_tickets }}</td>--}}
            <td>{{ $r }}</td>
            <td>{{ $r }}</td>
            <td>{{ $r }}</td>
        </tr>
    @endforeach
    </tbody>
</table>