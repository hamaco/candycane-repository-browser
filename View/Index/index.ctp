<h3>root</h3>
<?php echo $this->element('CcRepositoryBrowser.tree') ?>

<h3><?php echo __('Latest revision') ?></h3>
<?php echo $this->Form->create(null, array('url' => sprintf('/projects/%s/repository/diff', $project_id), 'type' => 'get')) ?>
  <table class="list changesets">
    <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th></th>
        <th><?php echo __('Date') ?></th>
        <th><?php echo __('Author') ?></th>
        <th><?php echo __('Comment') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      <?php foreach ($commits as $commit) : ?>
        <tr class="changeset <?= ($i++ % 2) ? 'odd' : 'even' ?>">
          <td><?php echo substr($commit->sha, 0, 7) ?></td>
          <td><input type="radio" name="rev" value="<?php echo $commit->sha ?>" /></td>
          <td><input type="radio" name="rev_to" value="<?php echo $commit->sha ?>" /></td>
          <td><?php echo date('Y-m-d H:i', strtotime($commit->commit->committer->date)) ?></td>
          <td><?php echo $commit->commit->committer->name ?></td>
          <td><?php echo $commit->commit->message ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <input type="submit" value="<?php echo __('View') ?>" />
<?php echo $this->Form->end(); ?>
