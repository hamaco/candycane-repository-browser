<?php echo $this->Form->create('Repository', array('url' => sprintf('/projects/%s/repository/setting', $main_project['Project']['identifier']), 'type' => 'post', 'class' => 'tabular')) ?>
  <div class="box">
  <p>
    <label><?php echo __('Repository') ?></label>
    <?php echo $this->Form->text('Repository.url',array(
      'value' => $repository_url,
      'size'  => 20,
      'div'   => false,
      'label' => false,
    )); ?>(<?php echo __('Example') ?>: yandod/candycane)
  </p>
  </div>

  <?php echo $this->Form->submit(__('Save')) ?>
<?php echo $this->Form->end(); ?>
