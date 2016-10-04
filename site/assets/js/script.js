jQuery(document).ready(function () {

    if (fkinit.isImage == '') {

        fkinit.customImage = '';

    }
    jQuery(".fakeloader").fakeLoader({

        timeToHide: fkinit.delayTime, //Time in milliseconds for fakeLoader disappear

        zIndex: fkinit.zIndex, //Default zIndex 999

        spinner: fkinit.spinner, //Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'

        bgColor: fkinit.bgColor, //Hex, RGB or RGBA colors

        imagePath: fkinit.customImage //If you want can you insert your custom image

    });

});
