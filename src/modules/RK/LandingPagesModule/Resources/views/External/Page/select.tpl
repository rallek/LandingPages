{* Purpose of this template: Display a popup selector for Forms and Content integration *}
{assign var='baseID' value='page'}
<div id="itemSelectorInfo" class="hidden" data-base-id="{$baseID}" data-selected-id="{$selectedId|default:0}"></div>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label for="{$baseID}Id" class="col-sm-3 control-label">{gt text='Page'}:</label>
            <div class="col-sm-9">
                <select id="{$baseID}Id" name="id" class="form-control">
                    {foreach item='page' from=$items}
                        <option value="{$page->getKey()}"{if $selectedId eq $page->getKey()} selected="selected"{/if}>{$page->getTitle()}</option>
                    {foreachelse}
                        <option value="0">{gt text='No entries found.'}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="{$baseID}Sort" class="col-sm-3 control-label">{gt text='Sort by'}:</label>
            <div class="col-sm-9">
                <select id="{$baseID}Sort" name="sort" class="form-control">
                    <option value="title"{if $sort eq 'title'} selected="selected"{/if}>{gt text='Title'}</option>
                    <option value="pageContent"{if $sort eq 'pageContent'} selected="selected"{/if}>{gt text='Page content'}</option>
                </select>
                <select id="{$baseID}SortDir" name="sortdir" class="form-control">
                    <option value="asc"{if $sortdir eq 'asc'} selected="selected"{/if}>{gt text='ascending'}</option>
                    <option value="desc"{if $sortdir eq 'desc'} selected="selected"{/if}>{gt text='descending'}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="{$baseID}SearchTerm" class="col-sm-3 control-label">{gt text='Search for'}:</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="text" id="{$baseID}SearchTerm" name="q" class="form-control" />
                    <span class="input-group-btn">
                        <input type="button" id="rKLandingPagesModuleSearchGo" name="gosearch" value="{gt text='Filter'}" class="btn btn-default" />
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="{$baseID}Preview" style="border: 1px dotted #a3a3a3; padding: .2em .5em">
            <p><strong>{gt text='Page information'}</strong></p>
            {img id='ajaxIndicator' modname='core' set='ajax' src='indicator_circle.gif' alt='' class='hidden'}
            <div id="{$baseID}PreviewContainer">&nbsp;</div>
        </div>
    </div>
</div>
