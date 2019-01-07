/**
 * Manejar el formulario de reserva de Hotel
 *
 * Date: 16/09/16
 * v0.1
 *
 * @dependence: Jquery, blockUI
 * @author: Luis L. Rodriguez Oro <roll3lg@gmail.com>
 *
 */
var ReservaHotel = function () {

    // inicializar comportamientos y otros
    var _init = function (conf) {
        // combinar opciones
        jQuery.extend(dateOptions, conf.dateOptions);
        jQuery.extend(config, conf);

        $('select[name="noches[]"], select[name="tipo_habitacion[]"], select[name="plan[]"]').change(function () {
            _buscarDatosReserva($(this));
        });

        $('select[name="tipo_habitacion[]"]').change(function () {
            _cantAdultoNino($(this));
            _buscarDatosReserva($(this));
        });

        $('select[name="cant_adulto[]"]').change(function () {
            _relacionAdultoNino($(this));
            _buscarDatosReserva($(this));
        });

        $('select[name="cant_nino[]"]').change(function () {
            _relacionNinoInfante($(this));
            _buscarDatosReserva($(this));
        });

        $('input[name="fecha[]"]').datepicker(dateOptions).on(
            'changeDate', function (ev) {
                _buscarDatosReserva($(this));
            }
        );

        $('select[name="cantidad_habitaciones"]').change(function () {

            var cant_selected = $(this).val();

            if (cant_selected > 0) {
                var cant_habitacion = $('div[data-type="habitacion"]').length;
                var cant_for = cant_selected - cant_habitacion;

                if (cant_for > 0) {
                    var last = $('div[data-type="habitacion"]:last');

                    for (var k = 0; k < cant_for; k++) {
                        var new_obj = last.clone();
                        new_obj.appendTo($('div[data-type="group-habitaciones"]:last'));

                        _doThisInNewHab(new_obj, last);
                    }
                } else {
                    for (var i = 0; i > cant_for; i--) {
                        $('div[data-type="habitacion"]:last').remove();
                    }
                }
                _calcularPrecio();
            }
        });

        if (config.selectedHabit != '') {
            $('select[name="tipo_habitacion[]"]').val(config.selectedHabit);
        }
    };

    var _doThisInNewHab = function (newHab, lastHab) {
        _eventForNewHab(newHab);
        var all = $('div[data-type="habitacion"]');
        var numHab = newHab.find('[data-habit="numero"]');

        numHab.html(all.length);

        // hacer coincidir el valor del objeto clonado con el del original
        newHab.find('select[name="tipo_habitacion[]"]').val(lastHab.find('select[name="tipo_habitacion[]"]').val());
        newHab.find('select[name="noches[]"]').val(lastHab.find('select[name="noches[]"]').val());
        newHab.find('select[name="cant_infante[]"]').val(lastHab.find('select[name="cant_infante[]"]').val());
        newHab.find('select[name="cant_nino[]"]').val(lastHab.find('select[name="cant_nino[]"]').val());
        newHab.find('select[name="cant_adulto[]"]').val(lastHab.find('select[name="cant_adulto[]"]').val());
        newHab.find('select[name="plan[]"]').val(lastHab.find('select[name="plan[]"]').val());

    };

    /*
     * Redefinir eventos para los objetos de la nueva habitación
     */
    var _eventForNewHab = function (hab) {
        hab.find('select[name="noches[]"], select[name="tipo_habitacion[]"], select[name="plan[]"]').change(function () {
            _buscarDatosReserva($(this));
        });

        hab.find('select[name="cant_adulto[]"]').change(function () {
            _relacionAdultoNino($(this));
            _buscarDatosReserva($(this));
        });

        hab.find('select[name="cant_nino[]"]').change(function () {
            _relacionNinoInfante($(this));
            _buscarDatosReserva($(this));
        });

        var fecha = hab.find('input[name="fecha[]"]');
        fecha.datepicker(dateOptions).on(
            'changeDate', function (ev) {
                _buscarDatosReserva($(this));
            }
        );
    };

    /*
     * Crea una nueva opción en un objeto select
     */
    var _createOption = function (value, text, other) {
        var option_html = '';
        if (other == value) {
            option_html = '<option value="' + value + '" selected="selected">' + text + '</option>';
        } else {
            option_html = '<option value="' + value + '">' + text + '</option>';
        }

        return option_html;
    };

    var _isHoraOk = function () {
        var resp = true;
        $('input[name="hora[]"]').each(function (index, term) {
            if (resp == true) {
                var new_hora = 0;
                new_hora = ($(this).val());

                if (new_hora < config.horaCheckIn || new_hora > '23:59') {
                    resp = false;
                }
            }
        });

        return resp;
    };

    var _isPrecioOk = function () {
        var resp = true;
        $('input[name="precio_habitacion[]"]').each(function (index, term) {
            if (resp == true) {
                var new_price = 0;
                new_price = parseInt($(this).val());
                if (new_price == 0) {
                    resp = false;
                }
            }
        });

        return resp;
    };

    var _validar = function () {

        if (!_isHoraOk()) {
            _showMessage(config.errHoraIncorrecta);
            return false;
        }

        if (!_isPrecioOk()) {
            _showMessage(config.errHabIncorrecta);
            return false;
        }

        if ($('.importe_campo').val($('#precio_hab').val()) == '') {
            _showMessage(config.errNoPrecio);
            return false;
        }

        return true;
    };

    var _cantAdultoNino = function (elemento) {
        var currentHab = elemento.parents('div[data-type="habitacion"]');
        $.ajax({
            url: config.urlCapHab,
            cache: false,
            type: "post",
            data: {
                'hotel': config.hotelId,
                'hab': currentHab.find('select[name="tipo_habitacion[]"]').val()
            },
            dataType: "json",
            beforeSend: function () {
                _startLoading(currentHab);
            },
            success: function (msg) {
                if (msg.ok == 't') {
                    var obj = currentHab.find('select[name="cant_adulto[]"]');
                    $.each(msg.max_adultos, function (i, item) {
                        obj.append(_createOption(i, i));
                    });

                    currentHab.find('select[name="cant_nino[]"]').empty();
                    $.each(msg.max_ninos, function (i, item) {
                        currentHab.find('select[name="cant_nino[]"]').append(_createOption(i, i));
                    });

                    currentHab.find('select[name="cant_infante[]"]').empty();
                    $.each(msg.max_ninos, function (i, item) {
                        currentHab.find('select[name="cant_infante[]"]').append(_createOption(i, i));
                    });
                }

                _stopLoading(currentHab)
            }
        });
    };

    var _relacionAdultoNino = function (elemento) {
        var currentHab = elemento.parents('div[data-type="habitacion"]');
        var adulto = currentHab.find('select[name="cant_adulto[]"]').val();
        var nino = currentHab.find('select[name="cant_nino[]"]').val();

        $.ajax({
            url: config.urlPerHab,
            cache: false,
            type: "post",
            data: {
                'hotel': config.hotelId,
                'hab': currentHab.find('select[name="tipo_habitacion[]"]').val(),
                'adulto': adulto,
                'nino': nino
            },
            dataType: "json",
            beforeSend: function () {
                _startLoading(currentHab);
            },
            success: function (msg) {
                _updateBoys(msg, 0, currentHab);
                _stopLoading(currentHab);
            }
        });
    };

    var _relacionNinoInfante = function (elemento) {
        var currentHab = elemento.parents('div[data-type="habitacion"]');
        var nino = currentHab.find('select[name="cant_nino[]"]').val();
        var adulto = currentHab.find('select[name="cant_adulto[]"]').val();

        $.ajax({
            url: config.urlPerHab,
            cache: false,
            type: "post",
            data: {
                'hotel': config.hotelId,
                'hab': currentHab.find('select[name="tipo_habitacion[]"]').val(),
                'nino': nino,
                'adulto': adulto
            },
            dataType: "json",
            beforeSend: function () {
                _startLoading(currentHab);
            },
            success: function (msg) {
                _updateBoys(msg, nino, currentHab);
                _stopLoading(currentHab);
            }
        });
    };

    /*
     * Actualizar select de niños e infantes
     */
    var _updateBoys = function (msg, nino, currentHab) {
        if (msg.ok == 't') {
            var obj = currentHab.find('select[name="cant_nino[]"]');
            obj.empty();
            $.each(msg.max_ninos, function (i, item) {
                obj.append(_createOption(i, i, nino));
            });

            var cant = msg.max_ninos.length - 1;
            currentHab.find('select[name="cant_infante[]"]').empty();
            for (var i = 0; i <= cant; i++) {
                currentHab.find('select[name="cant_infante[]"]').append(_createOption(i, i, 0));
            }
        }
    };

    var _buscarDatosReserva = function (elemento) {
        var currentHab = elemento.parents('div[data-type="habitacion"]');
        var adultos = currentHab.find('select[name="cant_adulto[]"]').val();
        var ninnos = currentHab.find('select[name="cant_nino[]"]').val();
        if ((adultos == 3 && ninnos == 2) || (adultos == 3 && ninnos == 1)) {
            ninnos = 0;
            currentHab.find('select[name="cant_nino[]"]').val(ninnos);
        }
        if ((adultos == 0 && ninnos == 1)) {
            ninnos = 2;
            currentHab.find('select[name="cant_nino[]"]').val(ninnos);
        }

        $.ajax({
            'url': config.urlCalPrecio,
            'data': {
                'hotel': config.hotelId,
                'cadena': config.cadenaId,
                'tipo_habitacion': currentHab.find('select[name="tipo_habitacion[]"]').val(),
                'plan': currentHab.find('select[name="plan[]"]').val(),
                'noches': currentHab.find('select[name="noches[]"]').val(),
                'fecha': currentHab.find('input[name="fecha[]"]').val(),
                'adulto': adultos,
                'nino': ninnos
            },
            'dataType': 'json',
            'type': 'POST',
            beforeSend: function () {
                _startLoading(currentHab);
            },
            success: function (data) {
                if (data.error) {
                    _showMessage(config.errPrecio);
                    currentHab.find('span[data-habit="precio"]').html(0);
                    currentHab.find('input[name="precio_habitacion[]"]').val(0);
                    $('input[type="submit"]').attr('disabled', 'disabled');
                    _stopLoading(currentHab);
                    return 0;
                }
                if (data == '-2') {
                    _showMessage(config.errParo);
                    currentHab.find('span[data-habit="precio"]').html(0);
                    currentHab.find('input[name="precio_habitacion[]"]').val(0);
                    $('input[type="submit"]').attr('disabled', 'disabled');
                    _stopLoading(currentHab);
                    return 0;
                }
                if (data == '-3') {
                    _showMessage(config.errPolitica);
                    currentHab.find('span[data-habit="precio"]').html(0);
                    currentHab.find('input[name="precio_habitacion[]"]').val(0);
                    _stopLoading(currentHab);
                    $('input[type="submit"]').attr('disabled', 'disabled');
                    return 0;
                }
                if (data != -1) {
                    currentHab.find('span[data-habit="precio"]').html(data.precio_convertido + ' ' + data.ltr_moneda);
                    currentHab.find('input[name="precio_habitacion[]"]').val(data.precio);

                    var html = '';
                    currentHab.find('[data-habit="oferta"]').remove();
                    if (data.oferta != null) {
                        var oferta = data.oferta;
                        html = config.htmlOferta;

                        html = html.replace('__lang_offer_', config.langResOferta);
                        html = html.replace('__title__', oferta.titulo);
                        html = html.replace('__price__', oferta.precio);
                        html = html.replace('__description__', oferta.descripcion);
                        html = html.replace('__startDate__', oferta.fecha_aplicacion);
                        html = html.replace('__endDate__', oferta.fecha_fin_aplicacion);

                        currentHab.append(html);
                    }

                    currentHab.find('[data-habit="suplemento"]').remove();
                    if (data.suplemento != null) {
                        var sup = data.suplemento;
                        html = config.htmlSuplemento;

                        html = html.replace('__lang_suple__', config.langSuplAdicional);
                        html = html.replace('__title__', sup.titulo);
                        html = html.replace('__price__', sup.precio);
                        html = html.replace('__description__', sup.descripcion);
                        html = html.replace('__startDate__', sup.fecha_inicio);
                        html = html.replace('__endDate__', sup.fecha_fin);

                        currentHab.append(html);
                    }

                    _calcularPrecio();
                } else {
                    _showMessage(config.errPrecio);
                }

                _stopLoading(currentHab);
            }
        });
    };

    var _calcularPrecio = function () {
        var new_price = 0;

        $('input[name="precio_habitacion[]"]').each(function (index, term) {
            new_price += parseInt($(this).val() * 100);
        });

        if (new_price > 0) {
            $('input[type="submit"]').removeAttr('disabled');
        }
        new_price = new_price / 100;
        $('#importe_a_pagar').html(new_price + ' ' + config.moneda);
        $('input[name="importe_campo"]').val(new_price);
    };

    /*
     * Modificado para bootstrap-date-picker
     */
    var _nonWorkingDates = function (date) {
        var fecha;
        try {
            // mozilla
            fecha = date.toLocaleFormat("%Y/%m/%d");
        } catch (e) {
            // chrome & ?..
            var m = date.getMonth() + 1; // chrome devuelve el mes mal (decrementado en 1, porque??)
            m = m < 10 ? '0' + m : m; // 2 dígitos
            var d = date.getDate();
            d = d < 10 ? '0' + d : d; // 2 dígitos
            fecha = date.getFullYear() + '/' + m + '/' + d;
        }

        for (i = 0; i < config.closedDates.length; i++) {
            var fechaMin = config.closedDates[i][0];
            var fechaMax = config.closedDates[i][1];

            if (fecha >= fechaMin && fecha <= fechaMax) {
                return false;
            }
        }

        return true;
    };

    /*
     * Muestra el div que indica que se está realizando una operación
     */
    var _startLoading = function (obj) {

        var html = '<div class="loading-message "><div class="block-spinner-bar">' +
            '<div class="bounce1"></div>' +
            '<div class="bounce2"></div>' +
            '<div class="bounce3"></div>' +
            '</div></div>';

        var conf = {
            message: html,
            css: {
                border: '0',
                padding: '0',
                backgroundColor: 'none'
            },
            overlayCSS: {
                backgroundColor:  '#555',
                opacity: 0.6,
                cursor: 'wait'
            }
        };

        if (typeof obj == 'undefined') {
            $.blockUI(conf);
        } else {
            obj.block(conf);
        }

    };

    /*
     * Elimina el div que indica que se está realizando una operación
     */
    var _stopLoading = function (obj) {
        if (typeof obj == 'undefined') {
            $.unblockUI();
        } else {
            obj.unblock({});
        }
    };

    /*
     * Mostrar una alerta, se sugiere sobreescribir el comportamiento de la función alert de forma global
     */
    var _showMessage = function (text) {
        alert(text);
    };

    // configuración por defecto de los date-picker
    var dateOptions = {
        language: 'en',
        format: 'yyyy-mm-dd',
        autoclose: true,
        beforeShowDay: _nonWorkingDates
    };

    // opciones de configuración
    var config = {
        closedDates: [],
        dateOptions: {},
        errNoPrecio: '',
        errPrecio: '',
        errParo: '',
        errPolitica: '',
        errHoraIncorrecta: '',
        errHabIncorrecta: '',
        errLimHab: '',
        langResOferta: '',
        langSuplAdicional: '',
        moneda: '',
        urlCapHab: '',
        urlPerHab: '',
        urlCalPrecio: '',
        hotelId: 1,
        cadenaId: 1,
        horaCheckIn: '',
        selectedHabit: '',
        habitaciones: [],
        maxCountHab: 20,
        htmlSuplemento: '<div data-habit="suplemento" class="col-xs-12 margin-top20"><div class="letra-negrita alert-info">__lang_suple__: __title__, + __price__ <br>__description__ </div> </div>',
        htmlOferta: '<div data-habit="oferta" class="col-xs-12 margin-top20"><div class="letra-negrita alert-info">__lang_offer_: __title__, + __price__ <br>__description__ </div> </div>'
    };

    return {
        init: function (conf) {
            _init(conf);
        },

        validar: function () {
            return _validar();
        },

        isDisabledDay: function() {
            return _nonWorkingDates;
        }
    };
}();