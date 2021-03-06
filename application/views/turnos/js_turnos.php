
	<script type="text/javascript">

		function confirmDelete(id, msg, funcao) {
			bootbox.confirm({
    		message: msg,
    		buttons: {
        	confirm: {
            label: 'Sim',
            className: 'btn-success'
        	},
        	cancel: {
            label: 'Não',
            className: 'btn-danger'
        	}
    		},
    		callback: function (result) {
        	if (result == true)
						  window.location.href = '<?= site_url("Turno/") ?>' + funcao + '/' + id;
    		}
			});
		}

		$(document).ready(function () {

			$('#TurnoTable').dataTable( {
				"language": {
					"url": "<?= base_url('assets/DataTables/translatePortuguese.js');?>"
				}
			} );



			var mask = function () {
				$('.hora').mask('00:00');
			}
			var addHorario = function () {
				aula = $(".aula",$('#horarios')).length;
				index = $("input.hora").length;

				var content = `
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-1 form-group">
						<p class="aula"><strong>Aula `+ (aula + 1) +`</strong></p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2 form-group">
						<label >Horário de entrada:</label>
						<input name="horario[`+index+`]" class="form-control hora" type="text" value="">
					</div>`;

					index++;

					content += `
					<div class="col-xs-12 col-sm-12 col-md-2 form-group">
						<label >Horário de saída:</label>
						<input name="horario[`+index+`]" class="form-control hora" type="text" value="">
					</div>
					<div col-md-2 style="padding: 25px 0 0 0;">
						<button id="btnRemove" type="button" class="btn btn-danger add-field"><span class="glyphicon glyphicon-remove"></span></button>
					</div>
				</div>`;
				index++;
				aula++;
				$("#horarios").append(content);
				//carrega as máscaras novamente
				mask();
			}

			var url = window.location.href;
			var index = 0;
			var aula = 0;

			if ( url.indexOf('Turno/editar') > -1 ) {
				var horarios = <?= (isset($turno->horarios)) ? json_encode($turno->horarios) : '{}' ?>;

				horarios.forEach(function (horario) {
					// var aula = 0;
					var content = `
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-1 form-group">
							<p class="aula"><strong>Aula `+ (aula + 1) +`</strong></p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-2 form-group">
							<label >Horário de entrada:</label>
							<input name="horario[`+index+`]" class="form-control hora" type="text" value="`+horario.inicio.substring(0,5)+`">
						</div>`;

					index++;

					content += `
						<div class="col-xs-12 col-sm-12 col-md-2 form-group">
							<label >Horário de saída:</label>
							<input name="horario[`+index+`]" class="form-control hora" type="text" value="`+horario.fim.substring(0,5)+`">
						</div>
						<div col-md-2 style="padding: 25px 0 0 0;">
							<button id="btnRemove" type="button" class="btn btn-danger add-field"><span class="glyphicon glyphicon-remove"></span></button>
						</div>
					</div>`;
					index++;
					aula++;
					$("#horarios").append(content);
				});
			} else if (url.indexOf('Turno/atualizar') > -1) {
				var horarios = <?= json_encode(set_value('horario')) ?>;

				for (var i = 0; i < horarios.length; i = i + 2) {
					var content = `
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-1 form-group">
							<p class="aula"><strong>Aula `+ (aula + 1) +`</strong></p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-2 form-group">
							<label >Horário de entrada:</label>
							<input name="horario[`+i+`]" class="form-control hora" type="text" value="`+horarios[i]+`">
						</div>`;

					index++;

					content += `
						<div class="col-xs-12 col-sm-12 col-md-2 form-group">
							<label >Horário de saída:</label>
							<input name="horario[`+(i + 1)+`]" class="form-control hora" type="text" value="`+horarios[i + 1]+`">
						</div>
						<div col-md-2 style="padding: 25px 0 0 0;">
							<button id="btnRemove" type="button" class="btn btn-danger add-field"><span class="glyphicon glyphicon-remove"></span></button>
						</div>
					</div>`;
					aula++;
					$('#horarios').append(content);
				}

			}


			$('#horarios').on('click','#btnRemove',function(){
				var row = $(this).parent().parent();
				row.remove();
				// index vetor
				novos = $("input.hora");
				for (index = 0; index < novos.length; index++) {
					novos[index].name = 'horario['+index+']';
				}

				// index aula
				var listAula = $("p.aula");
				for (aula = 0; aula < listAula.length; aula ++) {
					listAula[aula].innerHTML = '<strong> Aula ' + (aula + 1)+'</strong>';
				}
			});

			// função para adicionar um novo campo de horario
			$('#btnAdd',$('#horarios')).click(addHorario);

			// função para adicionar um novo horario no cadastro de turno
			$('#btnAdd',$("#turnoCadastrar")).click(addHorario);

			mask();
		});

</script>
<script type="text/javascript">
	$.validator.addClassRules({
		hora: {
			required: true,
			maxlength: 5,
			minlength: 5
		}
	});

	$("#formTurnos").validate({
		errorClass: 'text-danger',
		errorElement: 'span',
		rules: {
			nome_turno: {
				required: true,
				maxlength: 25
			}
		}
	});
</script>
</body>
</html>
