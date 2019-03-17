<!--Modal para mostrar las categorias y el filtrar en la vista movil-->
<div class="style">
    <div class="categoriasR hidden-lg visible-xs">
        <!-- Button trigger modal -->
        <a data-toggle="modal" href="#myModal" class="btn btnCategoriasR colorB bg-categoriasR"></a>
        <!-- Modal -->
        <div class="modal fullscreen-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header padding-top-30">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title textoCenter sinkinSans600SB text-uppercase colorN">@lang('views.categories')</h5>
                    </div>
                    <div class="modal-body">
                        <div class="listadoCategoriaR text-center">
                            <ul class="nav sinkinSans400R">
                                <li class="active"><a href="#" class="colorN text-uppercase" id="Rall">@lang('views.all')</a></li>
                                @foreach($categories as $category)
                                    <li><a href="#" id="{{ $category->category }}" class="colorN text-uppercase filters">{{$category->category}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div class="filtrarR hidden-lg visible-xs">
        <!-- Button trigger modal -->
        <a data-toggle="modal" href="#myModalFiltrar" class="btn btnFiltrarR bg-filtrarR colorB"></a>
        <!-- Modal -->
        <div class="modal fullscreen-modal fade" id="myModalFiltrar" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header padding-top-30">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title textoCenter text-uppercase colorN">@lang('views.filter_by')</h5>
                    </div>
                    <div class="modal-body">
                        <div class="listadoCategoriaR">
                            <h5 class="modal-title textoCenter text-uppercase colorV">@lang('views.countries')</h5>
                            <div class="paddingFiltrar">
                                @foreach($continents as $continent)
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <button class="btn btn-default text-left" style="width: 100%" data-toggle="collapse"
                                                            data-target="#collapseR{{ $continent->id }}">{{ $continent->name }} <i class="fa fa-angle-down right"></i> </button>
                                                </h4>
                                            </div>
                                            <div id="collapseR{{ $continent->id }}" class="panel-collapse collapse">
                                                @foreach($continent->countries as $country)
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-{{strlen($country->name) > 20?'12':'6'}}" style="padding: 5px 5px 5px 0">
                                                        <label for="countries">{{ $country->name }}</label>
                                                        <input class="right" type="checkbox" name="countries" id="countries">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                @endforeach
                            </div>
                            <h5 class="modal-title textoCenter text-uppercase colorV padding-top-20">@lang('views.price')</h5>
                            <div class="subtPais borderBottomG checkbox">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    @lang('views.from') 0 @lang('views.to') 19 usd
                                </label>
                            </div>
                            <div class="subtPais borderBottomG checkbox padding-top-15">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    @lang('views.from') 20 @lang('views.to') 39 usd
                                </label>
                            </div>
                            <div class="subtPais borderBottomG checkbox padding-top-15">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    @lang('views.from') 40 @lang('views.more_than')
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div class="ordenarPorcientoR visible-xs">
        <a class="btn btnOrdenarPorcientoR colorB bg-ordenarPorcientoR texto18" id="percentR">%</a>
    </div>
    <div class="ordenarPrecioR visible-xs">
        <a class="btn btnOrdenarPorcientoR colorB bg-ordenarPorcientoR" id="priceR"><i class="fa fa-dollar texto18"></i></a>
    </div>
</div>
<!--FIN Modal para mostrar las categorias y el filtrar en la vista movil-->