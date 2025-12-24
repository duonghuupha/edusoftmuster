const canvas = document.getElementById('signaturePad');
const ctx = canvas.getContext('2d');

ctx.strokeStyle = '#0d6efd';
ctx.lineWidth = 1.2;
ctx.lineCap = 'round';
ctx.lineJoin = 'round';

let drawing = false;
let lastX = 0;
let lastY = 0;

function getPos(e){
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

$(function(){
    // start
    $(canvas).on('mousedown touchstart', function(e){
        drawing = true;
        const pos = getPos(e.originalEvent);
        lastX = pos.x;
        lastY = pos.y;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
    });

    // Move
    $(canvas).on('mousemove touchmove', function(e){
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

    //ENd
    $(canvas).on('mouseup touchend touchcancel', function() {
        drawing = false;
    });
});

function clear_single(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function save(){
    const dataURL = canvas.toDataURL('image/png');
    $.post()
}