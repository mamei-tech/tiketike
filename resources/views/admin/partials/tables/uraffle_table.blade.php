<table id="tbl_uraffles" class="table table-striped table-bordered" cellspacing="0" width="100%">

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
        <th class="disabled-sorting text-right">
            Act
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($raffles as $key => $raffle)
        <tr>
            <td>{{ $raffle->id }}</td>
            <td>{{ $raffle->title }}</td>
            <td>{{ $raffle->price }}</td>

            {{--Buttons --}}
            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}

                <a class="btn btn-info btn-icon btn-sm" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>

                <a id="rpublish" class="btn btn-success btn-icon btn-sm" href="">
                    <i class="now-ui-icons arrows-1_cloud-upload-94"></i>
                </a>

                <a id="rdelete" class="btn btn-danger btn-icon btn-sm remove" href="">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>