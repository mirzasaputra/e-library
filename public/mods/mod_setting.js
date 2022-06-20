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
        name: 'group',
        data: 'group',
    },
    {
        name: 'display_name',
        data: 'display_name',
    },
    {
        name: 'value',
        data: 'value',
    },
    {
        name: 'id',
        data: 'hashid',
        mRender: function(data, type, row){
            var render = ``

            if(userPermissions.includes('update-settings')){
                render += `<button class="btn btn-outline-primary btn-sm editModal" data-id="${data}"><i class="feather icon-edit"></i></button>`
            }

            return render
        }
    },
], function(){
    $('.editModal').unbind().on('click', function(){
        var id = $(this).data('id')
        var data = table.row($(this).parents('tr')).data()
        var modal = $('#myModal')
        modal.find('form').attr('action', `${$('meta[name="base-url"]').attr('content')}/administrator/settings/${id}/update`)
        modal.find('input[name=name]').val(data.display_name)
        modal.find('input[name=value]').val(data.display_name == 'Denda Aplikasi Perhari' ? (data.value).toString().replace(/[^,\d]/g, '') : data.value)
        if(data.display_name == 'Denda Aplikasi Perhari'){
            modal.find('input[name=value]').addClass('format-rupiah')
        } else {
            modal.find('input[name=value]').removeClass('format-rupiah')
        }
        modal.modal('show')
        inputRupiah()
    })
}, [0, 'asc'])

function inputRupiah(){
    $('.format-rupiah').unbind().on('keyup', function(){
        $(this).val(`Rp. ${formatRupiah($(this).val())}`)
    }).trigger('keyup')
}

function formatRupiah(angka){
    var number_string = angka.toString().replace(/[^,\d]/g, '') == '' ? '0' : ((angka.toString().replace(/[^,\d]/g, '')).charAt(0) == '0' && angka.toString().replace(/[^,\d]/g, '').length > 1 ? (angka.toString().replace(/[^,\d]/g, '')).substr(1, angka.toString().replace(/[^,\d]/g, '').length) : (angka.toString().replace(/[^,\d]/g, '')))
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah
}