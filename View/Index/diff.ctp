<?php echo $this->Html->css('scm'); ?>
<h2>リビジョン <?php echo substr($rev_to, 0, 7) ?>:<?php echo substr($rev, 0, 7) ?> <?php echo $path ?></h2>

<?php foreach ($contents->files as $content) : ?>
  <div class="autoscroll">
    <table class="filecontent" border="1">
      <thead>
        <tr>
          <th class="filename">
            <?php echo $content->filename ?>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="line-code">
            <pre class="brush: diff"><?php echo $content->patch ?></pre>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<?php endforeach ?>



<?php echo $this->Html->css('/cc_repository_browser/css/shCoreEmacs'); ?>
<?php echo $this->Html->css('/cc_repository_browser/css/shThemeEmacs'); ?>
<?php echo $this->Html->script('/cc_repository_browser/js/XRegExp.js'); ?>
<?php echo $this->Html->script('/cc_repository_browser/js/shCore.js'); ?>
<?php echo $this->Html->script('/cc_repository_browser/js/shBrushDiff.js'); ?>
<script>
SyntaxHighlighter.all()
</script>
