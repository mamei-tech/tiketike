<table id="tbl_comments" class="table table-striped table-bordered" cellspacing="0" width="100%">

    <thead class=" text-primary">
    {{--TODO Use translations here--}}
    <tr>
        <th>
            ID
        </th>
        <th>
            User
        </th>
        <th>
            Raffle
        </th>
        <th>
            Parent
        </th>
        <th>
            Text
        </th>
        <th>
            Created At
        </th>
        <th class="disabled-sorting text-right">
            Act
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach ($comments as $key => $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td>{{ $comment->user }}</td>
            <td>{{ $comment->raffle }}</td>
            <td>{{ $comment->parent }}</td>
            <td>{{ $comment->text }}</td>
            <td>{{ $comment->created_at }}</td>

            {{--Buttons --}}
            <td class="text-right">
                {{-- TODO Aling the action icons making them floating to right --}}

                <a class="btn btn-info btn-icon btn-sm like" href="">
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