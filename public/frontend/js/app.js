$(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 130){
            $('.navbar').addClass('navbar-fixed')
        } else {
            $('.navbar').removeClass('navbar-fixed')
        }
    })

    if($('.navbar').find(`a[href="${window.location.href}"`).length){
        $('.navbar').find(`.active`).addClass('active')
        $('.navbar').find(`a[href="${window.location.href}"`).parent().addClass('active')
    } else {
        $('.nav-item:nth-child(1)').addClass('active')
    }

    handleEvent();
})

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