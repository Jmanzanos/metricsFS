<x-layout>

    <div class="bg-primary text-white text-center">
        <p class="display-4">Monitoreo Remoto</p>
    </div>
    <div class="row px-2 rows-col-12">
        <div class="col-8 vh-10 mx-auto">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-12 text-center pt-3">
            <a type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#filesModal"
                data-recipient="Imagen en el Servidor" data-type="image"><i class="bi bi-image"></i> Imagen</a>
            <a type="button" class="btn btn-primary btn-lg" href="https://firebasestorage.googleapis.com/v0/b/capstone7monitor.appspot.com/o/recording.wav?alt=media&token=00e30832-0c11-42f8-ace8-78a77e4cf3d2" target="_blank"
                data-recipient="Audio en el Servidor" data-type="audio"><i class="bi bi-music-note-beamed"></i>
                Audio</a>
            <a id="button_1" type="button" class="btn btn-primary btn-lg"><i class="bi bi-arrow-down-circle"></i>OTA</a>
        </div>
        <x-index-card Title="Frecuencia Cardiaca" :Value="$data->overallData->frecuencia_cardiaca"
            :Time="$data->overallData->frecuencia_cardiaca_timestamp" :Type="0" />
        <x-index-card Title="Temperatura" :Value="$data->overallData->temperatura"
            :Time="$data->overallData->temperatura_timestamp" :Type="1" />
        <x-index-card Title="Frecuencia Respiratoria" :Value="$data->overallData->frecuencia_respiratoria"
            :Time="$data->overallData->frecuencia_respiratoria_timestamp" :Type="2" />
        <x-index-card Title="Saturacion" :Value="$data->overallData->saturacion"
            :Time="$data->overallData->saturacion_timestamp" :Type="3" />
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
    <div class="modal fade" id="filesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="exampleModalLabel">Modal title</h5>
                </div>
                <div class="modal-body container text-center" id="fileBody">
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
            $("#button_1").click(function(e) {
            e.preventDefault();
            $.ajax({
            type: "POST",
            url: "http://monitoreoremoto.ddns.net/api/otacall",
            data: {4
            },
            success: function(result) {
                alert('ok');
            },
            error: function(result) {
                alert('error');
            }
            });
        });
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

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('recipient')
            var type = button.data('type')
            var modal = $(this)
            modal.find('.modal-title').text(recipient)
            $('#modalBody').empty().html("<div class='row px-2 justify-content-center'><div class='col-auto'><div class='spinner-border text-primary' role='status'><span class='sr-only'></span></div></div></div>")
            $.get('/modal/' + type, function(data){
                $('#modalBody').empty().html(data)
            })
        })

        $('#filesModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('recipient')
            var type = button.data('type')
            var modal = $(this)
            modal.find('.modal-title').text(recipient)
            $('#fileBody').empty().html("<div class='row px-2 justify-content-center'><div class='col-auto'><div class='spinner-border text-primary' role='status'><span class='sr-only'></span></div></div></div>")
            if(type == "image"){
                $('#fileBody').empty().html("<img src='{{asset('/storage/uploaded_image.jpg')}}'/>")
            }
            else{
                $('#fileBody').empty().html("<audio controls><source src='{{asset('/storage/uploaded_audio.wav')}}'></audio>")                
            }
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

            if(frecuencia_cardiaca >= 110){
                $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-danger'>Alto</span>")
            }else{
                if(frecuencia_cardiaca >= 50){
                    $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }else{
                    $("#badge_type_0").empty().html("<span class='badge rounded-pill bg-danger'>Bajo</span>")
                }
            }
            if(temperatura >= 38){
                $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-danger'>Alto</span>")
            }else{
                if(temperatura >= 36){
                    $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }else{
                    $("#badge_type_1").empty().html("<span class='badge rounded-pill bg-danger'>Bajo</span>")
                }
            }
            if(frecuencia_respiratoria >= 24){
                $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-danger'>Alto</span>")
            }else{
                if(frecuencia_respiratoria >= 9){
                    $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }else{
                    $("#badge_type_2").empty().html("<span class='badge rounded-pill bg-danger'>Bajo</span>")
                }
            }
            if(saturacion >= 101){
                $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-danger'>Alto</span>")
            }else{
                if(saturacion >= 96){
                    $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-success'>Estable</span>")
                }else{
                    $("#badge_type_3").empty().html("<span class='badge rounded-pill bg-danger'>Bajo</span>")
                }
            }

            var timestamp = "Ultima Actualizacion: "
            $("#time_type_0").empty().html(timestamp + array["overallData"]["frecuencia_cardiaca_timestamp"])
            $("#time_type_1").empty().html(timestamp + array["overallData"]["temperatura_timestamp"])
            $("#time_type_2").empty().html(timestamp + array["overallData"]["frecuencia_respiratoria_timestamp"])
            $("#time_type_3").empty().html(timestamp + array["overallData"]["saturacion_timestamp"])

            myChart.data.datasets[0].data = array["ecg"];
            myChart.data.labels = array["created_at"];
            myChart.update()
        })
        },200);
        })

    </script>

</x-layout>