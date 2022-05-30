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
        name: 'email',
        data: 'email',
    },
    {
        name: 'phone',
        data: 'phone',
    },
    {
        name: 'address',
        data: 'address',
    },
    {
        name: 'id',
        data: 'hashid',
        width: 150,
        sortable: false,
        mRender: function (data, type, row) {
            var render = ``

            if (userPermissions.includes('update-members')) {
                render += `<button class="btn btn-outline-primary btn-sm" data-toggle="edit" data-id="${data}"><i class="feather icon-edit"></i></button> `
            }

            if (userPermissions.includes('delete-members')) {
                render += `<button class="btn btn-outline-danger btn-sm" data-toggle="delete" data-id="${data}"><i class="feather icon-trash-2"></i></button> `
            }

            return render
        }
    }
])