@extends('admin.layouts.base')

@section('metas')
    @parent
    {{-- API Acces Tokens --}}
    <meta name="access-token" content="{{Auth::apitoken() }}">
@endsection

@section('headLinks')
    @parent
@endsection

@section('adminview', 'Payment Pendings')

@section('pageheader')
    @component('admin.components.pageheader')
        @slot('classSpec')
            panel-header-sm
        @endslot
    @endcomponent
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title"> Payment Pendings </h4>
                </div>

                <div class="card-body">


                    @include('admin.partials.tables.payment_pending_table')

                    {{ $payments->links() }}
                </div>
            </div>
        </div>

        {{--Create Role Modal --}}
        @include('admin.partials.modals.payment_pending_details_modal')

    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="{{ asset('js/admin/admin_views.js') }}" defer></script>
    <script src="{{ asset('js/admin/payment.js') }}" defer></script>
@endsection
