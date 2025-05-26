<script src="{{ asset('plugins/datatables/jquery.validate.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
{!! $dataTable->scripts() !!}

<script>
  function renderButtons(tableId) {
    var dtable = $("#" + tableId).DataTable();
    // $('#'+tableId+'_wrapper').addClass('row d-flex justify-content-between');
    // $('.dt-buttons').width('100%');
  }
</script>
