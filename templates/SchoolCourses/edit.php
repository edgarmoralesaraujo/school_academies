<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SchoolCourse $schoolCourse
 * @var string[]|\Cake\Collection\CollectionInterface $subjects
 * @var string[]|\Cake\Collection\CollectionInterface $teachers
 * @var string[]|\Cake\Collection\CollectionInterface $terms
 * @var string[]|\Cake\Collection\CollectionInterface $schedules
 * @var string[]|\Cake\Collection\CollectionInterface $students
 */
?>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h3 class="page-header-title">Configuraci&oacute;n de <?= __('School Courses') ?></h3>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <?= $this->Form->postLink(__('Delete'),
                        ['action' => 'delete', $schoolCourse->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $schoolCourse->id), 
                        'class' => 'btn btn-sm btn-light text-primary', 'escape' => true]) ?>
                    <?= $this->Html->link(__('List School Courses'), ['action' => 'index'], ['class' => 'btn btn-sm btn-light text-primary', 'escape' => true]) ?>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary-cm"><?= __('Edit School Course') ?></h6>
        </div>
        <div class="card-body">
            <?= $this->Form->create($schoolCourse) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('capacity');
                    echo $this->Form->control('price');
                    echo $this->Form->control('subjet_id', ['options' => $subjects]);
                    echo $this->Form->control('teacher_id', ['options' => $teachers]);
                    echo $this->Form->control('term_id', ['options' => $terms]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
