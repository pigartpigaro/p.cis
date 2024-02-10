// open form
const form = document.getElementById('form')
if (form) {
  form.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
  })
}

// const formedit= document.getElementById('formedit')
// if (formedit) {
//   formedit.addEventListener('show.bs.modal', event => {
//     // Button that triggered the modal
//     const button = event.relatedTarget
//     // Extract info from data-bs-* attributes
//     const recipient = button.getAttribute('data-bs-whatever')
//     // If necessary, you could initiate an Ajax request here
//     // and then do the updating in a callback.

//     // Update the modal's content.
//     const modalTitle = exampleModal.querySelector('.modal-title')
//     const modalBodyInput = exampleModal.querySelector('.modal-body input')

//     modalTitle.textContent = `New message to ${recipient}`
//     modalBodyInput.value = recipient
//   })
// }


// $(document).on('click','.btn',function(){
//   var id = $(this).val();
 
//   // Populate Data in Edit Modal Form
//   $.ajax({
//       type: "GET",
//       url: url + '/' + id,
//       success: function (data) {
//           console.log(data);
//           $('#id').val(data.id);
//           $('#nama').val(data.nama);
//           $('#alamat').val(data.alamat);
//           $('#nohp').val(data.nohp);
//           $('#btn-save').val("update");
//           $('#formedit').modal('show');
//       },
//       error: function (data) {
//           console.log('Error:', data);
//       }
//   });
// });


//new//

// $(document).ready(function(){
//   $('#btn-save').click(function(e){
//       e.preventDefault();
//       $.ajaxSetup({
//           headers: {
//               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//           }
//       });
//       $.ajax({
//           url: "{{ url('/pelanggan') }}",
//           method: 'post',
//           data: {
//               nama: $('#nama').val(),
//               alamat: $('#alamat').val(),
//               nohp: $('#nohp').val(),
//           },
//           success: function(result){
//               if(result.errors)
//               {
//                   $('.alert-danger').html('');

//                   $.each(result.errors, function(key, value){
//                       $('.alert-danger').show();
//                       $('.alert-danger').append('<li>'+value+'</li>');
//                   });
//               }
//               else
//               {
//                   $('.alert-danger').hide();
//                   $('#xmodalLabel').modal('hide');
//               }
//           }
//       });
//   });
// });