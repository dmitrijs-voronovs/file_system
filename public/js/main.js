$(document).ready(() => {
    loadElements();
    $('input')[0].focus();
});

let latestAddedInput;

function generateHTMLforOneElement(obj){
    let html = '';
    // generate html code
    html += '<div class="topic" id="' + obj.id + '" level="' + obj.level + '">';
    html += '<div class="spaces">';
    for (let i = 0; i < obj.level; i++) html += 'o_____';
    html += '</div><div class="main">';
    // html += '<div class="title"><div class="info">' + obj.id + ' | ' + obj.prev_id + ' | ' + obj.level + ' | ' + obj.username + '</div>';
    html += '<div class="title"><div class="info">' + obj.username + '</div>';
    html += '<div class="text">'+ obj.title + '</div>';
    html += '<div class="desc">'+ obj.description + '</div>';
    html += '</div><div class="actions">';
    html += '<button onclick="append(this)"><i class="fas fa-plus"></i></button>';
    html += '<button onclick="edit(this)"><i class="fas fa-pen"></i></button>';
    html += '<button onclick="deleteTopic(this)"><i class="fas fa-times"></i></button>';
    html += '</div ></div>';
    return html;
}

function loadElements(){
    var allObjs;
    $.post('../private/ajax/getAllObjects.php', (data) => {
        allObjs = JSON.parse(data);
        
        for (let obj of allObjs) {
            let html = generateHTMLforOneElement(obj);
            // where to output
            if (obj.level == 0) $('.topics').append(html);
            else $('#' + obj.prev_id).after(html);
        }
    });
}

function append(el) {
    $parent = $(el).parent().parent().parent();
    let parentId = parseInt($parent.attr('id'));
    let nextLevel = parseInt($parent.attr('level')) +1;
    $.ajax({
        type: "POST",
        url: '../private/ajax/getTopicsForm.php',
        data: {
            topics: {
                level : nextLevel,
                prev_id: parentId
            }
        },
        success: (data) => {
            $parent.after(data);
            if(latestAddedInput) latestAddedInput.remove();
            latestAddedInput = $parent.next();
            latestAddedInput.find('input')[0].focus();
        }
    });
}

function edit(el) {
    $parent = $(el).parent().parent().parent();
    let parentId = parseInt($parent.attr('id'));
    let parentTitle = $parent.find('.text').text();
    let parentDesc = $parent.find('.desc').text();
    $.ajax({
        type: "POST",
        url: '../private/ajax/getTopicsForm.php',
        data: {
            topics: {
                id: parentId,
                title: parentTitle,
                description: parentDesc
            },
            include_pk: true
        },
        success: (data) => {
            $parent.after(data);
            if(latestAddedInput) latestAddedInput.remove();
            latestAddedInput = $parent.next();
            latestAddedInput.find('input')[0].focus();
        }
    });
}

function findAllChildren(parentID) {
    $parent = $('#'+parentID);
    let parentLevel = $parent.attr('level');
    let childrenIDs = [];
    while($parent.next(".topic") && ($parent.next(".topic").attr('level') > parentLevel)){
        childrenIDs.push($parent.next().attr('id'));
        $prev = $parent;
        $parent = $parent.next(".topic");
        $prev.remove();
    }
    return childrenIDs;
}

function deleteTopic(el) {
    $parent = $(el).parent().parent().parent();
    let parentID = parseInt($parent.attr('id'));
    let IDs = findAllChildren(parentID);
    IDs.push(parentID);
    $.ajax({
        type: "POST",
        url: '../private/ajax/deleteTopic.php',
        data: {
            ids: IDs
        },
        success: (data) => {
            $parent.remove();
        }
    });

}