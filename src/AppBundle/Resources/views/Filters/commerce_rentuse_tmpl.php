<div class="domstor_filter">
<?php $this->displayOpenTag()?>
<?php $this->displayHidden()?>
    <div class="fields">
        <div class="fields_block commerce">
            <div class="fields_line square">
                <div class="width">
                    <p><strong>Площадь помещений:</strong></p>
                    <?php $this->displayLabelField('squareh_min')?> <?php $this->displayLabelField('squareh_max')?> кв.м.
                </div>
                <div class="length">
                    <p><strong>Площадь земельного участка:</strong></p>
                    <?php $this->getField('squareg')->displayLabelField('min')?>
                    <?php $this->getField('squareg')->displayLabelField('max')?>
                    <?php $this->getField('squareg')->displayLabelField('unit')?>
                </div>
            </div>
        </div>
        <div class="fields_block commerce rent">
            <div class="fields_line price commerce rent">
                <p><strong>Бюджет:</strong></p>
                <?php $this->getField('rent')->displayLabelField('min')?>
                <?php $this->getField('rent')->displayLabelField('max')?> р./кв.м.
                <?php $this->getField('rent')->displayLabelField('period')?>
            </div>
            <div class="fields_line code commerce rent">
                <strong><?php $this->displayLabel('code')?></strong>
                <?php $this->displayField('code')?>
            </div>
        </div>
    </div>
    <div class="list commerce">
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
        <div class="purpose">
            <p><strong><?php $this->displayLabel('purpose')?></strong></p>
            <?php $this->displayField('purpose')?>
        </div>
    </div>
    <div class="submit">
        <noscript>
           <?php $this->displayField('submit')?>
        </noscript>
        <?php $this->displayField('submit_link')?>
    </div>
<?php $this->displayCloseTag()?>
</div>