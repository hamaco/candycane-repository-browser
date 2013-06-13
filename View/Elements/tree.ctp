<table class="list entries">
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Size') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($contents as $content) : ?>
      <tr class="entry">
        <td>
          <?php if ($content->type === 'dir') : ?>
            <?php echo $this->Html->image('folder.png') ?>
            <?php echo $this->Html->link($content->name, 
              sprintf('/projects/%s/repository/show/%s', $project_id, $content->path)
            ); ?>
          <?php else : ?>
            <?php echo $this->Html->image('file.png') ?>
            <?php echo $this->Html->link($content->name, 
              sprintf('/projects/%s/repository/entry/%s', $project_id, $content->path)
            ); ?>
          <?php endif ?>
        </td>
        <td>
          <?php if ($content->size) : ?>
            <?php echo $content->size ?> bytes
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
