<form action="{{ route('admin.lansw') }}" method="post" hidden>
    {{ csrf_field() }}
    <label>
        <select name="locale">
            <option value="es" {{ \App\Facades\Loc::current() == 'es' ? 'selected' : '' }}></option>
            <option value="en" {{ \App\Facades\Loc::current() == 'en' ? 'selected' : '' }}></option>
        </select>
    </label>
    {{--<input type="submit" value="">--}}
</form>