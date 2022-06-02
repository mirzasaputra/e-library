if(typeof table == 'undefined'){
    let table
}

table = initTable('#dataTable',
[
    {
        name: 'id',
        data: null,
        width: '1%',
        mRender: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    {
        name: 'name',
        data: 'name',
    },
    {
        name: 'id',
        data: 'hashid',
        sClass: 'nowrap',
        width: 150,
        sortable: false,
        mRender: function (data, type, row) {
            var render = ``

            if (userPermissions.includes('update-genres')) {
                render += `<button class="btn btn-outline-primary btn-sm" onclick="editTable('${data}')"><i class="feather icon-edit"></i></button> `
            }

            if (userPermissions.includes('delete-genres')) {
                render += `<button class="btn btn-outline-danger btn-sm" data-toggle="delete" data-id="${data}"><i class="feather icon-trash-2"></i></button> `
            }

            return render
        }
    }
])

async function editTable(id)
{
    swal.fire({
        title: 'Loading',
        html: 'Sedang mengambil data',
        allowOutsideClick: false,
        didOpen: () => {
            swal.showLoading()
        }
    })

    const res = await fetch(`${window.location.href}/${id}/edit`)

    swal.close()
    if(res.status == 200){
        var data = await res.json()
        $('#myModal').find('form').trigger('reset')
        $('#myModal').find('input[name="name"]').val(data.name)
        $('#myModal').find('.modal-title').html('Edit Genre')
        $('#myModal').find('form').attr('action', `${window.location.href}/${id}/update`)
        $('#myModal').modal('show')
    } else {
        notify('warning', 'Opps! Terjadi kesalahan')
    }
}
$('#create-genres').unbind().on('click', function(e){
    e.preventDefault();
    $('#myModal').find('.modal-title').html('Tambah Genre')
    $('#myModal').find('form').trigger('reset')
    $('#myModal').find('form').attr('action', `${window.location.href}/store`)
    $('#myModal').modal('show')
})