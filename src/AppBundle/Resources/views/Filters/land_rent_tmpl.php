<div class="domstor_filter">
<?php $this->displayOpenTag()?>
<?php $this->displayHidden()?>
    <div class="fields">
        <div class="fields_block">
            <div class="fields_line price land">
                <p><strong>Арендная ставка:</strong></p>
                <?php $this->getField('rent')->displayLabelField('min')?>
                <?php $this->getField('rent')->displayLabelField('max')?> р.
                <?php $this->getField('rent')->displayLabelField('period')?>
            </div>
        </div>
        <div class="fields_block">
            <div class="fields_line square land rent">
                <p><strong>Площадь участка:</strong></p>
                <?php $this->getField('squareg')->displayLabelField('min')?>
                <?php $this->getField('squareg')->displayLabelField('max')?>
                <?php $this->getField('squareg')->displayLabelField('unit')?>
            </div>
        </div>
        <div class="fields_block">
            <div class="fields_line code land">
                <strong><?php $this->displayLabel('code')?></strong>
                <?php $this->displayField('code')?>
            </div>
        </div>
    </div>
    <div class="list land">
        <div class="type">
            <p><strong><?php $this->displayLabel('type')?></strong></p>
            <?php $this->displayField('type')?>
        </div>
        <div class="district">
            <p><strong><?php $this->displayLabel('district')?></strong></p>
            <?php $this->displayField('district')?>
        </div>
        <?php if( $this->hasField('suburban') ): ?>
            <div class="suburban">
                <p><strong><?php $this->displayLabel('suburban')?></strong></p>
                <?php $this->displayField('suburban')?>
            </div>
        <?php endif ?>
    </div>
    <div class="submit">
        <noscript>
           <?php $this->displayField('submit')?>
        </noscript>
        <?php $this->displayField('submit_link')?>
    </div>
<?php $this->displayCloseTag()?>
</div>
