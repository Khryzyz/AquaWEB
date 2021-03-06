<div id="ModalAgregarPez">
    {!!Form::open(['url' => route('modalAgregarPez'), 'method' => 'POST', 'role'=>"form"])!!}
    <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><i class="fa fa-tint"></i> Agregar Pez</h4>
    </div>
    <div class="modal-body">

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('nombre', 'Nombre:')!!}
            </div>
            <div class="col-md-9">
                {!!Form::text('nombre',null,['class'=>'form-control', 'required', 'placeholder'=>'Nombre'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('tempvitmin', 'Temp. Vital Min (°C):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('tempvitmin',null,['class'=>'form-control', 'required','min'=>'0','max'=>'99', 'minlength'=>'1','maxlength'=>'2', 'placeholder'=>'Temp. Vital Min'])!!}
            </div>
            <div class="col-md-3">
                {!!Form::label('tempvitmax', 'Temp. Vital Max (°C):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('tempvitmax',null,['class'=>'form-control', 'required','min'=>'0','max'=>'99', 'minlength'=>'1','maxlength'=>'2', 'placeholder'=>'Temp. Vital Max'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('tempoptmin', 'Temp. Optima Min (°C):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('tempoptmin',null,['class'=>'form-control', 'required','min'=>'0','max'=>'99', 'minlength'=>'1','maxlength'=>'2', 'placeholder'=>'Temp. Optima Min'])!!}
            </div>
            <div class="col-md-3">
                {!!Form::label('tempoptmax', 'Temp. Optima Max (°C):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('tempoptmax',null,['class'=>'form-control', 'required','min'=>'0','max'=>'99', 'minlength'=>'1','maxlength'=>'2', 'placeholder'=>'Temp. Optima Max'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('porcpromin', 'Porc. proteinico Min (%):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('porcpromin',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Porc. proteinico Min'])!!}
            </div>
            <div class="col-md-3">
                {!!Form::label('porcpromax', 'Porc. proteinico Max (%):')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('porcpromax',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Porc. proteinico Max'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('nitnat', 'Nitrogeno:')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('nitnat',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Nitrogeno'])!!}
            </div>
            <div class="col-md-3">
                {!!Form::label('nitri', 'Nitrito:')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('nitri',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Nitrito'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('oxi', 'Oxigeno:')!!}
            </div>
            <div class="col-md-3">
                {!!Form::number('oxi',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Oxigeno'])!!}
            </div>
        </div>

        <div class="row margin-bottom-10">

            <div class="col-md-3">
                {!!Form::label('crepeso', 'Crecimiento Peso (grs):')!!}
            </div>

            <div class="col-md-3">
                {!!Form::number('crepeso',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Crecimiento Peso'])!!}
            </div>

            <div class="col-md-3">
                {!!Form::label('cretiempo', 'Crecimiento Tiempo (dia):')!!}
            </div>

            <div class="col-md-3">
                {!!Form::number('cretiempo',null,['class'=>'form-control', 'required','min'=>'1','max'=>'100', 'maxlength'=>'3', 'placeholder'=>'Crecimiento Tiempo'])!!}
            </div>

        </div>

        <div class="row margin-bottom-10">
            <div class="col-md-3">
                {!!Form::label('tiposAcceso', 'Tipo Acceso:')!!}
            </div>
            <div class="col-md-9">
                <?php
                $readDropDown = new \Kendo\Data\DataSourceTransportRead();

                $readDropDown
                    ->url(route('getTiposAcceso'))
                    ->contentType('application/json')
                    ->type('POST');
                $transportDropDown = new \Kendo\Data\DataSourceTransport();

                $transportDropDown->read($readDropDown)
                    ->parameterMap('function(data) {
              return kendo.stringify(data);
           }');

                $dataSourceDropDown = new \Kendo\Data\DataSource();

                $dataSourceDropDown->transport($transportDropDown);

                $dropDownList = new \Kendo\UI\DropDownList('tiposAcceso');

                $dropDownList->dataSource($dataSourceDropDown)
                    ->dataTextField('nombre')
                    ->dataValueField('id')
                    ->optionLabel('Seleccione...')
                    ->attr('style', 'width: 100%')
                    ->attr('required', 'required');

                echo $dropDownList->render();

                ?>
            </div>
        </div>
        @include('layouts.Panels.Annotations.allFieldsRequired')

    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        <input type="submit" class="btn btn-primary" value="Guardar">

    </div>

    {!!Form::close()!!}

</div>

<script type="text/javascript">
    var modal = $('#ModalAgregarPez');

    $(function () {
        validarFormulario();// validar forularios con kendo
        eventResultForm(modal, onSuccess)
    });

    function validarFormulario() {
        var container = $('form');

        kendo.init(container);

        container.kendoValidator({
            //organiza los mensajes personalizados
            messages: {
                float_positive: "Este campo debe ser un decimal positivo",
                required: "Este campo es obligatorio"
            },
            //define reglas si necesita tener mas  de solo el campo requerido
            rules: {
                float_positive: function (input) {

                    var expreg = /^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/;

                    if (input.is("[class=float-positive]")) {
                        return expreg.test(input.val());
                    }
                    return true;
                }
            }
        });
    }

    function onSuccess(result) {

        result = JSON.parse(result)

        switch (result.estado) {
            case "success":
                $.msgbox(result.mensaje, {type: 'success'}, function () {
                    modalBs.modal('hide');
                    $('#GridPez').data('kendoGrid').dataSource.read();
                    $('#GridPez').data('kendoGrid').refresh();
                });
                break;
            case "error":
                $.msgbox(result.mensaje);
                break;
            case "fatal":
                $.msgbox(result.mensaje, {type: 'error'});
                break;
            default:
                $.msgbox("Error desconocido", {type: 'error'});
        }

    }
</script>