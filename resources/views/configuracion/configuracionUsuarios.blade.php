@extends('layouts.Dashboard.Main')

@section('content')

    <?php
    $Utils = new Utils();
    ?>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Usuarios registrados en el sistema</h3>
        </div>
        <div class="panel-body">
            <div class="panel-group">
                <a href="../procesos/modalAgregarProcesos" class="btn btn-primary" data-modal="modal-lg">
                    <i class="fa fa-plus"></i>
                    Agregar Usuario</a>
            </div>
            <div class="panel-group">
                <?php

                //Inicializamos el Data Source de Transporte de lectura
                $readUsuarios = new \Kendo\Data\DataSourceTransportRead();

                //Agregamos atributos al datasource de transporte de lectura
                $readUsuarios
                    ->url('../../configuracion/getUsuarios')
                    ->contentType('application/json')
                    ->type('POST');

                //Inicializamos el Data Source de Transporte
                $transportUsuarios = new \Kendo\Data\DataSourceTransport();

                //Agregamos atributos al datasource de transporte
                $transportUsuarios
                    ->read($readUsuarios)
                    ->parameterMap('function(data) {
			return kendo.stringify(data);
		}');

                //Inicializamos el esquema de la grid
                $schemaUsuarios = new \Kendo\Data\DataSourceSchema();

                //Agregamos los aributos del esquema de l grid
                $schemaUsuarios
                    ->data('data')
                    ->total('total');

                $gridGroupItemUsuarios = new Kendo\Data\DataSourceGroupItem();
                $gridGroupItemUsuarios->field('rol');

                //Inicializamos el Data Source
                $dataSourceUsuarios = new \Kendo\Data\DataSource();

                //Agregamos atributos al datasource
                $dataSourceUsuarios
                    ->addGroupItem($gridGroupItemUsuarios)
                    ->transport($transportUsuarios)
                    ->pageSize(10)
                    ->schema($schemaUsuarios)
                    ->serverFiltering(true)
                    ->serverSorting(true)
                    ->serverPaging(true);

                //Inicializamos la grid
                $gridUsuarios = new \Kendo\UI\Grid('Grid');

                //Inicializamos las columnas de la grid
                $idusuario = new \Kendo\UI\GridColumn();
                $idusuario->field('idusuario')->title('Id')->hidden(true);

                $usuario = new \Kendo\UI\GridColumn();
                $usuario->field('usuario')->title('Usuario')->width(80);

                $email = new \Kendo\UI\GridColumn();
                $email->field('email')->title('Email')->width(90);

                $primernombre = new \Kendo\UI\GridColumn();
                $primernombre->field('primernombre')->title('Primer Nombre')->width(50);

                $segundonombre = new \Kendo\UI\GridColumn();
                $segundonombre->field('segundonombre')->title('Segundo Nombre')->width(50);

                $primerapellido = new \Kendo\UI\GridColumn();
                $primerapellido->field('primerapellido')->title('Primer Apellido')->width(50);

                $segundoapellido = new \Kendo\UI\GridColumn();
                $segundoapellido->field('segundoapellido')->title('Segundo Apellido')->width(50);

                $estado = new \Kendo\UI\GridColumn();
                $estado->field('estado')->title('Estado')->width(50);

                $verusuario = new \Kendo\UI\GridColumn();
                $verusuario->field('verusuario')->title('Ver')->templateId('verusuario')->width(70);

                $editarusuario = new \Kendo\UI\GridColumn();
                $editarusuario->field('editarusuario')->title('Editar')->templateId('editarusuario')->width(70);

                //Se agregan columnas y atributos al grid
                $gridUsuarios
                    ->addColumn($idusuario,
                        $usuario,
                        $email,
                        $primernombre,
                        $segundonombre,
                        $primerapellido,
                        $segundoapellido,
                        $estado,
                        $verusuario,
                        $editarusuario)
                    ->dataSource($dataSourceUsuarios)
                    ->sortable(true)
                    ->dataBound('handleAjaxModal')
                    ->pageable(true);

                //renderizamos la grid
                echo $gridUsuarios->render();
                ?>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script id='verusuario' type='text/x-kendo-tmpl'>
        <a href='procesos/getViewInfoCaracteristicasProcesoById/#=idusuario#' class='btn btn-primary text-center'>
        <i class="fa fa-eye"></i> Ver</a>

    </script>
    <script id='editarusuario' type='text/x-kendo-tmpl'>
        <a href='procesos/getViewInfoCaracteristicasProcesoById/#=idusuario#' class='btn btn-primary text-center'>
        <i class="fa fa-wrench"></i> Editar</a>

    </script>
@endsection