<script>
  function delete_data(id){
    swal.fire({
      // title:'Are you sure?',
      // dangerMode: true,
      // // timer: 3000,
      // buttons: {  cancel: { text: "Cancel",visible:true, value: null, className: "bg-light"},
      //             confirm: { text: "Delete", value: true, className: "bg-warning"},
      //           },
      // icon: "warning",
      // text: 'Data will be deleted permanently!',
      // className: "btn-danger",
      // closeModal: true
      title: "Are you sure?",
      text: "Data will be deleted permanently!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete"
    })
    .then((result) => {
      if (result.isConfirmed) {
      //if (willDelete) {
        $("#delete_form-"+id ).submit();
      }
    });
  }
  function change_status(ele, id){
    let status = '0';
    if($(ele).prop("checked")){
      status = '1';
    }
    let url = $(ele).data("route")+'/'+id;
    Swal.fire({
      title: "Are you sure?",
      text: "Status will be changed!",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Change it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: url,
          data: {_token: "{{csrf_token()}}", _method:'PUT', status: status},
        })
        .done(function (res) {
          if(res.success){
            Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
          });
          }else{
            if(status == '1') $(ele).prop("checked", false);
            else $(ele).prop("checked", true);
          }
        })
        .fail(function (err) {
          console.log(err);
        });
      }else{
        if(status == '1') $(ele).prop("checked", false);
        else $(ele).prop("checked", true);
      }
    });
  }
</script>
