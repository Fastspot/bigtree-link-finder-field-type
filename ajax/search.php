<?
	$pages = $admin->searchPages($_POST["query"]);
	$resources = $admin->searchResources($_POST["query"]);

	if (count($pages)) {
?>
<div>Pages</div>
<?
		foreach ($pages as $page) {
			// Get the parent so we can provide some context to where this page lives
			$parent = $cms->getPage($page["parent"],false);
?>
<a href="<?=WWW_ROOT.$page["path"]?>/" title="<?=$page["title"]?>"><?=($parent["id"] ? $parent["nav_title"] : "Home")?>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;<?=$page["nav_title"]?></a>
<?
		}
	}

	if (count($resources)) {
?>
<div>Resources</div>
<?
		foreach ($resources["resources"] as $resource) {
?>
<a href="<?=str_ireplace("{staticroot}", STATIC_ROOT, $resource["file"])?>" title="<?=$resource["name"]?>"><?=$resource["name"]?></a>
<?
		}
	}
?>