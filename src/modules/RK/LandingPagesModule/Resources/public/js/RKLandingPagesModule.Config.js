'use strict';

function landpaToggleShrinkSettings(fieldName) {
    var idSuffix = fieldName.replace('rklandingpagesmodule_appsettings_', '');
    jQuery('#shrinkDetails' + idSuffix).toggleClass('hidden', !jQuery('#rklandingpagesmodule_appsettings_enableShrinkingFor' + idSuffix).prop('checked'));
}

jQuery(document).ready(function() {
    jQuery('.shrink-enabler').each(function (index) {
        jQuery(this).bind('click keyup', function (event) {
            landpaToggleShrinkSettings(jQuery(this).attr('id').replace('enableShrinkingFor', ''));
        });
        landpaToggleShrinkSettings(jQuery(this).attr('id').replace('enableShrinkingFor', ''));
    });
});
