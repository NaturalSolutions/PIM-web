function updateLinks() {
    getTemplateLink();
    getNoticeLink('EN');
    getNoticeLink('FR');
}

function getTemplateLink() {
    var lnk = document.getElementById("getTemplate"),
        importType = document.getElementById("import_type"),
        baseURL = Drupal.settings.basePath + 'sites/default/files/Espace-Collaboratif/modeles_import/';
    lnk.href = baseURL + importType.value + '.xls';
}

function getNoticeLink(lg) {
    var lnk = document.getElementById("getNotice_"+lg),
        importType = document.getElementById("import_type"),
        importName = importType.value,
        baseURL = Drupal.settings.basePath + 'sites/default/files/Espace-Collaboratif/notices_import/';
    /*
     * Note: L'organisation absurde des fichiers a été choisie et validée par
     * Vincent Rivière dans un échange d'emails adressé à Gilles et Julie le 23 juin 2015.
     *
     * Il ne fait guère de doute qu'ils demanderont un jour à changer. Il faudra
     * le considérer comme une évolution (payant) et non pas comme une "correctin de bug" (gratuit).
     */
    if (importName.substr(0, 4) === 'BD_I' && lg === 'FR') {
        lnk.href = baseURL + 'BD_I_Notice_V2_FR.doc';
    } else if (importName.substr(0, 4) === 'BD_I' && lg === 'EN') {
        lnk.href = baseURL + 'BD_I_PIM_Notice_EN.doc';
    } else if (lg === 'FR') {
        lnk.href = baseURL + 'Notice_V2_FR.pdf';
    } else if (importName.substr(0, 10) === 'BD_NI_Bota') {
        lnk.href = baseURL + 'BD_NI_PIM_Notice_EN.doc';
    } else if (importName.substr(0, 12) === 'BD_NI_Arthro') {
        lnk.href = baseURL + 'BD_NI_Arthropodes_EN.pdf';
    } else if (importName.substr(0, 11) === 'BD_NI_Autre') {
        lnk.href = baseURL + 'BD_NI_Others_terrestrials_EN.pdf';
    } else if (importName.substr(0, 13) === 'BD_NI_Herpeto') {
        lnk.href = baseURL + 'BD_NI_Herpeto_EN.pdf';
    } else if (importName.substr(0, 13) === 'BD_NI_Ornitho') {
        lnk.href = baseURL + 'BD_NI_Ornitho_EN.pdf';
    } else if (importName.substr(0, 9) === 'BD_NI_FFM') {
        lnk.href = baseURL + 'BD_NI_FFMarine_EN.pdf';
    } else if (importName.substr(0, 11) === 'BD_NI_Chiro') {
        lnk.href = baseURL + 'BD_NI_Chiro_EN.pdf';
    } else if (importName.substr(0, 10) === 'BD_NI_MTNV') {
        lnk.href = baseURL + 'BD_NI_MammalsTNV_EN.pdf';
    }
}
