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
    },
    {
        name: 'description',
        data: 'description',
    },
    {
        name: 'publication_year',
        data: 'publication_year',
    },
    {
        name: 'author',
        data: 'author',
    },
    {
        name: 'id',
        data: 'hashid',
        width: 150,
        sortable: false,
        mRender: function (data, type, row) {
            var render = ``

            if (userPermissions.includes('update-users')) {
                render += `<button class="btn btn-outline-primary btn-sm" data-toggle="edit" data-id="${data}"><i class="feather icon-edit"></i></button> `
            }

            if (userPermissions.includes('delete-users')) {
                render += `<button class="btn btn-outline-danger btn-sm" data-toggle="delete" data-id="${data}"><i class="feather icon-trash-2"></i></button> `
            }

            return render
        }
    }
])