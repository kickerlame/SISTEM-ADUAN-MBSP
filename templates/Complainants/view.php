<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complainant $complainant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Edit Pengadu'), ['action' => 'edit', $complainant->complainant_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Padam Pengadu'), ['action' => 'delete', $complainant->complainant_id], ['confirm' => __('Adakah anda pasti mahu memadam pengadu # {0}?', $complainant->complainant_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Senarai Pengadu'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Pengadu Baru'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complainants view content">
            <h3><?= h($complainant->full_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nama Penuh') ?></th>
                    <td><?= h($complainant->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('No. IC') ?></th>
                    <td><?= h($complainant->ic_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('No. Telefon') ?></th>
                    <td><?= h($complainant->phone_mobile) ?></td>
                </tr>
                <tr>
                    <th><?= __('E-mel') ?></th>
                    <td><?= h($complainant->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID Pengadu') ?></th>
                    <td><?= $this->Number->format($complainant->complainant_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Didaftar Pada') ?></th>
                    <td><?= h($complainant->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>