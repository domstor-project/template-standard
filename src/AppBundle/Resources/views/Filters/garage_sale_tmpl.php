<div class="domstor_filter">
<?php $this->displayOpenTag()?>
<?php $this->displayHidden()?>
    <div class="fields">
        <div class="fields_block house">
            <div class="fields_line square">
                <div class="width">
                    <p><strong>Ширина:</strong></p>
                    <?php $this->displayLabelField('x_min')?> <?php $this->displayLabelField('x_max')?> м.
                </div>
                <div class="length">
                    <p><strong>Длина:</strong></p>
                    <?php $this->displayLabelField('y_min')?> <?php $this->displayLabelField('y_max')?> м.
                </div>
                <div class="height">
                    <p><strong>Высота:</strong></p>
                    <?php $this->displayLabelField('z_min')?> <?php $this->displayLabelField('z_max')?> м.
                </div>
            </div>
        </div>
        <div class="fields_block">
            <div class="fields_line price house">
                <p><strong>Цена:</strong></p>
                <?php $this->getField('price')->displayLabelField('min')?>
                <?php $this->getField('price')->displayLabelField('max')?> тыс.р.
            </div>
            <div class="fields_line code house">
                <strong><?php $this->displayLabel('code')?></strong>
                <?php $this->displayField('code')?>
            </div>
        </div>
    </div>
    <div class="list garage">
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

