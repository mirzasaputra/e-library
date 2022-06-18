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
        name: 'book_id',
        data: 'book',
        mRender: function(data, type, row){
            return `
                <div class="d-flex align-items-center" style="width: 300px;">
                    <img src="${$('meta[name="asset-url"]').attr('content')}storage/images/books/${data.picture}" width="70" alt="${data.name}">
                    <div class="ml-1">
                        <i class="badge badge-primary">${data.genre}</i>
                        <h5 class="font-weight-bold">${data.name}</h5>
                        <p class="m-0 p-0 small text-muted">Penulis : ${data.author}</p>
                        <p class="m-0 p-0 small text-muted">Tahun Terbit : ${data.publication_year}</p>
                    </div>
                </div>
            `
        }
    },
    {
        name: 'description',
        data: 'description',
        width: '30%'
    },
    {
        name: 'date_of_return',
        data: 'date_of_return',
        mRender: function(data, type, row){
            var render = ``

            if(data == null){
                render += `<i class="badge badge-warning">Belum Dikembalikan</i>`
            } else {
                render += `<i class="badge badge-primary">Sudah Dikembalikan</i>`
            }

            return render
        }
    },
    {
        name: 'id',
        data: 'hashid',
        mRender: function(data, type, row){
            var render = ``

            if(row.date_of_return == null){
                render += `<button class="btn btn-primary btn-sm" data-id="${data}" id="returned"><i class="fa fa-check"></i> Kembalikan</button>`
            }

            return render
        }
    },
], function(){
    $('#returned').unbind().on('click', async function(e){
        var id = $(this).data('id')
        swal.fire({
            title: 'Please Wait',
            html: 'Processing...',
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading()
            }
        })

        const res = await fetch(`${$('meta[name="base-url"]').attr('content')}/administrator/book-returns/${id}/returned`)

        swal.close()
        if(res.status == 200){
            handleView()
        } else {
            swal.fire({
                title: 'Peringatan',
                icon: 'warning',
                text: 'Opps! terjadi kesalahan'
            })
        }
    })
}, [2, 'asc'])