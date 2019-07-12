$(document).ready(() => {
    var allObjs;
    $.post('../private/ajax/getAllObjects.php', (data) => {
        allObjs = JSON.parse(data);
        
        for (let obj of allObjs) {
            let html = '';
            // generate html code
            html += '<div class="topic" id="' + obj.id + '">';
            html += '<div class="spaces">';
            for (let i = 0; i < obj.level; i++) html += '_____';
            html += '</div><div class="main">';
            html += '<div class="title"><div class="info">' + obj.id + ' | ' + obj.prev_id + ' | ' + obj.level + '</div>';
            html += '<div class="text">'+ obj.title +'</div>';
            html += '</div><div class="actions">';
            html += '<button onclick="append(this)"><i class="fas fa-plus"></i></button>';
            html += '<button onclick="edit(this)"><i class="fas fa-pen"></i></button>';
            html += '<button onclick="deleteTopic(this)"><i class="fas fa-times"></i></button>';
            html += '</div ></div >'
            // where to output
            if (obj.level == 0) $('.topics').append(html);
            else $('#' + obj.prev_id).after(html);
        }
    });
});



function append(el) {
    alert($(el).attr('onclick'));
}

function edit(el) {
    alert($(el).attr('onclick'));
}

function deleteTopic(el) {
    alert($(el).attr('onclick'));
}