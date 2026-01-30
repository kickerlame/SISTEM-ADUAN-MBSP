<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintLog $complaintLog
 * @var \Cake\Collection\CollectionInterface|string[] $complaints
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Senarai Log'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintLogs form content">
            <?= $this->Form->create($complaintLog) ?>
            <fieldset>
                <legend><?= __('Tambah Log Baru') ?></legend>
                <?php
                    echo $this->Form->control('complaint_id', ['options' => $complaints, 'label' => 'Aduan']);
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'label' => 'Pengguna']);
                    echo $this->Form->control('action_taken', ['label' => 'Tindakan Diambil']);
                    echo $this->Form->control('notes', ['label' => 'Catatan']);
                    echo $this->Form->control('status_after', ['label' => 'Status Selepas']);
                    echo $this->Form->control('created_at', ['label' => 'Tarikh Dibuat', 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Hantar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
