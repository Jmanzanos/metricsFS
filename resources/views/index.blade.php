<x-layout>

    <div class="bg-primary text-white text-center">
        <p class="display-4">Monitoreo Remoto</p>
    </div>
    <div class="row px-2 rows-col-12">
        <div class="col-8 vh-10 mx-auto">
            <canvas id="myChart"></canvas>
        </div>
        <x-index-card Title="Frecuencia Cardiaca" :Value="$data->overallData->frecuencia_cardiaca"
            :Time="$data->overallData->created_at" :Type="0" />
        <x-index-card Title="Temperatura" :Value="$data->overallData->temperatura"
            :Time="$data->overallData->created_at" :Type="1" />
        <x-index-card Title="Frecuencia Respiratoria" :Value="$data->overallData->frecuencia_respiratoria"
            :Time="$data->overallData->created_at" :Type="2" />
        <x-index-card Title="Saturacion" :Value="$data->overallData->saturacion" :Time="$data->overallData->created_at"
            :Type="3" />
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body container" id="modalBody">
                    <div class="row px-2 justify-content-center">
                        <div class="col-auto">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <form id="ajaxform">
        @csrf
    </form>

    <script type="text/javascript">
        $(document).ready(function(){

        var text = "{{$data->created_at}}"
        const labels = JSON.parse(text.replace(/&quot;/g, '"'))
        const daita = {{$data->ecg}}
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'Electrocardiograma',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: daita,
          }]
        }
      
        const config = {
          type: 'line',
          data: data,
          options: {}
        }

        const myChart = new Chart(document.getElementById('myChart'), config)

        function showData(type){
            $('#modalBody').empty().html("<div class='row px-2 justify-content-center'><div class='col-auto'><div class='spinner-border text-primary' role='status'><span class='sr-only'></span></div></div></div>")
            $.get('/modal/' + type, function(data){
                $('#modalBody').empty().html(data)
            })
        }

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('recipient')
            var type = button.data('type')
            var modal = $(this)
            var content = showData(type)
            modal.find('.modal-title').text(recipient)
        })

        setInterval(function(){
            $.ajax({
            url: '/update',
            method: 'POST',
            data: $("#ajaxform").serialize()
        }).done(function(response){

            var array = JSON.parse(response)
            var frecuencia_cardiaca = array["overallData"]["frecuencia_cardiaca"]
            var temperatura = array["overallData"]["temperatura"]
            var frecuencia_respiratoria = array["overallData"]["frecuencia_respiratoria"]
            var saturacion = array["overallData"]["saturacion"]
            var json_ecg = JSON.stringify(array["ecg"])
            var json_created_at = JSON.stringify(array["created_at"])

            $("#value_type_0").empty().html(frecuencia_cardiaca)
            $("#value_type_1").empty().html(temperatura)
            $("#value_type_2").empty().html(frecuencia_respiratoria)
            $("#value_type_3").empty().html(saturacion)

            if(frecuencia_cardiaca >= 100){
                $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-danger'>Peligro</span>")
            }else{
                if(frecuencia_cardiaca >= 80){
                    $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-warning'>Advertencia</span>")
                }else{
                    $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }
            }
            if(temperatura >= 100){
                $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-danger'>Peligro</span>")
            }else{
                if(temperatura >= 80){
                    $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-warning'>Advertencia</span>")
                }else{
                    $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }
            }
            if(frecuencia_respiratoria >= 100){
                $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-danger'>Peligro</span>")
            }else{
                if(frecuencia_respiratoria >= 80){
                    $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-warning'>Advertencia</span>")
                }else{
                    $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }
            }
            if(saturacion >= 100){
                $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-danger'>Peligro</span>")
            }else{
                if(saturacion >= 80){
                    $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-warning'>Advertencia</span>")
                }else{
                    $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }
            }

            var timestamp = "Ultima Actualizacion: " + array["overallData"]["created_at"]
            $("#time_type_0").empty().html(timestamp)
            $("#time_type_1").empty().html(timestamp)
            $("#time_type_2").empty().html(timestamp)
            $("#time_type_3").empty().html(timestamp)

            myChart.data.datasets[0].data = array["ecg"];
            myChart.data.labels = array["created_at"];
            myChart.update()
        })
        },500);
        })

    </script>

</x-layout>