$(function(){
    window.userPermissions = [];
    
    if ($('meta[name="user-permissions"]').length) {
        window.userPermissions = $('meta[name="user-permissions"]')
            .attr("content")
            .split(",");
    }

    if($('v-renderer').length){
        handleView()
    } else {
        handleEvent()
    }

    window.onpopstate = () => {
        handleView()
    }
})

const handleView =async  () => {
    if($('#reader__dashboard_section_csr span button').length > 0){
        $('#reader__dashboard_section_csr span button').click()
    }
    
    sidebarIndicatorActive()

    swal.fire({
        title: 'Loading',
        html: 'Sedang mengambil data',
        allowOutsideClick: false,
        didOpen: () => {
            swal.showLoading()
        }
    })

    const res = await fetch(window.location.href, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })

    swal.close()
    if(res.status == 200){
        $('v-renderer').html(await res.text())
        handleEvent()

        $('.select2').select2()
    } else {
        if(res.status == 401){
            window.location.reload()
        } else {
            var data = await res.json()
            notify('warning', data.message)
        }
    }
}

const pushState = (url) => {
    history.pushState([], null, url)

    $(".navigation").find(".active").removeClass("active");
    handleView()
}

const handleEvent = () => {
    $('a[data-toggle="ajax"]').unbind().on('click', function(e){
        e.preventDefault()
        pushState($(this).attr('href'))
    })

    $('button[data-toggle="ajax"]').unbind().on('click', function(e){
        e.preventDefault()
        pushState($(this).data('target'))
    })

    $('button[data-toggle="edit"]').unbind().on('click', function(e){
        e.preventDefault()
        pushState(`${window.location.href}/${$(this).data('id')}/edit`)
    })

    $('button[data-toggle="delete"]').unbind().on('click', function(e){
        e.preventDefault()
        let id = $(this).data('id')
        swal.fire({
            tilte: 'Delete?',
            icon: 'question',
            text: 'Yakin ingin menghapus data?',
            showConfirmButton: true,
            confirmButtonText: 'Ya, lanjutkan',
            showCancelButton: true,
            cancelButtonText: 'Batal'
        }).then(res => {
            if(res.isConfirmed){
                deleteEvent(id)
            }
        })
    })

    $('form[data-request="ajax"]').unbind().on('submit', async function(e){
        e.preventDefault();
        var oldBtn = $(this).find('button[type="submit"]').html()
        $(this).find('button[type="submit"]').html('Loading...').attr('disabled', 'disabled')
        resetInvalid()
        
        const res = await formRequest(this)
        
        $(this).find('button[type="submit"]').html(oldBtn).removeAttr('disabled')
        $(this).find('button[type="submit"]').find('.waves-ripple').remove()
        if(res.status == 200){
            if($(this).data('redirect')){
                var data = await res.response.json()
                
                notify('success', data.message)
                if(typeof $(this).data('success-callback') == 'undefined' || typeof $(this).data('success-callback') == 'null'){
                    window.location.assign(data.redirect)
                } else {
                    window.location.assign($(this).data('success-callback'))
                }
            } else {
                var data = await res.response.json()
                
                notify('success', data.message)
                if(typeof $(this).data('success-callback') == 'undefined' || typeof $(this).data('success-callback') == 'null'){
                    $('.modal').modal('hide')
                    $('.modal-backdrop').remove()
                    $('body').removeClass('modal-open')
                    if(typeof table != 'undefined') table.ajax.reload()
                    else handleView()
                } else {
                    pushState($(this).data('success-callback'))
                    if(typeof table != 'undefined') table.ajax.reload()
                    else handleView()
                }
            }
        } else {
            if(res.status == 422){
                var data = await res.response.json()

                showInvalid(data.errors)
            } else {
                var data = await res.response.json()

                notify('warning', data.message)
            }
        }
    })
}

const deleteEvent = async (id) => {
    swal.fire({
        title: 'Loading',
        html: 'Sedang menghapus data',
        allowOutsideClick: false,
        didOpen: () => {
            swal.showLoading()
        }
    })

    const res = await fetch(`${window.location.href}/${id}/delete`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'delete'
    })

    swal.close()
    if(res.status == 200){
        var data = await res.json()

        notify('success', data.message)
        if(typeof table != 'undefined') table.ajax.reload()
        else handleView()
    } else {
        if(res.status == 401){
            window.location.reload()
        } else {
            var data = await res.json()
            notify('warning', data.message)
        }
    }
}

const formRequest = async (form) => {
    const res = fetch($(form).attr('action'), {
        method: $(form).attr('method'),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        body: generateFormBody(new FormData(form))
    })

    return {status: await (await res).status, response: await res}
}

const generateFormBody = (formData) => {
    const fd = new FormData()
    formData.forEach((val, key) => {
        fd.append(key, val)
    })

    return fd
}

const showInvalid = (errorMessages) => {
    for (errorField in errorMessages) {
        $(
            `<div class="invalid-feedback">${errorMessages[errorField]}</div>`
        ).insertAfter(`.form-control[name="${errorField}"]`);
        $(`.form-control[name="${errorField}"]`).addClass("is-invalid");
    }
};

const resetInvalid = () => {
    for (const el of $(".form-control")) {
        $(el).removeClass("is-invalid");
        $(el).siblings(".invalid-feedback").remove();
        $(".invalid-feedback").remove();
    }
};

const notify = (type, message) => {
    var title;
    if (type == "success") title = "Success";
    else if (type == "danger") title = "Failed";
    else title = "Warning";

    return $.notify(
        {
            title: `<strong><b>${title}</b></strong>`,
            message: `<br>${message}`,
            icon: "fa fa-check-circle",
        },
        {
            type: type,
            allow_dismiss: false,
            newest_on_top: true,
            mouse_over: true,
            showProgressbar: false,
            spacing: 10,
            timer: 2000,
            placement: {
                from: "top",
                align: "right",
            },
            offset: {
                x: 30,
                y: 30,
            },
            delay: 1500,
            z_index: 10000,
            animate: {
                enter: "animated fadeIn",
                exit: "animated fadeOut",
            },
            onClose: null,
            onClosed: null,
        }
    );
};

const sidebarIndicatorActive = () => {
    var controller = window.location.href.split("/")[4];
    // console.log(controller)
    $(".navigation")
        .find(
            `a[href="${$('meta[name="base-url"]').attr(
                "content"
            )}/administrator/${controller}"]`
        )
        .parent()
        .addClass("active");

    $(".navigation")
        .find(".sidebar-group-active")
        .removeClass("sidebar-group-active");

    if (
        $(".navigation")
        .find(
            `a[href="${$('meta[name="base-url"]').attr(
                    "content"
                )}/administrator/${controller}"]`
        )
        .parent()
        .parent()
        .parent()
        .hasClass("nav-item has-sub")
    ) {
        $(".navigation")
            .find(
                `a[href="${$('meta[name="base-url"]').attr(
                    "content"
                )}/administrator/${controller}"]`
            )
            .parent()
            .parent()
            .parent()
            .addClass("sidebar-group-active");
    }
};

const initTable = (el, columns = [], drawCallback = null, defaultOrder = [1, 'asc']) => {
    if (!$.fn.DataTable.isDataTable(el)) {

    }

    var opt = {
        processing: true,
        serverSide: true,
        ajax: $(el).data('url'),
        columns: columns,
        responsive: true,
        order: defaultOrder,
        drawCallback,
    }

    var table = $(el).DataTable(opt)

    table.on('draw.dt', function(){
        handleEvent()
    })

    table.on('responsive-display', function(){
        handleEvent()
        drawCallback
    })

    return table
}