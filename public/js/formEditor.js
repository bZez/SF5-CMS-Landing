function addTab() {
    $('#editable').append('<div class="tab selected" onclick="selectThisTab($(this))">' +
        '<div class="actions" onclick="deleteThis(this)" contenteditable="false"><a href="#" class="btn btn-sm btn-danger w-100"><i class="fas fa-times"></i> Supprimer</a></div></div>')
}

function addLabel() {
    $('.tab.selected > .actions').before('<h6 class="font-weight-bold text-black-50" contenteditable="true">Label :</h6>')
}

function addInput(name, type, placeholder) {
    if (name !== '' && type !== '' && placeholder !== '')
        $('.tab.selected > .actions').before('<p><input placeholder="' + placeholder + '..." oninput="this.className = \'form-control\'" name="lead[custom][' + name + ']" class="form-control mb-3" type="' + type + '" disabled><a href="#" class="delBtn btn btn-sm btn-danger" onclick="$(this).parent(\'p\').remove()" required><i class="fas fa-times"></i></a></p>')
}

function addList(name, options) {
    if (name !== '' && options !== '')
        var line = '';
    let opts = options.split("\n");
    for (i = 0; i < opts.length; i++) {
        let opt = opts[i].split(':');
        line += "<option value='" + opt[0] + "'>" + opt[1] + "</option>";
    }
    $('.tab.selected > .actions').before('<p><select name="lead[custom][' + name + ']"  class="form-control mb-3" required>'+ line + '</select><a href="#" class="delBtn btn btn-sm btn-danger" onclick="$(this).parent(\'p\').remove()"><i class="fas fa-times"></i></a></p>')
}

function deleteThis(e) {
    e.parentNode.remove();
    getHtml();
    e.preventDefault();
}

function selectThisTab(t) {
    $('.tab').removeClass('selected');
    $(t).addClass('selected', true)
}

function selectThisInput(t) {
    $('input').removeClass('selected');
    $(t).addClass('selected')
}

//GET HTML FROM DIV AND SET TO TEXTEAREA
function getHtml() {
    $('.editor').val($('#editable').html());
}

//GET HTML FROM TEXTAREA AND SET TO DIV
function setHtml() {
    $('#editable').html($('.editor').val());
    $('#editable .tab:not(".coord") h6').prop('contenteditable', true)
    $('#editable .tab.coord input').prop('readonly', true)
}

function cleanHtml() {
    $('.actions,.delBtn').remove();
    $('h6:empty').remove();
    $('*').removeAttr('contenteditable').removeAttr('onclick').removeAttr('disabled').removeAttr('readonly');
    getHtml();
}

$(document).ready(function () {
    setHtml();
    $('#editable .tab:not(".coord") input, #editable .tab:not(".coord") select:not("#simulator_page")').attr('readonly', true).parent('p').append('<a href="#" class="delBtn btn btn-sm btn-danger" onclick="$(this).parent(\'p\').remove()"><i class="fas fa-times"></i></a>');
    $('.tab:not(".coord")').attr('onclick', 'selectThisTab($(this))').append('<div class="actions" onclick="deleteThis(this)"><a href="#" class="btn btn-sm btn-danger w-100"><i class="fas fa-times"></i> Supprimer</a>\</div>');
});
$('#update').on('click', function (e) {
    e.preventDefault();
    cleanHtml();
    $(this).text('Publier').on('click', function () {
        $('form[name=simulator]').submit();
    })
})