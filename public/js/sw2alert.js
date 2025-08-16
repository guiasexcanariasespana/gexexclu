$('.show-alert').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal.fire({
        title: "Seguro elimina este registro?",
        text: "Si usted lo elimina no podrá recuperarse.",
        icon: "warning",
        showCancelButton: true,
        buttons: ["Cancel", "Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminemos esto!'
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            form.submit();
        }
    });
});