if(typeof table == 'undefined'){
    let table, tableBook
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
        mRender: function(data, type, row){
            return `
                <div class="d-flex align-items-center" style="width: 300px;">
                    <img src="${$('meta[name="asset-url"]').attr('content')}storage/images/books/${row.picture}" width="70" alt="${data}">
                    <div class="ml-1">
                        <i class="badge badge-primary">${row.genre}</i>
                        <h5 class="font-weight-bold">${data}</h5>
                        <p class="m-0 p-0 small text-muted">Penulis : ${row.author}</p>
                        <p class="m-0 p-0 small text-muted">Tahun Terbit : ${row.publication_year}</p>
                    </div>
                </div>
            `
        }
    },
    {
        name: 'description',
        data: 'description',
    },
    {
        name: 'id',
        data: 'hashid',
        width: 150,
        sortable: false,
        sClass: 'text-center',
        mRender: function (data, type, row) {
            var render = ``

            if (userPermissions.includes('delete-books')) {
                render += `<button class="btn btn-outline-danger btn-sm" data-toggle="delete" data-id="${data}"><i class="feather icon-trash-2"></i></button> `
            }

            return render
        }
    }
], null, [2, 'asc'])


tableBook = initTable('#tableBook',
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
        mRender: function(data, type, row){
            return `
                <div class="d-flex align-items-center" style="width: 300px;">
                    <img src="${$('meta[name="asset-url"]').attr('content')}storage/images/books/${row.picture}" width="70" alt="${data}">
                    <div class="ml-1">
                        <i class="badge badge-primary">${row.genre}</i>
                        <h5 class="font-weight-bold">${data}</h5>
                        <p class="m-0 p-0 small text-muted">Penulis : ${row.author}</p>
                        <p class="m-0 p-0 small text-muted">Tahun Terbit : ${row.publication_year}</p>
                    </div>
                </div>
            `
        }
    },
    {
        name: 'id',
        data: 'hashid',
        width: 150,
        sortable: false,
        sClass: 'text-center',
        mRender: function (data, type, row) {
            return `<button class="btn btn-outline-primary btn-sm" data-toggle="select" data-id="${data}"><i class="feather icon-chevron-right"></i></button> `
        }
    }
], function(){
    $('button[data-toggle="select"]').unbind().on('click', async function(e){
        swal.fire({
            title: 'Please Wait',
            html: 'Processing...',
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading()
            }
        })

        const res = await fetch(`${window.location.href}/${$(this).data('id')}/store`, {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        swal.close()
        if(res.status == 200){
            table.ajax.reload()
            $('#myModal').modal('hide')
            $('.modal-backdrop').remove()
            $('body').removeClass('modal-open')
        } else {
            swal.fire({
                title: 'Peringatan',
                icon: 'warning',
                text: 'Opps! terjadi kesalahan'
            })
        }
    })
}, [2, 'asc'])

$(function(){
    $('.search-book').unbind().on('click', async function(e){
        swal.fire({
            title: 'Please Wait',
            html: 'Fetching Data',
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading()
            }
        })

        await tableBook.ajax.reload()
        $('#myModal').modal('show')
        swal.close()
    })

    $('#btnCheckout').unbind().on('click', async function(){
        if($('#member_id').val() == ''){
            swal.fire({
                title: 'Peringatan',
                icon: 'warning',
                text: 'Field anggota harus diisi.'
            })
        } else {
            swal.fire({
                title: 'Please Wait',
                html: 'Processing...',
                allowOutsideClick: false,
                didOpen: () => {
                    swal.showLoading()
                }
            })

            var formData = new FormData()
            formData.append('member_id', $('#member_id').val())
            formData.append('date_of_return', $('#date_of_return').val())
    
            const res = await fetch(`${window.location.href}/checkout`, {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: formData
            })
    
            swal.close()
            if(res.status == 200){
                table.ajax.reload()
                $('#myModal').modal('hide')
                $('.modal-backdrop').remove()
                $('body').removeClass('modal-open')

                swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'Transaksi berhasil'
                })
                
                handleView()
            } else {
                swal.fire({
                    title: 'Peringatan',
                    icon: 'warning',
                    text: 'Opps! terjadi kesalahan'
                })
            }
        }
    })
})