'use strict';

var rKLandingPagesModule = {};

rKLandingPagesModule.itemSelector = {};
rKLandingPagesModule.itemSelector.items = {};
rKLandingPagesModule.itemSelector.baseId = 0;
rKLandingPagesModule.itemSelector.selectedId = 0;

rKLandingPagesModule.itemSelector.onLoad = function (baseId, selectedId)
{
    rKLandingPagesModule.itemSelector.baseId = baseId;
    rKLandingPagesModule.itemSelector.selectedId = selectedId;

    // required as a changed object type requires a new instance of the item selector plugin
    jQuery('#rKLandingPagesModuleObjectType').change(rKLandingPagesModule.itemSelector.onParamChanged);

    jQuery('#' + baseId + '_catidMain').change(rKLandingPagesModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + '_catidsMain').change(rKLandingPagesModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + 'Id').change(rKLandingPagesModule.itemSelector.onItemChanged);
    jQuery('#' + baseId + 'Sort').change(rKLandingPagesModule.itemSelector.onParamChanged);
    jQuery('#' + baseId + 'SortDir').change(rKLandingPagesModule.itemSelector.onParamChanged);
    jQuery('#rKLandingPagesModuleSearchGo').click(rKLandingPagesModule.itemSelector.onParamChanged);
    jQuery('#rKLandingPagesModuleSearchGo').keypress(rKLandingPagesModule.itemSelector.onParamChanged);

    rKLandingPagesModule.itemSelector.getItemList();
};

rKLandingPagesModule.itemSelector.onParamChanged = function ()
{
    jQuery('#ajaxIndicator').removeClass('hidden');

    rKLandingPagesModule.itemSelector.getItemList();
};

rKLandingPagesModule.itemSelector.getItemList = function ()
{
    var baseId;
    var params;

    baseId = rKLandingPagesModule.itemSelector.baseId;
    params = {
        ot: baseId,
        sort: jQuery('#' + baseId + 'Sort').val(),
        sortdir: jQuery('#' + baseId + 'SortDir').val(),
        q: jQuery('#' + baseId + 'SearchTerm').val()
    }
    if (jQuery('#' + baseId + '_catidMain').length > 0) {
        params[catidMain] = jQuery('#' + baseId + '_catidMain').val();
    } else if (jQuery('#' + baseId + '_catidsMain').length > 0) {
        params[catidsMain] = jQuery('#' + baseId + '_catidsMain').val();
    }

    jQuery.getJSON(Routing.generate('rklandingpagesmodule_ajax_getitemlistfinder'), params, function( data ) {
        var baseId;

        baseId = rKLandingPagesModule.itemSelector.baseId;
        rKLandingPagesModule.itemSelector.items[baseId] = data;
        jQuery('#ajaxIndicator').addClass('hidden');
        rKLandingPagesModule.itemSelector.updateItemDropdownEntries();
        rKLandingPagesModule.itemSelector.updatePreview();
    });
};

rKLandingPagesModule.itemSelector.updateItemDropdownEntries = function ()
{
    var baseId, itemSelector, items, i, item;

    baseId = rKLandingPagesModule.itemSelector.baseId;
    itemSelector = jQuery('#' + baseId + 'Id');
    itemSelector.length = 0;

    items = rKLandingPagesModule.itemSelector.items[baseId];
    for (i = 0; i < items.length; ++i) {
        item = items[i];
        itemSelector.get(0).options[i] = new Option(item.title, item.id, false);
    }

    if (rKLandingPagesModule.itemSelector.selectedId > 0) {
        jQuery('#' + baseId + 'Id').val(rKLandingPagesModule.itemSelector.selectedId);
    }
};

rKLandingPagesModule.itemSelector.updatePreview = function ()
{
    var baseId, items, selectedElement, i;

    baseId = rKLandingPagesModule.itemSelector.baseId;
    items = rKLandingPagesModule.itemSelector.items[baseId];

    jQuery('#' + baseId + 'PreviewContainer').addClass('hidden');

    if (items.length === 0) {
        return;
    }

    selectedElement = items[0];
    if (rKLandingPagesModule.itemSelector.selectedId > 0) {
        for (var i = 0; i < items.length; ++i) {
            if (items[i].id == rKLandingPagesModule.itemSelector.selectedId) {
                selectedElement = items[i];
                break;
            }
        }
    }

    if (null !== selectedElement) {
        jQuery('#' + baseId + 'PreviewContainer')
            .html(window.atob(selectedElement.previewInfo))
            .removeClass('hidden');
        rKLandingPagesInitImageViewer();
    }
};

rKLandingPagesModule.itemSelector.onItemChanged = function ()
{
    var baseId, itemSelector, preview;

    baseId = rKLandingPagesModule.itemSelector.baseId;
    itemSelector = jQuery('#' + baseId + 'Id').get(0);
    preview = window.atob(rKLandingPagesModule.itemSelector.items[baseId][itemSelector.selectedIndex].previewInfo);

    jQuery('#' + baseId + 'PreviewContainer').html(preview);
    rKLandingPagesModule.itemSelector.selectedId = jQuery('#' + baseId + 'Id').val();
    rKLandingPagesInitImageViewer();
};

jQuery(document).ready(function() {
    var infoElem;

    infoElem = jQuery('#itemSelectorInfo');
    if (infoElem.length == 0) {
        return;
    }

    rKLandingPagesModule.itemSelector.onLoad(infoElem.data('base-id'), infoElem.data('selected-id'));
});
