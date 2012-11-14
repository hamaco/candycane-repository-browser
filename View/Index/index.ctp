<h3>root</h3>
<?php echo $this->element('CcRepositoryBrowser.tree') ?>

<h3>最新リビジョン</h3>
<?php echo $this->Form->create(null, array('url' => sprintf('/projects/%s/repository/diff', $project_id), 'type' => 'get')) ?>
  <table class="list changesets">
    <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th></th>
        <th>日付</th>
        <th>作成者</th>
        <th>コメント</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      <?php foreach ($commits as $commit) : ?>
        <tr class="changeset <?= ($i++ % 2) ? 'odd' : 'even' ?>">
          <td><?php echo substr($commit->sha, 0, 7) ?></td>
          <td><input type="radio" name="rev" value="<?php echo $commit->sha ?>" /></td>
          <td><input type="radio" name="rev_to" value="<?php echo $commit->sha ?>" /></td>
          <td><?= date('Y-m-d H:i', strtotime($commit->commit->committer->date)) ?></td>
          <td><?= $commit->commit->committer->name ?></td>
          <td><?= $commit->commit->message ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <input type="submit" value="差分を見る" />
<?php echo $this->Form->end(); ?>
