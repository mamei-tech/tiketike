<!-- Modal-->
<div class="modal fade" id="createRaffleModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 60% !important;">
        <div class="modal-content" style="width: 100% !important;">
            <div class="modal-header padding-left-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding-left: 5%">
                    <span class="ti-close"></span>
                </button>
                <h5 class="modal-title text-uppercase textoCenter padding-top-20">NUEVA RIFA</h5>
            </div>
            <div class="modal-body">

                <form class="col-md-12" id="ftm_createRaffle" action="{{ route('raffles.index.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col-md-12">
                        {{-- FIRST NAME ¦ LASTNAME --}}

                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label for="title">Título de la rifa</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="Raffle title">
                            </div>
                        </div>
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Descripción de la rifa</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Raffle description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 pr-1">
                            <label for="Price"
                                   class="colorN italic padding-top-20">Precio</label>
                            <input type="number" class="form-control form-control-new " id="price"
                                   name="price" placeholder="Raffle price">
                        </div>

                        <div class="col-md-4 pr-1">
                            <label for="category"
                                   class="colorN italic padding-top-20">Categoría</label>
                            <select class="form-control form-control-new" name="category" id="category">
                                <option disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 pr-1">
                            <label for="localization"
                                   class="colorN italic padding-top-20">Localización</label>
                            <select class="form-control form-control-new selectpicker" name="localization" id="localization">
                                <option disabled selected>Select a country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="col-md-12 col-lg-12 col-xs-12" id="columns">
                                <h3 class="form-label">Select the images</h3>
                                <div class="desc"><p class="text-center">or drag to box</p></div>
                                <div id="uploads"><!-- Upload Content --></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row padding-top-20">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
