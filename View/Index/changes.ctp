<?php echo $this->element('CcRepositoryBrowser.breadcrumbs') ?>

<?php echo $this->Form->create(null, array('url' => sprintf('/projects/%s/repository/diff', $project_id), 'type' => 'get')) ?>
  <input type="hidden" name="path" value="<?php echo $path ?>" />
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
      <?php foreach ($commits as $commit) : ?>
        <tr class="changeset <?= ($i++ % 2) ? 'odd' : 'even' ?>">
          <td><?php echo substr($commit->sha, 0, 7) ?></td>
          <td><input type="radio" name="rev" value="<?php echo $commit->sha ?>" /></td>
          <td><input type="radio" name="rev_to" value="<?php echo $commit->sha ?>" /></td>
          <td><?= date('Y-m-d H:i', strtotime($commit->commit->committer->date) + 3600*9) ?></td>
          <td><?= $commit->commit->committer->name ?></td>
          <td><?= $commit->commit->message ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <input type="submit" value="<?php echo __('View') ?>" />
<?php echo $this->Form->end(); ?>
