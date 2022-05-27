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
        mRender: function (data, type, row) {
            return `
                <div class="row">
                    <div class="col-md-2">
                        <img class="round" src="${`https://ui-avatars.com/api/?name=${data}&&background=random`}" alt="avatar" height="40" width="40">
                    </div>
                    <div class="col-md-10">
                        <h6 class="m-0 p-0">${data}</h6>
                        <span class="text-muted small">${row.username}</span>
                    </div>
                </div>
            `
        }
    },
    {
        name: 'email',
        data: 'email',
    },
    {
        name: 'role',
        data: 'role',
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