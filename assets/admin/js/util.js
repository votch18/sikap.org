//ajax json
function ajax(url, data) {
    return $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        crossDomain: true,
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        error: function(res){
            console.log('error')
            console.log(res)
        },
        success: function (response) {
        }
    });
}


//ajax html
function ajaxHtml(url, data) {
    return $.ajax({
        type: 'POST',
        url: url,
        data: data,      
        dataType: "html",
        crossDomain: true,
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        error: function(res){
            console.log('error')
            console.log(res)
        },
        success: function (response) {
        }
    });
}


//sweetalert prompt for delete and publish
var swalPrompt = (msg, title) => {
    return swal({
        title: title,
        text: msg,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    });
}
//check image url if image exists
var checkImage = (img) => {
    img.src = $(img).attr('default-image');
}

//shake modal when error occured
function shakeModal() {
    $('.modal .modal-dialog').attr('class', 'modal-dialog shake animated');
    setTimeout(function () {
        $('.modal .modal-dialog').attr('class', 'modal-dialog');
    }, 2000)
}

let serializeForm = ($data) => {
    var data = {};

    $.each($data, function (i, field) {
        data[field.name] = field.value || '';
    });

    return data;
}

let blockUI = (element) => {
    return $(element).block({
        message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Please wait...</div>',
        fadeIn: 1000,
        fadeOut: 1000,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: '10px 15px',
            color: '#fff',
            width: 'auto',
            backgroundColor: '#333'
        }
    });
}
    