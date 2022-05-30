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

            if (userPermissions.includes('update-roles')) {
                render += `<button class="btn btn-outline-primary btn-sm" onclick="editTable('${data}')"><i class="feather icon-edit"></i></button> `
                render += `<button class="btn btn-outline-warning btn-sm" data-toggle="ajax" data-target="${window.location.href}/${data}/change"><i class="feather icon-shield"></i></button> `
            }

            if (userPermissions.includes('delete-roles')) {
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
        $('#myModal').find('input[name="name"]').val(data.name)
        $('#myModal').find('form').trigger('reset')
        $('#myModal').find('.modal-title').html('Edit Role')
        $('#myModal').find('form').attr('action', `${window.location.href}/${id}/update`)
        $('#myModal').modal('show')
    } else {
        notify('warning', 'Opps! Terjadi kesalahan')
    }
}
$('#create-roles').unbind().on('click', function(e){
    e.preventDefault();
    $('#myModal').find('.modal-title').html('Tambah Role')
    $('#myModal').find('form').trigger('reset')
    $('#myModal').find('form').attr('action', `${window.location.href}/store`)
    $('#myModal').modal('show')
})

if($(".uid:checked").length == $(".uid").length){
    $("#uid").prop('checked', true)
}

$("#uid").click(function () {
    if (this.checked == true) {
        $(".uid").prop("checked", true)
    } else {
        $(".uid").prop("checked", false)
    }
})