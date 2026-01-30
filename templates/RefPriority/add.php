<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RefPriority $refPriority
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Senarai Keutamaan'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="refPriority form content">
            <?= $this->Form->create($refPriority) ?>
            <fieldset>
                <legend><?= __('Tambah Keutamaan Baru') ?></legend>
                <?php
                    echo $this->Form->control('priority_label', ['label' => 'Label Keutamaan']);
                    echo $this->Form->control('sla_hours', ['label' => 'SLA (Jam)']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Hantar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
