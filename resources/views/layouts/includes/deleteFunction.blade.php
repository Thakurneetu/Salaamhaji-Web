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
</script>