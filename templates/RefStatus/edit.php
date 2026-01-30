<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RefStatus $refStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Form->postLink(
                __('Padam'),
                ['action' => 'delete', $refStatus->status_id],
                ['confirm' => __('Adakah anda pasti mahu memadam status # {0}?', $refStatus->status_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Senarai Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="refStatus form content">
            <?= $this->Form->create($refStatus) ?>
            <fieldset>
                <legend><?= __('Edit Status') ?></legend>
                <?php
                    echo $this->Form->control('status_name', ['label' => 'Nama Status']);
                    echo $this->Form->control('status_color', ['label' => 'Warna Status']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Hantar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
