$(function(){
    handleEvent()
})

const handleEvent = () => {
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

            }
        } else {
            if(res.status == 422){
                var data = await res.response.json()

                showInvalid(data.errors)
            } else {
                var data = await res.response.json()

                alert(data.message)
            }
        }
    })
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