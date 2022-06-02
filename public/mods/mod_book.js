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
        name: 'picture',
        data: 'picture',
        mRender: function(data){
            return `<img src="${$('meta[name="asset-url"]').attr('content')}storage/images/books/${data}" alt="cover buku" height="100">`
        }
    },
    {
        name: 'name',
        data: 'name',
        width: '15%',
        mRender: function(data, type, row){
            return `
                <i class="badge badge-primary">${row.genre}</i>
                <p class="m-0 p-0">${data}</p>
            `
        }
    },
    {
        name: 'description',
        data: 'description',
    },
    {
        name: 'publication_year',
        data: 'publication_year',
        sClass: 'nowrap',
    },
    {
        name: 'author',
        data: 'author',
        width: '15%'
    },
    {
        name: 'id',
        data: 'hashid',
        width: 200,
        sortable: false,
        mRender: function (data, type, row) {
            var render = ``

            render += `<button class="btn btn-outline-warning btn-sm" data-toggle="ajax" data-target="${window.location.href}/${data}/detail"><i class="feather icon-eye"></i></button> `
            if (userPermissions.includes('update-books')) {
                render += `<button class="btn btn-outline-primary btn-sm" data-toggle="edit" data-id="${data}"><i class="feather icon-edit"></i></button> `
            }

            if (userPermissions.includes('delete-books')) {
                render += `<button class="btn btn-outline-danger btn-sm" data-toggle="delete" data-id="${data}"><i class="feather icon-trash-2"></i></button> `
            }

            return render
        }
    }
], null, [2, 'asc'])