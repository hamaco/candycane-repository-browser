<?php echo $this->element('CcRepositoryBrowser.breadcrumbs') ?>

<pre class="prettyprint"><code><?php echo h(trim($contents)) ?></code></pre>

<?php echo $this->Html->css('CcRepositoryBrowser.dessert'); ?>
<?php echo $this->Html->script('CcRepositoryBrowser.prettify'); ?>
<script>prettyPrint();</script>
