@extends('template/template',['active' => $active ?? '2','title' => $title])




@section('content')
<div class="card p-2">
	<div class="card-header card-header-text card-header-success">
		<div class="card-text">
			<h4 class="card-title">Tanggungan Ijazah</h4>
		</div>
		<a href="cetak_tanggungan_ijazah" target="_blank" class="btn btn-info float-right pl-2 mr-1 print_excel"><i class="material-icons">print</i>Cetak</a>
	</div>
	<div class="card-body">
		<table class="table" id="datatable_ijazah" style="width:100%;">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Tahun Ajaran</th>
					<th>Tanggungan Ijazah</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="editIjazah" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Ijazah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-edit-ijazah">
				@csrf
				<div class="modal-body">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="material-icons">portrait</i>
							</span>
						</div>
						<input type="text" name="nama" class="form-control" disabled="">
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="material-icons">payments</i>
							</span>
						</div>
						<input type="text" name="nominal_ijazah" class="form-control text-right" data-a-dec="," data-a-sep=".">
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary simpan">Simpan dan Ganti</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>






@endsection

@push('javascript')
<script type="text/javascript">
	var id = 0;
	var handleClik = true;
	read_data();
	$('#form-edit-ijazah input[name="nominal_ijazah"]').autoNumeric('init', {
		aPad: false
	});

	function read_data() {
		$('#datatable_ijazah').DataTable({
			processing: true,
			serverSide: true,

			"scrollX": true,
			ajax: {
				url: '{{ url('
				jsonijazah ') }}',
			},
			rowReorder: {
				selector: 'td:nth-child(2)'
			},

			responsive: true,
			columns: [{
					"data": 'DT_RowIndex',
					orderable: false,
					searchable: false
				},

				{
					data: 'nama',
					name: 'nama'
				},
				{
					data: 'tahun_ajaran',
					name: 'tahun_ajaran'
				},
				{
					data: 'ijazah',
					name: 'ijazah',
					className: "text-left dt-thead-left numeric"
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false
				},

			],
			"columnDefs": [


				{
					"targets": [3],
					"width": "200px"
				},
				{
					"targets": [-1],
					"className": "text-center"
				},
				{
					"targets": [1],
					"width": "250px",
					"className": "text-left"
				}
			],
			"drawCallback": function() {

				$('.numeric').attr('data-a-dec', ',');
				$('.numeric').attr('data-a-sep', '.');
				$('.numeric').autoNumeric('init');
			},
		});

	}
	$(document).ready(function() {

	});
	$(document).on('click', '.add-ijazah-5000', function(event) {

		var id_a = $(this).attr('id');
		console.log("Ulang");
		$.ajax({
				url: '/add_ijazah_5000/' + id_a,
				type: 'POST',
				dataType: 'JSON',
				data: {
					_token: '{{ csrf_token() }}'
				},
			})
			.done(function(data) {
				if (data.statusCode == 202) {
					$("#datatable_ijazah").DataTable().destroy();
					read_data();

				}

			});







	});
	$(document).on('click', '.edit', function(event) {
		id = $(this).attr('id');
		$.ajax({
				url: '/pick_ijazah/' + id,
				type: 'POST',
				dataType: 'JSON',
				data: {
					_token: '{{ csrf_token() }}'
				},
			})
			.done(function(data) {
				if (data.length != 0) {
					$('#form-edit-ijazah input[name="nama"]').val(data.nama);
					$('#form-edit-ijazah input[name="nominal_ijazah"]').autoNumeric('set', data.ijazah);

					$('#editIjazah').modal('show');
				}
			})
	});
	$('.simpan').click(function(event) {
		var data = $('#form-edit-ijazah').serialize();
		$.ajax({
				url: '/simpan_edit_ijazah/' + id,
				type: 'POST',
				dataType: 'JSON',
				data: data,
			})
			.done(function(data) {
				if (data == 1) {
					$('#editIjazah').modal('hide');
					$("#datatable_ijazah").DataTable().destroy();
					read_data();

				}
			})


	});
</script>

@endpush