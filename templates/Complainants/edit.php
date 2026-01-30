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
            <?= $this->Form->postLink(
                __('Padam'),
                ['action' => 'delete', $complainant->complainant_id],
                ['confirm' => __('Adakah anda pasti mahu memadam pengadu # {0}?', $complainant->complainant_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Senarai Pengadu'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complainants form content">
            <?= $this->Form->create($complainant) ?>
            <fieldset>
                <legend><?= __('Edit Pengadu') ?></legend>
                <?php
                    echo $this->Form->control('full_name', ['label' => 'Nama Penuh']);
                    echo $this->Form->control('ic_number', ['label' => 'No. IC']);
                    echo $this->Form->control('phone_mobile', ['label' => 'No. Telefon']);
                    echo $this->Form->control('email', ['label' => 'E-mel']);
                    echo $this->Form->control('created_at', ['label' => 'Tarikh Didaftar', 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Hantar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
