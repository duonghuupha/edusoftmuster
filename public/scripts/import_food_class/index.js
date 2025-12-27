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
});

function clear_single() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function save() {
    const cropped = cropTransparent(canvas);
    if(data_accept.length != 0 && cropped && isAllValueChecked()){
        const dataURL = cropped.toDataURL('image/png');
        $('#single').val(dataURL); $('#data_food').val(JSON.stringify(data_accept));
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
                    save_reject('#fm', baseUrl + '/import_food_class/add?token='+localStorage.getItem('token'), baseUrl + '/import_food_class?token=' + localStorage.getItem('token'));
                }
            }
        });
    }else{
        show_message('error', 'Vui lòng xác nhận định lượng món ăn và ký tên!');
    }
   //console.log(isAllValueChecked());
}

function change_data_accept(food_id) {
    var check_food = $('#value_'+food_id).is(':checked');
    if(check_food){
        var str_data = {'food_id': food_id, 'status': 1, 'value': $('#value_'+food_id).val()};
        data_accept.push(str_data);
    }else{
        data_accept = data_accept.filter(item => item.food_id !== food_id);
    }
    console.log(data_accept);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function setupCanvas() {
    const ratio = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();

    canvas.width = rect.width * ratio;
    canvas.height = rect.height * ratio;

    ctx = canvas.getContext('2d');
    ctx.scale(ratio, ratio);

    ctx.strokeStyle = '#0d6efd'; // xanh
    ctx.lineWidth = 1.2;         // mảnh hơn
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

function isAllValueChecked() {
    const $inputs = document.querySelectorAll('input[type="checkbox"][id^="value_"]');

    if ($inputs.length === 0) return false;

    for (let i = 0; i < $inputs.length; i++) {
        if (!$inputs[i].checked) {
            return false;
        }
    }
    return true;
}