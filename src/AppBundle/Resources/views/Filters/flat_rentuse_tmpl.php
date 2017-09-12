<div class="domstor_filter">
<?php $this->displayOpenTag()?>
<?php $this->displayHidden()?>
    <div class="fields">
        <div class="fields_block flat_rentuse">
            <div class="fields_line rooms_building">
                <div class="inside_line room_count">
                    <p><strong><?php $this->displayLabel('room_count')?></strong></p>
                    <div class="label_input">
                        <?php $this->displayField('room_count')?>
                    </div>
                    <div class="label_input in_communal">
                        <?php $this->displayFieldLabel('in_communal')?>
                    </div>
                </div>
                <div class="inside_line price flat_purchase">
                    <p><strong>Бюджет:</strong></p>
                    <?php $this->getField('rent')->displayLabelField('min')?>
                    <?php $this->getField('rent')->displayLabelField('max')?> р.
                    <?php $this->getField('rent')->displayLabelField('period')?>
                </div>
            </div>
            
        </div>
        <div class="fields_block">
            <div class="fields_line code flat_purchase">
                <strong><?php $this->displayLabel('code')?></strong>
                <?php $this->displayField('code')?>
            </div>
        </div>
    </div>
    <div class="list">
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