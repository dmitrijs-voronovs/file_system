$(document).ready(() => {
    var allObjs;
    $.post('../private/ajax/getAllObjects.php', (data) => {
        allObjs = JSON.parse(data);
        console.log(allObjs);
        
        for (let obj of allObjs) {
            let html = '';
            // generate html code
            html += '<div class="topic" id="' + obj.id + '">';
            html += '<div class="spaces">';
            for (let i = 0; i < obj.level; i++) html += '_____';
            html += '</div><div class="main">';
            html += '<div class="title">(' + obj.id +'|'+obj.prev_id+'|'+obj.level+') '+ obj.title;
            html += '</div><div class="actions">';
            html += '<button onclick="moveDown(this)">DOWN</button>';
            html += '<button onclick="moveUp(this)">UP</button>';
            html += '<button onclick="rename(this)">RENAME</button>';
            html += '<button onclick="deleteTopic(this)">DELETE</button>';
            html += '</div ></div >'
            // where to output
            console.log(html);
            if (obj.level == 0) $('.topics').append(html);
            else $('#' + obj.prev_id).after(html);
        }
    });
});

function moveDown(el) {
    alert($(el).attr('onclick'));
}

function moveUp(el) {
    alert($(el).attr('onclick'));
}

function rename(el) {
    alert($(el).attr('onclick'));
}

function deleteTopic(el) {
    alert($(el).attr('onclick'));
}