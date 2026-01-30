<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintLog $complaintLog
 * @var string[]|\Cake\Collection\CollectionInterface $complaints
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Form->postLink(
                __('Padam'),
                ['action' => 'delete', $complaintLog->log_id],
                ['confirm' => __('Adakah anda pasti mahu memadam log # {0}?', $complaintLog->log_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Senarai Log'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintLogs form content">
            <?= $this->Form->create($complaintLog) ?>
            <fieldset>
                <legend><?= __('Edit Log') ?></legend>
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
