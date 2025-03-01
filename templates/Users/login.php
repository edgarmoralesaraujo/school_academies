<?= $this->Html->script('student-login', ['block' => true]) ?>

<?= $this->Flash->render() ?>
<?= $this->Form->create(null, ['class'=>'user', 'id' => 'student-form']) ?>
    <legend><?= __('Iniciar sesión') ?></legend>
    <div class="form-group">
        <?= $this->Form->control('username', [
            'required' => true,
            'class' => 'form-control form-control-user text-uppercase',
            'id' => 'student-user',
            'label' => [
                'text' => 'Ingrese su CURP'
            ],
            'error' => ['required' => __('Este campo es requerido', true)]
        ]) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->control('password', ['required' => true, 
            'class' => 'form-control form-control-user',
            'id' => 'student-pass',
            'type' => 'hidden',
            'label' => [
                'text' => 'Contraseña'
            ]
        ]) ?>

    </div>
    <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary btn-user btn-block']); ?>
<?= $this->Form->end() ?>

<div class="text-center">
    <?= $this->Html->link(__('Admin Login'), ['action' => 'login', 'admin'], ['class' => 'small']) ?>
</div>