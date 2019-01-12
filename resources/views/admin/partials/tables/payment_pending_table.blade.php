<table id="tbl_ppending" class="table table-striped table-bordered" cellspacing="0" width="100%">

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
            Description
        </th>
        <th class="disabled-sorting text-right">
            Act
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($payments as $key => $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->name }}</td>
            <td>{{ $payment->description }}</td>

            {{--Buttons --}}
            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}

                <a id="details" class="btn btn-info btn-icon btn-sm details" href="">
                    <i class="now-ui-icons education_glasses"></i>
                </a>

                <a id="pay" class="btn btn-success btn-icon btn-sm pay" href="">
                    <i class="now-ui-icons business_money-coins"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>