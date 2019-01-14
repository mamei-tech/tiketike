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
                        <h5 class="modal-title textoCenter sinkinSans600SB text-uppercase colorN">categorias</h5>
                    </div>
                    <div class="modal-body">
                        <div class="listadoCategoriaR text-center">
                            <ul class="nav sinkinSans400R">
                                <li class="active"><a href="#" class="colorN text-uppercase" id="all">Todos</a></li>
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
                        <h5 class="modal-title textoCenter text-uppercase colorN">filtrar por</h5>
                    </div>
                    <div class="modal-body">
                        <div class="listadoCategoriaR">
                            <h5 class="modal-title textoCenter text-uppercase colorV">paises</h5>
                            <div class="america">
                                <div class="panel-heading borderBottomG" role="tab" id="">
                                    <div class="subtPais caption checkbox">
                                        <label>
                                            <input class="letra-naranja" type="checkbox">
                                            América
                                        </label>
                                    </div>
                                    <div class="tools">
                                        <a class="paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                           href="#americaR" aria-expanded="true" aria-controls="collapseThree"></a>
                                    </div>

                                </div>
                                <div id="americaR" class="panel-collapse collapse in" role="tabpanel"
                                     aria-labelledby="headingThree" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">EEUU
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Canadá
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input class="" type="checkbox">
                                                        Colombia
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Brasil
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="europa">
                                <div class="panel-heading borderBottomG" role="tab" id="">
                                    <div class="subtPais caption checkbox">
                                        <label>
                                            <input class="letra-naranja" type="checkbox">
                                            Europa
                                        </label>
                                    </div>
                                    <div class="tools">
                                        <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                           href="#europaR" aria-expanded="true" aria-controls="collapseThree"></a>
                                    </div>

                                </div>
                                <div id="europaR" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">EEUU
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Canadá
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input class="" type="checkbox">
                                                        Colombia
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Brasil
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="asia">
                                <div class="panel-heading borderBottomG" role="tab" id="">
                                    <div class="subtPais caption checkbox">
                                        <label>
                                            <input class="letra-naranja" type="checkbox">
                                            Asia
                                        </label>
                                    </div>
                                    <div class="tools">
                                        <a class="collapsed paddingCollapse" data-toggle="collapse" data-parent="#accordion"
                                           href="#asiaR" aria-expanded="true" aria-controls="collapseThree"></a>
                                    </div>

                                </div>
                                <div id="asiaR" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="headingThree" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">EEUU
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Canadá
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input class="" type="checkbox">
                                                        Colombia
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label class="texto10">
                                                        <input value="remember-me" type="checkbox">Brasil
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="modal-title textoCenter text-uppercase colorV padding-top-20">precios</h5>
                            <div class="subtPais borderBottomG checkbox">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    de 0 a 19 usd
                                </label>
                            </div>
                            <div class="subtPais borderBottomG checkbox padding-top-15">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    de 20 a 39 usd
                                </label>
                            </div>
                            <div class="subtPais borderBottomG checkbox padding-top-15">
                                <label>
                                    <input class="letra-naranja" type="checkbox">
                                    de 40 o más usd
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div class="ordenarPorcientoR visible-xs">
        <a class="btn btnOrdenarPorcientoR colorB bg-ordenarPorcientoR texto18">%</a>
    </div>
    <div class="ordenarPrecioR visible-xs">
        <a class="btn btnOrdenarPorcientoR colorB bg-ordenarPorcientoR"><i class="fa fa-dollar texto18"></i></a>
    </div>
</div>
<!--FIN Modal para mostrar las categorias y el filtrar en la vista movil-->