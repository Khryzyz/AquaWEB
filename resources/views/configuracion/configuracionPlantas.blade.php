@extends('layouts.Dashboard.Main')

@section('content')

    <?php
    $Utils = new Utils();
    ?>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Plantas registrados en el sistema</h3>
        </div>
        <div class="panel-body">
            <div class="panel-group">
                <a href="../procesos/modalAgregarProcesos" class="btn btn-primary" data-modal="modal-lg">
                    <i class="fa fa-plus"></i>
                    Agregar Planta</a>
            </div>
            <div class="panel-group">
                <?php

                //Inicializamos el Data Source de Transporte de lectura
                $readPlantas = new \Kendo\Data\DataSourceTransportRead();

                //Agregamos atributos al datasource de transporte de lectura
                $readPlantas
                    ->url('../../configuracion/getPlantas')
                    ->contentType('application/json')
                    ->type('POST');

                //Inicializamos el Data Source de Transporte
                $transportPlantas = new \Kendo\Data\DataSourceTransport();

                //Agregamos atributos al datasource de transporte
                $transportPlantas
                    ->read($readPlantas)
                    ->parameterMap('function(data) {
			return kendo.stringify(data);
		}');

                //Inicializamos el esquema de la grid
                $schemaPlantas = new \Kendo\Data\DataSourceSchema();

                //Agregamos los aributos del esquema de l grid
                $schemaPlantas
                    ->data('data')
                    ->total('total');

                $gridGroupItemPlantas = new Kendo\Data\DataSourceGroupItem();
                $gridGroupItemPlantas->field('usuario');

                //Inicializamos el Data Source
                $dataSourcePlantas = new \Kendo\Data\DataSource();

                //Agregamos atributos al datasource
                $dataSourcePlantas
                    ->addGroupItem($gridGroupItemPlantas)
                    ->transport($transportPlantas)
                    ->pageSize(20)
                    ->schema($schemaPlantas)
                    ->serverFiltering(true)
                    ->serverSorting(true)
                    ->serverPaging(true);

                //Inicializamos la grid
                $gridPlantas = new \Kendo\UI\Grid('Grid');

                //Inicializamos las columnas de la grid
                $idplanta = new \Kendo\UI\GridColumn();
                $idplanta->field('idplanta')->title('Id')->hidden(true);

                $usuario = new \Kendo\UI\GridColumn();
                $usuario->field('usuario')->title('Usuario')->hidden(true);

                $nombre = new \Kendo\UI\GridColumn();
                $nombre->field('nombre')->title('Nombre')->width(100);

                $registro = new \Kendo\UI\GridColumn();
                $registro->field('registro')->title('Fecha Registro')->width(80);

                $actualizacion = new \Kendo\UI\GridColumn();
                $actualizacion->field('actualizacion')->title('Fecha Actualización')->width(80);

                $estado = new \Kendo\UI\GridColumn();
                $estado->field('estado')->title('Estado')->width(50);

                $verusuario = new \Kendo\UI\GridColumn();
                $verusuario->field('verusuario')->title('Ver')->templateId('verusuario')->width(70);

                $editarusuario = new \Kendo\UI\GridColumn();
                $editarusuario->field('editarusuario')->title('Editar')->templateId('editarusuario')->width(70);

                $gridFilterable = new \Kendo\UI\GridFilterable();
                $gridFilterable->mode("row");

                //Se agregan columnas y atributos al grid
                $gridPlantas
                    ->addColumn($idplanta,
                        $usuario,
                        $nombre,
                        $registro,
                        $actualizacion,
                        $estado,
                        $verusuario,
                        $editarusuario)
                    ->dataSource($dataSourcePlantas)
                    ->filterable($gridFilterable)
                    ->sortable(true)
                    ->dataBound('handleAjaxModal')
                    ->pageable(true);

                //renderizamos la grid
                echo $gridPlantas->render();
                ?>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script id='verusuario' type='text/x-kendo-tmpl'>
        <a href="../../procesos/getModalInfoPlantaById/#=idplanta#"
         class="btn btn-primary"
         data-modal="modal-lg">
        <i class="fa fa-eye"></i> Ver</a>
    </script>
    <script id='editarusuario' type='text/x-kendo-tmpl'>
        <a href='procesos/getViewInfoCaracteristicasProcesoById/#=idplanta#' class='btn btn-primary text-center'>
        <i class="fa fa-wrench"></i> Editar</a>
    </script>
@endsection