const canvas = document.getElementById('signaturePad');
let ctx;
let drawing = false;
let lastX = 0;
let lastY = 0;
let data_accept = [];

$(function(){
    setupCanvas();
    $(canvas).on('mousedown touchstart', function (e) {
        drawing = true;
        const pos = getPos(e.originalEvent);
        lastX = pos.x;
        lastY = pos.y;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
    });

    $(canvas).on('mousemove touchmove', function (e) {
        if (!drawing) return;
        e.preventDefault();

        const pos = getPos(e.originalEvent);
        const midX = (lastX + pos.x) / 2;
        const midY = (lastY + pos.y) / 2;

        ctx.quadraticCurveTo(lastX, lastY, midX, midY);
        ctx.stroke();

        lastX = pos.x;
        lastY = pos.y;
    });

    $(canvas).on('mouseup touchend touchcancel', function () {
        drawing = false;
    });
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    combo_select_2_format('#personnel_id', baseUrl + '/imp_signature/combo_personnel?token='+localStorage.getItem('token'), 0, '');
    $('#personnel_id').on('select2:select', function(e){
        var data = e.params.data;
        $.getJSON(baseUrl + '/imp_signature/get_signature?personnel_id='+data.id+'&token='+localStorage.getItem('token'), function(result){
            if(result.length > 0){
                var html = '<img src="'+baseUrl_img+'/'+result+'" style="height: 50px;width: auto;margin-bottom:20px;"/>';
                $('#signature_old').html(html);
            }
        });
    })
});

function clear_single() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function save() {
    const cropped = cropTransparent(canvas);
    if(cropped){
        const dataURL = cropped.toDataURL('image/png');
        $('#single').val(dataURL);
        bootbox.confirm({
            message: "Bạn có chắc chắn muốn duyệt các món ăn đã chọn?",
            buttons:{
                confirm: {
                    label: "Đồng ý",
                    className: "btn-primary btn-sm"
                },
                cancel: {
                    label: "Không đồng ý",
                    className: "btn-danger btn-sm"
                }
            },
            callback: function(result){
                if(result){
                    save_reject('#fm', baseUrl + '/imp_signature/update?token='+localStorage.getItem('token'), baseUrl + '/imp_signature?token=' + localStorage.getItem('token'));
                }
            }
        });
    }else{
        show_message('error', 'Vui lòng xác nhận định lượng món ăn và ký tên!');
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function setupCanvas() {
    const ratio = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();

    canvas.width = rect.width * ratio;
    canvas.height = rect.height * ratio;

    ctx = canvas.getContext('2d');
    ctx.scale(ratio, ratio);

    ctx.strokeStyle = '#000'; // xanh
    ctx.lineWidth = 2;         // mảnh hơn
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
}

function getPos(e) {
    const rect = canvas.getBoundingClientRect();
    if (e.touches) {
        return {
            x: e.touches[0].clientX - rect.left,
            y: e.touches[0].clientY - rect.top
        };
    }
    return {
        x: e.clientX - rect.left,
        y: e.clientY - rect.top
    };
}

function cropTransparent(sourceCanvas) {
    const w = sourceCanvas.width;
    const h = sourceCanvas.height;
    const ctx = sourceCanvas.getContext('2d');
    const imgData = ctx.getImageData(0, 0, w, h).data;

    let minX = w, minY = h, maxX = 0, maxY = 0;

    for (let y = 0; y < h; y++) {
        for (let x = 0; x < w; x++) {
            const i = (y * w + x) * 4;
            if (imgData[i + 3] > 0) {
                minX = Math.min(minX, x);
                minY = Math.min(minY, y);
                maxX = Math.max(maxX, x);
                maxY = Math.max(maxY, y);
            }
        }
    }

    if (minX >= maxX || minY >= maxY) return null;

    const cropW = maxX - minX;
    const cropH = maxY - minY;

    const temp = document.createElement('canvas');
    temp.width = cropW;
    temp.height = cropH;

    temp.getContext('2d').drawImage(
        sourceCanvas,
        minX, minY, cropW, cropH,
        0, 0, cropW, cropH
    );

    return temp;
}