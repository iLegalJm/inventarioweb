@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Lista de ingresos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">

        <div class="card-body table-responsive">
            <table id="ingresos" class="table table-hover table-striped table-sm cursor-default"">
                <thead class="table-dark">
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($ordenpedidos as $ordenpedido)
                        <tr>
                            <td>{{ $ordenpedido->codigo }}</td>
                            <td>{{ $ordenpedido->fecha }}</td>
                            <td>{{ $ordenpedido->cliente->numerodocumento }}</td>
                            <td>{{ $ordenpedido->total }}</td>
                            <td style="">
                                <a href="{{ route('admin.ordenpedidos.edit', $ordenpedido->codigo) }}" class="btn btn-sm btn-primary">Editar</a>
                                <button id="btnmodal" type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#exampleModal" data-datos="{{ $ordenpedido->detallepedido }}"><i
                                        class="fa fa-solid fa-eye"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del ingreso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="detalles-ingreso" class="table table-hover table-striped table-sm cursor-default">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="http://integrador.test/vendor/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
    //     let dataTableOptions = {
    //         responsive: true,
    //         dom: "Bfrtilp",
    //         buttons: [{
    //                 extend: "excelHtml5",
    //                 style: 'bar',
    //                 text: "<i class='fa fa-file-csv'></i>",
    //                 titleAttr: "Exportar a excel",
    //                 className: "btn btn-success btn-lg"
    //             },
    //             {
    //                 extend: 'spacer',
    //                 style: 'bar',
    //             },
    //             {
    //                 extend: "pdfHtml5",
    //                 text: "<i class='fa fa-file-pdf'></i>",
    //                 titleAttr: "Exportar pdf",
    //                 className: "btn btn-danger btn-lg"
    //             },
    //             {
    //                 extend: 'spacer',
    //                 style: 'bar',
    //             },
    //             {
    //                 extend: "print",
    //                 text: "<i class='fa fa-solid fa-print'></i>",
    //                 titleAttr: "Imprimir",
    //                 className: "btn btn-warning btn-lg"
    //             },
    //             {
    //                 extend: 'spacer',
    //                 style: 'bar',
    //             },
    //             {
    //                 text: 'Registrar ingreso',
    //                 action: function(e, dt, button, config) {
    //                     window.location = 'ingresos/create';
    //                 }
    //             }
    //         ],
    //         lengthMenu: [10, 25, 50],
    //         columnDefs: [{
    //                 orderable: false,
    //                 target: [0]
    //             },
    //             {
    //                 searchable: false,
    //                 target: [3]
    //             },
    //             {
    //                 width: '8%',
    //                 target: [0, 1]
    //             },
    //             {
    //                 width: '15%',
    //                 target: [7]
    //             }
    //         ],
    //         pageLength: 10,
    //         destroy: true,
    //         language: {
    //             "processing": "Procesando...",
    //             "lengthMenu": "Mostrar _MENU_ registros",
    //             "zeroRecords": "No se encontraron resultados",
    //             "emptyTable": "Ningún dato disponible en esta tabla",
    //             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    //             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    //             "search": "Buscar:",
    //             "infoThousands": ",",
    //             "loadingRecords": "Cargando...",
    //             "paginate": {
    //                 "first": "Primero",
    //                 "last": "Último",
    //                 "next": "Siguiente",
    //                 "previous": "Anterior"
    //             },
    //             "aria": {
    //                 "sortAscending": ": Activar para ordenar la columna de manera ascendente",
    //                 "sortDescending": ": Activar para ordenar la columna de manera descendente"
    //             },
    //             "buttons": {
    //                 "copy": "Copiar",
    //                 "colvis": "Visibilidad",
    //                 "collection": "Colección",
    //                 "colvisRestore": "Restaurar visibilidad",
    //                 "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
    //                 "copySuccess": {
    //                     "1": "Copiada 1 fila al portapapeles",
    //                     "_": "Copiadas %ds fila al portapapeles"
    //                 },
    //                 "copyTitle": "Copiar al portapapeles",
    //                 "csv": "CSV",
    //                 "excel": "Excel",
    //                 "pageLength": {
    //                     "-1": "Mostrar todas las filas",
    //                     "_": "Mostrar %d filas"
    //                 },
    //                 "pdf": "PDF",
    //                 "print": "Imprimir",
    //                 "renameState": "Cambiar nombre",
    //                 "updateState": "Actualizar",
    //                 "createState": "Crear Estado",
    //                 "removeAllStates": "Remover Estados",
    //                 "removeState": "Remover",
    //                 "savedStates": "Estados Guardados",
    //                 "stateRestore": "Estado %d"
    //             },
    //             "autoFill": {
    //                 "cancel": "Cancelar",
    //                 "fill": "Rellene todas las celdas con <i>%d<\/i>",
    //                 "fillHorizontal": "Rellenar celdas horizontalmente",
    //                 "fillVertical": "Rellenar celdas verticalmentemente"
    //             },
    //             "decimal": ",",
    //             "searchBuilder": {
    //                 "add": "Añadir condición",
    //                 "button": {
    //                     "0": "Constructor de búsqueda",
    //                     "_": "Constructor de búsqueda (%d)"
    //                 },
    //                 "clearAll": "Borrar todo",
    //                 "condition": "Condición",
    //                 "conditions": {
    //                     "date": {
    //                         "after": "Despues",
    //                         "before": "Antes",
    //                         "between": "Entre",
    //                         "empty": "Vacío",
    //                         "equals": "Igual a",
    //                         "notBetween": "No entre",
    //                         "notEmpty": "No Vacio",
    //                         "not": "Diferente de"
    //                     },
    //                     "number": {
    //                         "between": "Entre",
    //                         "empty": "Vacio",
    //                         "equals": "Igual a",
    //                         "gt": "Mayor a",
    //                         "gte": "Mayor o igual a",
    //                         "lt": "Menor que",
    //                         "lte": "Menor o igual que",
    //                         "notBetween": "No entre",
    //                         "notEmpty": "No vacío",
    //                         "not": "Diferente de"
    //                     },
    //                     "string": {
    //                         "contains": "Contiene",
    //                         "empty": "Vacío",
    //                         "endsWith": "Termina en",
    //                         "equals": "Igual a",
    //                         "notEmpty": "No Vacio",
    //                         "startsWith": "Empieza con",
    //                         "not": "Diferente de",
    //                         "notContains": "No Contiene",
    //                         "notStartsWith": "No empieza con",
    //                         "notEndsWith": "No termina con"
    //                     },
    //                     "array": {
    //                         "not": "Diferente de",
    //                         "equals": "Igual",
    //                         "empty": "Vacío",
    //                         "contains": "Contiene",
    //                         "notEmpty": "No Vacío",
    //                         "without": "Sin"
    //                     }
    //                 },
    //                 "data": "Data",
    //                 "deleteTitle": "Eliminar regla de filtrado",
    //                 "leftTitle": "Criterios anulados",
    //                 "logicAnd": "Y",
    //                 "logicOr": "O",
    //                 "rightTitle": "Criterios de sangría",
    //                 "title": {
    //                     "0": "Constructor de búsqueda",
    //                     "_": "Constructor de búsqueda (%d)"
    //                 },
    //                 "value": "Valor"
    //             },
    //             "searchPanes": {
    //                 "clearMessage": "Borrar todo",
    //                 "collapse": {
    //                     "0": "Paneles de búsqueda",
    //                     "_": "Paneles de búsqueda (%d)"
    //                 },
    //                 "count": "{total}",
    //                 "countFiltered": "{shown} ({total})",
    //                 "emptyPanes": "Sin paneles de búsqueda",
    //                 "loadMessage": "Cargando paneles de búsqueda",
    //                 "title": "Filtros Activos - %d",
    //                 "showMessage": "Mostrar Todo",
    //                 "collapseMessage": "Colapsar Todo"
    //             },
    //             "select": {
    //                 "cells": {
    //                     "1": "1 celda seleccionada",
    //                     "_": "%d celdas seleccionadas"
    //                 },
    //                 "columns": {
    //                     "1": "1 columna seleccionada",
    //                     "_": "%d columnas seleccionadas"
    //                 },
    //                 "rows": {
    //                     "1": "1 fila seleccionada",
    //                     "_": "%d filas seleccionadas"
    //                 }
    //             },
    //             "thousands": ".",
    //             "datetime": {
    //                 "previous": "Anterior",
    //                 "next": "Proximo",
    //                 "hours": "Horas",
    //                 "minutes": "Minutos",
    //                 "seconds": "Segundos",
    //                 "unknown": "-",
    //                 "amPm": [
    //                     "AM",
    //                     "PM"
    //                 ],
    //                 "months": {
    //                     "0": "Enero",
    //                     "1": "Febrero",
    //                     "10": "Noviembre",
    //                     "11": "Diciembre",
    //                     "2": "Marzo",
    //                     "3": "Abril",
    //                     "4": "Mayo",
    //                     "5": "Junio",
    //                     "6": "Julio",
    //                     "7": "Agosto",
    //                     "8": "Septiembre",
    //                     "9": "Octubre"
    //                 },
    //                 "weekdays": [
    //                     "Dom",
    //                     "Lun",
    //                     "Mar",
    //                     "Mie",
    //                     "Jue",
    //                     "Vie",
    //                     "Sab"
    //                 ]
    //             },
    //             "editor": {
    //                 "close": "Cerrar",
    //                 "create": {
    //                     "button": "Nuevo",
    //                     "title": "Crear Nuevo Registro",
    //                     "submit": "Crear"
    //                 },
    //                 "edit": {
    //                     "button": "Editar",
    //                     "title": "Editar Registro",
    //                     "submit": "Actualizar"
    //                 },
    //                 "remove": {
    //                     "button": "Eliminar",
    //                     "title": "Eliminar Registro",
    //                     "submit": "Eliminar",
    //                     "confirm": {
    //                         "_": "¿Está seguro que desea eliminar %d filas?",
    //                         "1": "¿Está seguro que desea eliminar 1 fila?"
    //                     }
    //                 },
    //                 "error": {
    //                     "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
    //                 },
    //                 "multi": {
    //                     "title": "Múltiples Valores",
    //                     "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
    //                     "restore": "Deshacer Cambios",
    //                     "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
    //                 }
    //             },
    //             "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    //             "stateRestore": {
    //                 "creationModal": {
    //                     "button": "Crear",
    //                     "name": "Nombre:",
    //                     "order": "Clasificación",
    //                     "paging": "Paginación",
    //                     "search": "Busqueda",
    //                     "select": "Seleccionar",
    //                     "columns": {
    //                         "search": "Búsqueda de Columna",
    //                         "visible": "Visibilidad de Columna"
    //                     },
    //                     "title": "Crear Nuevo Estado",
    //                     "toggleLabel": "Incluir:"
    //                 },
    //                 "emptyError": "El nombre no puede estar vacio",
    //                 "removeConfirm": "¿Seguro que quiere eliminar este %s?",
    //                 "removeError": "Error al eliminar el registro",
    //                 "removeJoiner": "y",
    //                 "removeSubmit": "Eliminar",
    //                 "renameButton": "Cambiar Nombre",
    //                 "renameLabel": "Nuevo nombre para %s",
    //                 "duplicateError": "Ya existe un Estado con este nombre.",
    //                 "emptyStates": "No hay Estados guardados",
    //                 "removeTitle": "Remover Estado",
    //                 "renameTitle": "Cambiar Nombre Estado"
    //             }
    //         }
    //     };

    //     $(document).ready(function() {
    //         $('#ingresos').DataTable(dataTableOptions);
    //     });
    //     $(document).on('click', '#btnmodal', function() {
    //         const tablaModal = $('#detalles-ingreso > tbody');
    //         let detalles = $(this).data('datos');
    //         tablaModal.empty();
    //         for (let index = 0; index < detalles.length; index++) {
    //             let dprodu = $(this).data('produ' + index);
    //             console.log(dprodu['nombre']);
    //             let fila = `<tr class="selected">
    //                     <td>${dprodu['nombre']}</td>
    //                     <td>${detalles[index]['cantidad']}</td>
    //                     <td>${detalles[index]['costo']}</td>
    //                 </tr>`;

    //             tablaModal.append(fila);
    //         }
    //     });
    // </script>
@stop
