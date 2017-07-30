{* Purpose of this template: edit view of generic item list content type *}
<div class="form-group">
    {gt text='Object type' domain='rklandingpagesmodule' assign='objectTypeSelectorLabel'}
    {formlabel for='rKLandingPagesModuleObjectType' text=$objectTypeSelectorLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {rklandingpagesmoduleObjectTypeSelector assign='allObjectTypes'}
        {formdropdownlist id='rKLandingPagesModuleObjectType' dataField='objectType' group='data' mandatory=true items=$allObjectTypes cssClass='form-control'}
        <span class="help-block">{gt text='If you change this please save the element once to reload the parameters below.' domain='rklandingpagesmodule'}</span>
    </div>
</div>

<div class="form-group">
    {gt text='Sorting' domain='rklandingpagesmodule' assign='sortingLabel'}
    {formlabel text=$sortingLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {formradiobutton id='rKLandingPagesModuleSortRandom' value='random' dataField='sorting' group='data' mandatory=true}
        {gt text='Random' domain='rklandingpagesmodule' assign='sortingRandomLabel'}
        {formlabel for='rKLandingPagesModuleSortRandom' text=$sortingRandomLabel}
        {formradiobutton id='rKLandingPagesModuleSortNewest' value='newest' dataField='sorting' group='data' mandatory=true}
        {gt text='Newest' domain='rklandingpagesmodule' assign='sortingNewestLabel'}
        {formlabel for='rKLandingPagesModuleSortNewest' text=$sortingNewestLabel}
        {formradiobutton id='rKLandingPagesModuleSortDefault' value='default' dataField='sorting' group='data' mandatory=true}
        {gt text='Default' domain='rklandingpagesmodule' assign='sortingDefaultLabel'}
        {formlabel for='rKLandingPagesModuleSortDefault' text=$sortingDefaultLabel}
    </div>
</div>

<div class="form-group">
    {gt text='Amount' domain='rklandingpagesmodule' assign='amountLabel'}
    {formlabel for='rKLandingPagesModuleAmount' text=$amountLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {formintinput id='rKLandingPagesModuleAmount' dataField='amount' group='data' mandatory=true maxLength=2 cssClass='form-control'}
    </div>
</div>

<div class="form-group">
    {gt text='Template' domain='rklandingpagesmodule' assign='templateLabel'}
    {formlabel for='rKLandingPagesModuleTemplate' text=$templateLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {rklandingpagesmoduleTemplateSelector assign='allTemplates'}
        {formdropdownlist id='rKLandingPagesModuleTemplate' dataField='template' group='data' mandatory=true items=$allTemplates cssClass='form-control'}
    </div>
</div>

<div id="customTemplateArea" class="form-group"{* data-switch="rKLandingPagesModuleTemplate" data-switch-value="custom"*}>
    {gt text='Custom template' domain='rklandingpagesmodule' assign='customTemplateLabel'}
    {formlabel for='rKLandingPagesModuleCustomTemplate' text=$customTemplateLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {formtextinput id='rKLandingPagesModuleCustomTemplate' dataField='customTemplate' group='data' mandatory=false maxLength=80 cssClass='form-control'}
        <span class="help-block">{gt text='Example' domain='rklandingpagesmodule'}: <em>itemlist_[objectType]_display.html.twig</em></span>
    </div>
</div>

<div class="form-group">
    {gt text='Filter (expert option)' domain='rklandingpagesmodule' assign='filterLabel'}
    {formlabel for='rKLandingPagesModuleFilter' text=$filterLabel cssClass='col-sm-3 control-label'}
    <div class="col-sm-9">
        {formtextinput id='rKLandingPagesModuleFilter' dataField='filter' group='data' mandatory=false maxLength=255 cssClass='form-control'}
    </div>
</div>

<script type="text/javascript">
    (function($) {
    	$('#rKLandingPagesModuleTemplate').change(function() {
    	    $('#customTemplateArea').toggleClass('hidden', $(this).val() != 'custom');
	    }).trigger('change');
    })(jQuery)
</script>
