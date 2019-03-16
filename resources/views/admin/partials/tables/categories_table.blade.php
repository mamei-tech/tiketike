<table id="tbl_categories" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class=" text-primary">
    <tr>
        <th>
            ID
        </th>
        <th>
            @lang('tables.name')
        </th>
        <th>
            @lang('tables.icon')
        </th>
        <th class="disabled-sorting text-right">
            Act
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category }}</td>
            <td><i class="now-ui-icons {{ $category->icon }}"></i></td>

            {{--Buttons --}}
            <td class="text-right">

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