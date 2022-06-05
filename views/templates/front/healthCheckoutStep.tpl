{extends file='checkout/_partials/steps/checkout-step.tpl'}

{block name='step_content'}
    <div class="custom-checkout-step">
        <p>{l 
            s='Afin de confirmer votre commande merci de renseigner ces informations complémentaire sur votre service' 
            d='Modules.Qcmorder.Admin'
        }</p>
        <form
                method="POST"
                action="{$urls.pages.order}"
                data-refresh-url="{url entity='order' params=['ajax' => 1, 'action' => 'customStep']}"
        >
            <section class="form-fields">
                <div class="form-group row">
                    <label class="col-md-3 form-control-label required">{l s='Height' d='Modules.Qcmorder.Admin'}</label>
                    <div class="col-md-6">
                        <input type="text" name="height" {if isset($height)}value="{$height}"{/if}/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 form-control-label required">{l s='Weight' d='Modules.Qcmorder.Admin'}</label>
                    <div class="col-md-6">
                        <input type="text" name="weight" {if isset($weight)}value="{$weight}"{/if}/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 form-control-label required">{l s='Age' d='Modules.Qcmorder.Admin'}</label>
                    <div class="col-md-6">
                        <input type="text" name="age" {if isset($age)}value="{$age}"{/if}/>
                    </div>
                </div>
            </section>
            <footer class="form-footer clearfix">
                <input type="submit" name="submitCustomStep" value="Continue"class="btn btn-primary continue float-xs-right"/>
            </footer>
        </form>
    </div>
{/block}
