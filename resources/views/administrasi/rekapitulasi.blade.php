@extends('template/template',['active' => $active ?? '7','title' => $title])




@section('content')

<div class="card p-2">
    <div class="card-header card-header-text card-header-secondary">
        <div class="card-text">
            <h4 class="card-title">Rekapitulasi</h4>
        </div>
        <a href="cetak_pengeluaran" target="_blank" class="btn btn-info float-right pl-2 mr-1 print_excel"><i class="material-icons">print</i>Cetak</a>
    </div>
    <div class="card-body">
        <table class="table" id="datatable_pengeluaran" style="width: 100%;">
            <thead>
                <tr>
                    <th class="text-center font-weight-bold">#</th>
                    <th class="font-weight-bold">Tanggal</th>
                    <th class="font-weight-bold">Uraian</th>
                    <th class="font-weight-bold">Total</th>
                    <th class="font-weight-bold">Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


    </div>
</div>


@endsection

@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        var id = 0;
        read_data();

        function read_data() {
            $('#datatable_pengeluaran').DataTable({
                processing: true,
                serverSide: true,

                "scrollX": true,
                ajax: {
                    url: '{{ url('
                    json_rekapitulasi ') }}',
                },
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language": {

                    "zeroRecords": "Data masih kosong",

                },
                responsive: true,
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'uraianfix',
                        name: 'uraianfix'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        className: "text-right numeric"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },

                ],
                columnDefs: [{
                    "targets": [1, 2, 3],
                    "orderable": false
                }],
                "drawCallback": function() {

                    $('.numeric').attr('data-a-dec', ',');
                    $('.numeric').attr('data-a-sep', '.');
                    $('.linumeric').attr('data-a-dec', ',');
                    $('.linumeric').attr('data-a-sep', '.');
                    $('.numeric').autoNumeric('init');
                    $('.linumeric').autoNumeric('init');
                },
            });

        }

        $(document).on('click', '.hapus', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            Swal.fire({
                title: 'Apakah anda yakin ingn menghapus data ini ?',
                text: "Pastikan yang anda pilih benar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus ini!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            url: '/hapus_pengeluaran/' + id,
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                _token: '{{csrf_token()}}'
                            },
                        })
                        .done(function() {
                            Swal.fire(
                                'Selamat !!',
                                'Data berhasil terhapus',
                                'success'
                            );
                            $('#datatable_pengeluaran').DataTable().destroy();
                            read_data();
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        });
                }
            })


        });
    });
    // AKKORDION
(function() {
    var d = document,
      accordionToggles = $(document).find('.js-accordionTrigger'),
      setAria,
      setAccordionAria,
      switchAccordion,
      touchSupported = ('ontouchstart' in window),
      pointerSupported = ('pointerdown' in window);
    console.log(accordionToggles.prevObject[0]);
    console.log(accordionToggles.length);
    skipClickDelay = function(e) {
      e.preventDefault();
      e.target.click();
    }

    setAriaAttr = function(el, ariaType, newProperty) {
      el.setAttribute(ariaType, newProperty);
    };
    setAccordionAria = function(el1, el2, expanded) {
      switch (expanded) {
        case "true":
          setAriaAttr(el1, 'aria-expanded', 'true');
          setAriaAttr(el2, 'aria-hidden', 'false');
          break;
        case "false":
          setAriaAttr(el1, 'aria-expanded', 'false');
          setAriaAttr(el2, 'aria-hidden', 'true');
          break;
        default:
          break;
      }
    };
    //function
    switchAccordion = $(document).on("click", ".accordionTitle ", function(e) {
      console.log("triggered");
      e.preventDefault();
      var thisAnswer = e.target.parentNode.nextElementSibling;
      var thisQuestion = e.target;
      if (thisAnswer.classList.contains('is-collapsed')) {
        setAccordionAria(thisQuestion, thisAnswer, 'true');
      } else {
        setAccordionAria(thisQuestion, thisAnswer, 'false');
      }
      thisQuestion.classList.toggle('is-collapsed');
      thisQuestion.classList.toggle('is-expanded');
      thisAnswer.classList.toggle('is-collapsed');
      thisAnswer.classList.toggle('is-expanded');

      thisAnswer.classList.toggle('animateIn');
    });
    for (var i = 0, len = accordionToggles.prevObject.length; i < len; i++) {
      if (touchSupported) {
        accordionToggles.prevObject[i].addEventListener('touchstart', skipClickDelay, false);
      }
      if (pointerSupported) {
        accordionToggles.prevObject[i].addEventListener('pointerdown', skipClickDelay, false);
      }
      accordionToggles.prevObject[i].addEventListener('click', switchAccordion, false);
    }
  })();
</script>


@endpush