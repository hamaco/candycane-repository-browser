<h3>
  <?php echo $this->Html->link('root',
    sprintf('/projects/%s/repository/index', $project_id, $content->path)
  ); ?>
  <?php $url = sprintf('/projects/%s/repository/show', $project_id) ?>
  <?php foreach (explode('/', $path) as $part) : ?>
    <?php $url .= '/' . $part ?>
    /
    <?php echo $this->Html->link($part, $url) ?>
  <?php endforeach ?>
</h3>
