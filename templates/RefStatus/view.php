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
            <?= $this->Html->link(__('Edit Status'), ['action' => 'edit', $refStatus->status_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Padam Status'), ['action' => 'delete', $refStatus->status_id], ['confirm' => __('Adakah anda pasti mahu memadam status # {0}?', $refStatus->status_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Senarai Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Status Baru'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="refStatus view content">
            <h3><?= h($refStatus->status_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nama Status') ?></th>
                    <td><?= h($refStatus->status_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Warna Status') ?></th>
                    <td><?= h($refStatus->status_color) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID Status') ?></th>
                    <td><?= $this->Number->format($refStatus->status_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>