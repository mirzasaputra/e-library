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
        width: '50%'
    },
], null, [2, 'asc'])

$('#confirm').unbind().on('click', function(e){
    e.preventDefault()
    var url = $(this).attr('href')
    var callback = $(this).data('success-callback')

    swal.fire({
        title: 'Apakah anda yakin?',
        icon: 'warning',
        text: 'Pastikan semua data benar.',
        showConfirmButton: true,
        confirmButtonText: 'Ya, lanjutkan',
        showCancelButton: true,
        cancelButtonText: 'Tidak',
    }).then(async res => {
        if(res.isConfirmed){
            swal.fire({
                title: "Please wait",
                text: "Processing data",
                allowOutsideClick: false,
                didOpen: () => {
                    swal.showLoading()
                }
            })

            const res = await fetch(url)

            swal.close()
            if(res.status == 200){
                pushState(callback)
            } else {
                var data = await res.json()

                swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: data.message,
                })
            }
        }
    })
})