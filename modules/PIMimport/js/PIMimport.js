
function getTemplateLink() {
    var lnk = document.getElementById("getTemplate"),
        importType = document.getElementById("import_type"),
        baseURL = Drupal.settings.basePath + 'sites/default/files/Espace-Collaboratif/modles_import/';
    lnk.href = baseURL + importType.value + '.xls';
}

function getNoticeLink(lg) {
    var lnk = document.getElementById("getNotice_"+lg),
        importType = document.getElementById("import_type"),
        importName = importType.value,
        baseURL = Drupal.settings.basePath + 'sites/default/files/Espace-Collaboratif/notices_import/';
    if (importName.substr(0, 5) === 'BD_NI' ) {
        lnk.href = baseURL + 'BD_NI_PIM_Notice_' + lg + '.doc';
    } else {
        lnk.href = baseURL + 'BD_I_PIM_Notice_' + lg + '.doc';
    }
}
